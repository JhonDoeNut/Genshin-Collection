<?php $this->layout('template', ['title' => 'Logs']); ?>

<h1>Logs</h1>

<?php if (empty($available)): ?>
    <p class="no-log">Aucun fichier de log pour le moment.</p>
<?php else: ?>
    <form method="get" action="index.php" class="logs-picker">
        <input type="hidden" name="action" value="logs">
        <label for="month">Mois :</label>
        <select id="month" name="month" onchange="this.form.submit()">
            <?php foreach ($available as $m): ?>
                <option value="<?= $this->e($m) ?>" <?= ($selected === $m) ? 'selected' : '' ?>>
                    <?= $this->e($m) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <pre class="log-box"><?= $this->e($content) ?></pre>
<?php endif; ?>
