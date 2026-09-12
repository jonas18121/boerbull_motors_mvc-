<?php

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

set_error_handler('appErrorHandler');

set_exception_handler('appExceptionHandler');

register_shutdown_function('appShutdownHandler');


/**
 * Handler principal des erreurs PHP.
 *
 * @param int    $severity
 * @param string $message
 * @param string $file
 * @param int    $line
 *
 * @return bool
 */
function appErrorHandler(
    int $severity,
    string $message,
    string $file,
    int $line
): bool {
    // Les erreurs que le code appelant a demandé à ignorer avec @
    if (!(error_reporting() & $severity)) {
        return false;
    }

    appDisplayError(
        appErrorType($severity),
        $message,
        $file,
        $line,
        debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
    );

    // Empêche PHP d'afficher lui-même l'erreur.
    return true;
}


/**
 * Handler des exceptions et des erreurs Throwable.
 *
 * Gère notamment :
 *
 * - PDOException
 * - Exception
 * - Error
 * - TypeError
 * - ParseError
 *
 * @param Throwable $exception
 *
 * @return void
 */
function appExceptionHandler(Throwable $exception): void
{
    if ($exception instanceof PDOException) {
        $type = 'PDO_EXCEPTION';
    } elseif ($exception instanceof TypeError) {
        $type = 'TYPE_ERROR';
    } elseif ($exception instanceof ParseError) {
        $type = 'PARSE_ERROR';
    } elseif ($exception instanceof Error) {
        $type = 'PHP_ERROR';
    } elseif ($exception instanceof Exception) {
        $type = 'EXCEPTION';
    } else {
        $type = 'THROWABLE';
    }
    $trace = $exception->getTrace();

    if ($trace === []) {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    }

    appDisplayError(
        $type,
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        $trace
    );
}


/**
 * Gestion des erreurs fatales.
 *
 * set_error_handler() ne permet pas de récupérer toutes les erreurs
 * fatales. On les récupère donc au moment de l'arrêt du script.
 *
 * @return void
 */
function appShutdownHandler(): void
{
    $error = error_get_last();

    if ($error === null) {
        return;
    }

    $fatalErrors = [
        E_ERROR,
        E_PARSE,
        E_CORE_ERROR,
        E_CORE_WARNING,
        E_COMPILE_ERROR,
        E_COMPILE_WARNING,
    ];

    if (!in_array($error['type'], $fatalErrors, true)) {
        return;
    }

    appDisplayError(
        appErrorType($error['type']),
        $error['message'],
        $error['file'],
        $error['line'],
        debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
    );
}


/**
 * Affiche une erreur PHP de manière lisible.
 *
 * @param string $type
 * @param string $message
 * @param string $file
 * @param int    $line
 * @param array  $trace
 *
 * @return void
 */
