<?php

// Chargement de l'autoloader de Composer pour gérer le chargement automatique des classes
require_once __DIR__ . '/../vendor/autoload.php';
// Inclusion des helpers globaux
require_once __DIR__ . '/../core/helpers.php';

// Chemin vers le répertoire racine de l'application
$baseDir = dirname(__DIR__);

// Charger les variables d'environnement depuis le fichier .env
$envFile = $baseDir . DIRECTORY_SEPARATOR . '.env';

if (is_readable($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        $line = trim($line);

        // Ignorer commentaires et lignes sans '='
        if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Retirer guillemets si présents
        if (strlen($value) >= 2 && ($value[0] === '"' || $value[0] === "'")) {
            if ($value[0] === $value[-1]) {
                $value = substr($value, 1, -1);
            }
        }

        if ($key !== '') {
            putenv("$key=$value");
            $_ENV[$key] = $_SERVER[$key] = $value;
        }
    }
}

// Importation des classes avec namespaces pour éviter les conflits de noms
use Core\Router;

// Initialisation du routeur
$router = new Router();

// Définition des routes de l'application
// La route "/" pointe vers la méthode "index" du contrôleur HomeController
$router->get('/', 'App\\Controllers\\HomeController@index');
$router->get('/about', 'App\\Controllers\\HomeController@about');

// La route "/articles" pointe vers la méthode "index" du contrôleur ArticleController

$router->get('/articles', 'App\\Controllers\\ArticleController@index');
$router->get('/articles/{id}', 'App\\Controllers\\ArticleController@show');

// Exécution du routeur :
// On analyse l'URI et la méthode HTTP pour appeler le contrôleur et la méthode correspondants
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
