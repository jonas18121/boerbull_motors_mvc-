<?php

/**
 * Fait un print_r avec < pre >< / pre > pour le debogage de code avec une colorimétrie
 * @param mixed $param1
 * @param bool $isDie
 * @param mixed $param2
 * @return void
 */
function dumpy($param1, bool $isDie = false, $param2 = null): void
{
    echo <<<HTML
<pre style="
    background:#f6f8fa;
    color:#222;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font:13px Consolas, Monaco, monospace;
    line-height:1.45;
">
HTML;

    dumpValue($param1);

    if ($param2 !== null) {
        echo "\n\n";
        dumpValue($param2);
    }

    echo '</pre>';

    if ($isDie === true) die;
}

/**
 * Gère la colorimétrie des différentes éléments dans un print_r
 *
 * ✅ array
 * ✅ object
 * ✅ string
 * ✅ int
 * ✅ float
 * ✅ bool
 * ✅ null
 * ✅ ressources
 * ✅ propriétés publiques/protégées/privées
 * ✅ indentation
 * ✅ couleurs
 * ✅ plusieurs paramètres
 *
 * ------------------------------------------
 * Cette version ne gère pas les références circulaires
 *
 * Exemple :
 * $a = [];
 * $a['self'] = &$a;
 * dumpy($a);
 *
 * provoquera une récursion infinie.
 * ------------------------------------------
 *
 * @param mixed $value
 * @param int $level
 * @return void
 */
function dumpValue($value, int $level = 0): void
{
    $indent = str_repeat("    ", $level);

    switch (true) {

        case is_null($value):
            echo '<span style="color:#7f8c8d">NULL</span>' . PHP_EOL;
            break;

        case is_bool($value):
            echo '<span style="color:#e67e22">bool(' . ($value ? 'true' : 'false') . ')</span>' . PHP_EOL;
            break;

        case is_int($value):
            echo '<span style="color:#8e44ad">int(' . $value . ')</span>' . PHP_EOL;
            break;

        case is_float($value):
            echo '<span style="color:#d35400">float(' . $value . ')</span>' . PHP_EOL;
            break;

        case is_string($value):
            echo '<span style="color:#27ae60">string(' . strlen($value) . ') "' .
                htmlspecialchars($value) .
                '"</span>' . PHP_EOL;
            break;

        case is_array($value):

            echo '<span style="color:#2980b9;font-weight:bold">';
            echo 'array(' . count($value) . ')';
            echo '</span> {' . PHP_EOL;

            foreach ($value as $k => $v) {

                echo $indent . "    ";

                if (is_int($k)) {
                    echo '[' . $k . '] => ';
                } else {
                    echo '["' . htmlspecialchars($k) . '"] => ';
                }

                dumpValue($v, $level + 1);
            }

            echo $indent . "}" . PHP_EOL;
            break;

        case is_object($value):

            $ref = new ReflectionObject($value);

            echo '<span style="color:#c0392b;font-weight:bold">';
            echo 'object(' . get_class($value) . ')';
            echo '</span> (' . count($ref->getProperties()) . ') {' . PHP_EOL;

            foreach ($ref->getProperties() as $property) {

                $property->setAccessible(true);

                echo $indent . "    ";

                if ($property->isPrivate()) {

                    echo '["' .
                        $property->getName() .
                        '":"' .
                        $property->getDeclaringClass()->getName() .
                        '":private] => ';

                } elseif ($property->isProtected()) {

                    echo '["' .
                        $property->getName() .
                        '":protected] => ';

                } else {

                    echo '["' .
                        $property->getName() .
                        '"] => ';
                }

                dumpValue($property->getValue($value), $level + 1);
            }

            echo $indent . "}" . PHP_EOL;
            break;

        case is_resource($value):

            echo '<span style="color:#16a085">';
            echo 'resource(' . get_resource_type($value) . ')';
            echo '</span>' . PHP_EOL;
            break;

        default:

            echo htmlspecialchars(print_r($value, true));
    }
}
