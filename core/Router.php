<?php

namespace Core;

/**
 * Classe Router
 * -----------------
 * Gère la définition et la résolution des routes HTTP.
 * Elle mappe une URL donnée à une action de contrôleur (ex: "App\Controllers\HomeController@index").
 */
class Router
{
    /**
     * Tableau des routes disponibles, classées par méthode HTTP (GET/POST).
     * Exemple :
     * [
     *   'GET' => ['/articles' => 'App\Controllers\ArticleController@index']
     * ]
     */
    private array $routes = ['GET' => [], 'POST' => []];

    /**
     * Enregistre une route de type GET
     *
     * @param string $path   Chemin de la route (ex: "/articles")
     * @param string $action Action à exécuter (ex: "App\Controllers\ArticleController@index")
     */
    public function get(string $path, string $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    /**
     * Méthode principale qui analyse l'URI demandée
     * et exécute le contrôleur/méthode correspondant si trouvé.
     *
     * @param string $uri    URI de la requête (ex: "/articles")
     * @param string $method Méthode HTTP utilisée (GET, POST, etc.)
     */
    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        // Recherche route exacte
        foreach ($this->routes[$method] ?? [] as $route => $action) {
            if ($route === $path) {
                [$class, $methodName] = explode('@', $action);
                $controller = new $class();
                $controller->$methodName();
                return;
            }
        }

        // Recherche route dynamique (ex: /articles/{id})
        foreach ($this->routes[$method] ?? [] as $route => $action) {
            // Remplace {param} par regex
            if (preg_match('#\{[a-zA-Z0-9_]+\}#', $route)) {
                $regex = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route);
                if (preg_match('#^' . $regex . '$#', $path, $matches)) {
                    array_shift($matches); // Retire le match complet
                    [$class, $methodName] = explode('@', $action);
                    $controller = new $class();
                    $controller->$methodName(...$matches);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 - Page non trouvée";
    }
}
