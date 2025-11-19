<?php

/**
 * Vue : Détail d'un article
 * --------------------------
 * Cette vue reçoit une variable $article (tableau associatif)
 * transmise par le contrôleur ArticleController.
 * $article contient au minimum : id, title, body.
 */
?>
<div class="card" style="max-width: 650px; margin: 0 auto;">
  <h1 style="font-size:2.2rem; display:flex; align-items:center; gap:10px; margin-bottom:0.5em;">
    <span style="color:#0074d9; font-size:1.5em;">📝</span>
    <?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?>
  </h1>

  <div style="background:#f4f8fb; border-left:4px solid #0074d9; padding:10px 18px; margin-bottom:1.5em; color:#444; font-size:0.98em;">
    <strong>Identifiant :</strong> <?= htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8') ?>
    <!-- Si tu ajoutes une date dans la BDD, tu peux l'afficher ici -->
  </div>

  <blockquote style="font-size:1.18em; line-height:1.8; margin:0 0 2em 0; color:#222; border-left:3px solid #e9ecef; padding-left:18px; background:#fcfcfc;">
    <?= nl2br(htmlspecialchars($article['body'], ENT_QUOTES, 'UTF-8')) ?>
  </blockquote>

  <p style="margin-top:2em; text-align:right;">
    <a href="/articles" class="button">← Retour à la liste des articles</a>
  </p>
</div>