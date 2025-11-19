<?php
// Fonction pour obtenir le chemin actuel de la requête
if (!function_exists('getCurrentPath')) {
    function getCurrentPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
// Fonction pour obtenir une variable d'environnement avec une valeur par défaut
if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        $value = $_ENV[$key] ?? getenv($key);
        if ($value === false || $value === null || $value === '') {
            return $default;
        }
        return $value;
    }
}
