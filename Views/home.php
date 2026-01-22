<?php $this->layout('template', ['title' => 'Accueil', 'message' => $message ?? null]); ?>

<h1>Collection <?= $this->e($gameName) ?></h1>


<?php if (empty($listPersonnage)): ?>
    <p class="no-perso">Aucun personnage en base pour le moment.</p>
<?php else: ?>
    <div class="grid">
        <?php foreach ($listPersonnage as $p): ?>
            <article class="card element-<?= strtolower($this->e($p->getElement()?->getName() ?? 'none')) ?>">
            <div class="card__top-actions">
                    <a class="icon-btn edit"
                       href="index.php?action=edit-perso&idPerso=<?= $this->e($p->getId()) ?>"
                       title="Modifier">
                        <img src="public/img/Edit-Icon.png" alt="Edit">
                    </a>

                    <a class="icon-btn delete"
                       href="index.php?action=del-perso&idPerso=<?= $this->e($p->getId()) ?>"
                       title="Supprimer">
                        ✕
                    </a>
                </div>

                    <a class="card__imgwrap" href="<?= $this->e($p->getUrlImg()) ?>">
                    <img class="card__img" src="<?= $this->e($p->getUrlImg()) ?>" alt="<?= $this->e($p->getName()) ?>">
                </a>

                <div class="card__meta">
                    <div class="card__name"><?= $this->e($p->getName()) ?>
                        <?= str_repeat('★', (int)$p->getRarity()) ?>
                    </div>
                    <div>
                        <?php if ($p->getElement()?->getUrlImg()): ?>
                            <img class="element-icon" src="<?= $this->e($p->getElement()->getUrlImg()) ?>" alt="Element">
                        <?php endif; ?>

                        <?php if ($p->getUnitclass()?->getUrlImg()): ?>
                            <img class="element-icon" src="<?= $this->e($p->getUnitclass()->getUrlImg()) ?>" alt="Unitclass">
                        <?php endif; ?>

                        <?php if (!empty($p->getOrigin()?->getName())): ?>
                            <img class="element-icon" src="<?= $this->e($p->getOrigin()?->getUrlImg() ?? '') ?>" alt="Origin">
                        <?php endif; ?>
                    </div>

                </div>

            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
