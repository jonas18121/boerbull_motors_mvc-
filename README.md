# README

### Initialiser le projet

1) Clonez le projet

```ps
git clone https://github.com/jonas18121/template_project_public.git
```

2) Renommez le nom du projet `template_project` par le nouveau nom de votre project exemple `new_project` partout ou on trouve le nom `template_project`

3) Générer le fichier `docker-composer.yml` pour enlever l'extention `.dist`

```ps
make docker-compose
```

4) Générer le fichier `.env` à la racine du projet pour enlever l'extention `.dist`

```ps
make generate-root-env
```

5) Supprimez le fichier `.git` et faire un git init

```ps
git init
```

6) Suivant la version de Symfony qu'on veut utiliser, il faudra surement modifier la version de PHP, de composer et de x-debug dans le fichier `php/Dockerfile`

Exemple pour Symfony 7.0 il faut :

- PHP 8.2
- Composer 2.7.1 
- xdebug-3.2.0 

Dans le répertoire `php/example` il y a des exemples pour différents types de version de PHP.
Exemple : Copier le `Dockerfile` de `php/example/php8.2/Dockerfile` et le `vhosts.conf` de `php/example/php8.2/vhosts/vhosts.conf` pour les coller dans `php/Dockerfile` et `php/vhosts/vhosts.conf`

7) Créez un dossier app à la racine du projet, s'il n'existe pas

```ps
mkdir app
```

8) Construire le projet avec `build` qui représente `docker-compose build`

```ps
make build
```

9) Créez et démarrez les contenaires docker (représente `docker-compose up -d`)

```ps
make run
```

10) Vérifiez si les contenaires sont bien créer

```ps
docker ps
```

11) (Facultative) Pour arrêter et supprimer les contenaires docker (représente `docker-compose down`)

```ps
make down
```

### Créer un projet Symfony dans app

1) La commande ci-dessous permet d'entrez dans le contenaire PHP pour être dans le répertoire `/var/www/app` du contenaire PHP

```ps
make container-php
```

2) Créez le projet Symfony à partir du répertoire `/var/www/app`

- [Installation et configuration du framework Symfony](https://symfony.com/doc/current/setup.html)

```ps
composer create-project symfony/skeleton:"7.0.*" my_project_directory
```

3) A partir de votre `Explorer de dossier`, copiez tout le contenu du dossier `my_project_directory` et collez le contenu à la racine de `/app` puis supprimez `my_project_directory`

Bravo !!! 

Vous pouvez accéder au projet avec les liens ci-dessous

### Access

Access to the projet locally on : http://127.0.0.1:8971/

Access to the project's PHPMyAdmin locally on : http://127.0.0.1:8080/
- user : root
- password : ''

Access to the project's MaiDev locally on : http://127.0.0.1:8081/

### Premier commit sur votre le projet que vous avez préalablement créer

```bash
git add .

git commit -m "First commit"

git branch -M master

git remote add origin https://github.com/your_user12121/your_project_name.git

git remote  -v

git push -u origin master
```

### Creer une base de données

1. Installer le package Doctrine

```ps
composer require symfony/orm-pack
```

2. Dans le fichier `.env` renseignez 

    - le `user`, 
    - le `mot de passe`, 
    - le `nom de base de données` 
    - et utiliser le `nom de container MYSQL` à la place de `name_container_mysql`

```bash
###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
DATABASE_URL="mysql://name_user:password@name_container_mysql:3306/db_name?serverVersion=8.0.32&charset=utf8mb4"
# DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
###< doctrine/doctrine-bundle ###
```

3. Faites la commande ci-dessous pour créer la base de données

```ps
php bin/console doctrine:database:create
```

### Utilisation de Mailjet

- Installation dans le projet Symfony

```bash
composer require mailjet/mailjet-apiv3-php
```

- Ajoutez le DNS ci-dessous dans le fichier `.env`

```bash
###> symfony/mailer ###
# MAILER_DSN=null://null
MAILER_DSN=smtp://maildev:1025
###< symfony/mailer ###
```

- Configuration du fichier config/packages/mailer.yaml du projet Symfony

```yaml
framework:
    mailer:
        dsn: '%env(MAILER_DSN)%'
```

- Exemple d'utilisation dans un controller

- Ne pas oublier de créer les différent fichiers comme `ContactType.php`, `contact/contact.html.twig'`, `emails/contact.html.twig`

```php
// ContactController.php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        Request $request,
        MailerInterface $mailer
    ): Response
    {
        $data = new ContactDTO();

        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $email = (new TemplatedEmail())
                ->from($data->email)
                ->to($data->service)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Demande de contact')
                //->text('Sending emails is fun again!')
                //->html('<p>See Twig integration for better HTML integration!</p>')
                ->htmlTemplate('emails/contact.html.twig')
                ->context(['data' => $data]);

            $mailer->send($email);

            // $entityManager->flush();

            $this->addFlash('success', 'Le mail a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }


        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
```