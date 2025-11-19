<?php

/** 
 * Vue : Liste des articles
 * -------------------------
 * Cette vue reçoit une variable $articles (tableau associatif)
 * transmise par le contrôleur ArticleController.
 * Chaque entrée du tableau contient au minimum : id, title, body.
 */
?>
<div class="card">
  <h1>Articles</h1>
  <ul>
    <?php if (!empty($articles)): ?>
      <?php foreach ($articles as $a): ?>
        <li>
          <a href="/articles/<?= htmlspecialchars($a['id'], ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars($a['title'], ENT_QUOTES, 'UTF-8') ?>
          </a>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>Aucun article disponible.</li>
    <?php endif; ?>
  </ul>
</div>