<?php if ($message instanceof \Helpers\Message): ?>
    <div class="flash <?= $this->e($message->getColor()) ?>">
        <strong><?= $this->e($message->getTitle()) ?></strong><br>
        <?= $this->e($message->getMessage()) ?>
    </div>
<?php endif; ?>
