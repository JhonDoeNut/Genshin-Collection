<?php
$this->layout('template', ['title' => 'Login', 'message' => $message ?? null]); ?>

<h1>Login</h1>

<form class="form-card-login" method="post" action="index.php?action=login" class="form">
    <div class="form-grid-login">
        <div class="form-group">
            <label for="username">Username ou Email</label>
            <input type="text" id="username" name="username">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-actions">
            <a href="index.php" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn--primary">Login</button>
        </div>

    </div>
</form>

<script>
    document.querySelector('.form-card-login').addEventListener('submit', function (e) {
        e.preventDefault();
        window.location.href = 'https://www.youtube.com/watch?v=xvFZjo5PgG0';
    });
</script>