function appDisplayError(
    string $type,
    string $message,
    string $file,
    int $line,
    array $trace = []
): void {
    $source = appGetSource($file, $line);

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?></title>

        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 30px;
                background: #1b1b1b;
                color: #e8e8e8;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
                line-height: 1.5;
            }

            .php-error {
                max-width: 1200px;
                margin: 0 auto;
                background: #252525;
                border: 1px solid #444;
                border-left: 6px solid #e74c3c;
                border-radius: 6px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .4);
            }

            .php-error-header {
                padding: 18px 22px;
                background: #2d2d2d;
                border-bottom: 1px solid #444;
            }

            .php-error-title {
                margin: 0;
                color: #ff6b6b;
                font-size: 20px;
                font-weight: bold;
            }

            .php-error-meta {
                margin-top: 8px;
                color: #aaa;
            }

            .php-error-meta strong {
                color: #61dafb;
            }

            .php-error-body {
                padding: 22px;
            }

            .php-error-message {
                margin-bottom: 25px;
                padding: 15px 18px;
                background: #181818;
                border-radius: 4px;
                color: #fff;
                font-family: Consolas, Monaco, monospace;
                font-size: 15px;
                white-space: pre-wrap;
                word-break: break-word;
            }

            .php-error-section {
                margin-top: 25px;
            }

            .php-error-section-title {
                margin-bottom: 10px;
                color: #ffd166;
                font-size: 15px;
                font-weight: bold;
            }

            .php-source {
                overflow-x: auto;
                padding: 12px 0;
                background: #181818;
                border-radius: 4px;
                font-family: Consolas, Monaco, monospace;
                font-size: 13px;
            }

            .php-source-line {
                display: flex;
                padding: 2px 15px;
                white-space: pre;
            }

            .php-source-line.current {
                background: #4a2929;
                color: #fff;
            }

            .php-source-number {
                width: 60px;
                margin-right: 15px;
                color: #666;
                text-align: right;
                user-select: none;
            }

            .php-source-line.current .php-source-number {
                color: #ff6b6b;
                font-weight: bold;
            }

            .php-source-code {
                color: #ddd;
            }

            .php-trace {
                margin: 0;
                padding: 15px;
                overflow-x: auto;
                background: #181818;
                border-radius: 4px;
                color: #bbb;
                font-family: Consolas, Monaco, monospace;
                font-size: 12px;
                line-height: 1.6;
            }
        </style>
    </head>

    <body>

    <div class="php-error">

        <div class="php-error-header">

            <h1 class="php-error-title">
                <?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>
            </h1>

            <div class="php-error-meta">
                <strong>Fichier :</strong>
                <?= htmlspecialchars($file, ENT_QUOTES, 'UTF-8') ?>
            </div>

            <div class="php-error-meta">
                <strong>Ligne :</strong>
                <?= $line ?>
            </div>

        </div>

        <div class="php-error-body">

            <div class="php-error-message">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
            </div>

            <?php if ($source !== []) : ?>

                <div class="php-error-section">

                    <div class="php-error-section-title">
                        Code source
                    </div>

                    <div class="php-source">

                        <?php foreach ($source as $sourceLine => $sourceCode) : ?>

                            <div class="php-source-line <?= $sourceLine === $line ? 'current' : '' ?>">

                                <span class="php-source-number">
                                    <?= $sourceLine ?>
                                </span>

                                <span class="php-source-code">
                                    <?= htmlspecialchars($sourceCode, ENT_QUOTES, 'UTF-8') ?>
                                </span>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>

            <div class="php-error-section">

                <div class="php-error-section-title">
                    Stack trace
                </div>

                <pre class="php-trace"><?php
                    echo htmlspecialchars(
                        print_r($trace, true),
                        ENT_QUOTES,
                        'UTF-8'
                    );
                ?></pre>

            </div>

        </div>

    </div>

    </body>
    </html>
    <?php

    exit;
}


/**
 * Retourne le nom lisible d'un type d'erreur PHP.
 *
 * @param int $severity
 *
 * @return string
 */
function appErrorType(int $severity): string
{
    $types = [
        E_ERROR             => 'E_ERROR',
        E_WARNING           => 'E_WARNING',
        E_PARSE             => 'E_PARSE',
        E_NOTICE            => 'E_NOTICE',
        E_CORE_ERROR        => 'E_CORE_ERROR',
        E_CORE_WARNING      => 'E_CORE_WARNING',
        E_COMPILE_ERROR     => 'E_COMPILE_ERROR',
        E_COMPILE_WARNING   => 'E_COMPILE_WARNING',
        E_USER_ERROR        => 'E_USER_ERROR',
        E_USER_WARNING      => 'E_USER_WARNING',
        E_USER_NOTICE       => 'E_USER_NOTICE',
        E_STRICT            => 'E_STRICT',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        E_DEPRECATED        => 'E_DEPRECATED',
        E_USER_DEPRECATED   => 'E_USER_DEPRECATED',
    ];

    return $types[$severity] ?? 'UNKNOWN ERROR';
}


/**
 * Récupère les lignes de code autour de l'erreur.
 *
 * @param string $file
 * @param int    $line
 *
 * @return array
 */
function appGetSource(string $file, int $line): array
{
    if (!is_readable($file)) {
        return [];
    }

    $lines = file($file);

    if ($lines === false) {
        return [];
    }

    $start = max(1, $line - 5);
    $end   = min(count($lines), $line + 5);

    $source = [];

    for ($i = $start; $i <= $end; $i++) {
        $source[$i] = rtrim($lines[$i - 1], "\r\n");
    }

    return $source;
}