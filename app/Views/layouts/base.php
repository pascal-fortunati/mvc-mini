<?php

/**
 * Layout principal
 * -----------------
 * Ce fichier définit la structure HTML commune à toutes les pages.
 * Il inclut dynamiquement le contenu spécifique à chaque vue via la variable $content.
 */
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">

  <!-- Titre de la page (sécurisé avec htmlspecialchars, valeur par défaut si non défini) -->
  <title><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Mini MVC' ?></title>

  <!-- Bonne pratique : rendre le site responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
  <?php
  $currentPath = getCurrentPath();
  ?>
  <!-- Menu de navigation global -->
  <nav>
    <a href="/" <?= $currentPath === '/' ? ' class="active"' : '' ?>>Accueil</a>
    <a href="/articles" <?= $currentPath === '/articles' ? ' class="active"' : '' ?>>Articles</a>
    <a href="/about" <?= $currentPath === '/about' ? ' class="active"' : '' ?>>À propos</a>
  </nav>

  <!-- Contenu principal injecté depuis BaseController -->
  <main>
    <?= $content ?>
  </main>
</body>

</html>