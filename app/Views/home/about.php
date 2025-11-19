<?php

/**
 * Vue : Page "À propos"
 * ---------------------
 * Cette vue reçoit une variable $title
 * transmise par le HomeController.
 */
?>
<div class="card">
    <h1>
        <?= htmlspecialchars($title ?? 'À propos', ENT_QUOTES, 'UTF-8') ?>
    </h1>

    <p>Ceci est la page "À propos" de notre mini-MVC.</p>
</div>