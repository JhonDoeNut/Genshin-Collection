<?php
$this->layout('template', ['title' => 'Erreur', 'message' => $message ?? null]);
?>

<h1>Woops!</h1>
<img src="public/img/Paimon.gif" alt="Error animation" class="error-img">
<h1>Une erreur est survenue</h1>
<?php if (isset($message)): ?>
    <p class="msg-error"><?= $this->e($message) ?></p>
<?php endif; ?>



