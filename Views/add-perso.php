<?php
$data = $data ?? [];
$modeEdit = !empty($data['idPerso']); // ou $data['__mode'] === 'edit'
$formAction = $modeEdit ? 'edit-perso' : 'add-perso';
$pageTitle = $modeEdit ? 'Modifier un personnage' : 'Ajouter un personnage';
$btnText = $modeEdit ? 'Mettre à jour' : 'Enregistrer';

$this->layout('template', ['title' => $modeEdit ? 'Edit Perso' : 'Add Perso', 'message' => $message ?? null]);
function sel($data, $key, $value): string {return (isset($data[$key]) && $data[$key] == $value) ? 'selected' : '';}

?>



<h1><?= $this->e($pageTitle) ?></h1>

<div class="form-card">
    <form method="post" action="index.php?action=<?= $this->e($formAction) ?>">
        <div class="form-grid">

            <div class="field">
                <label for="name">Nom</label>
                <input id="name" name="name" type="text"
                       placeholder="ex: Diluc"
                       value="<?= $this->e($data['name'] ?? '') ?>" required>
            </div>

            <div class="field">
                <label for="element">Élément</label>
                <select id="element" name="element" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($elements as $el): ?>
                        <option value="<?= $this->e($el->getId()) ?>"
                                <?= (!empty($data['element']) && (int)$data['element'] === $el->getId()) ? 'selected' : '' ?>>
                            <?= $this->e($el->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="unitclass">Arme</label>
                <select id="unitclass" name="unitclass" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($unitclasses as $u): ?>
                        <option value="<?= $this->e($u->getId()) ?>"
                                <?= (!empty($data['unitclass']) && (int)$data['unitclass'] === $u->getId()) ? 'selected' : '' ?>>
                            <?= $this->e($u->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="origin">Origine</label>
                <select id="origin" name="origin">
                    <option value="">-- Aucun --</option>
                    <?php foreach ($origins as $o): ?>
                        <option value="<?= $this->e($o->getId()) ?>"
                                <?= (!empty($data['origin']) && (int)$data['origin'] === $o->getId()) ? 'selected' : '' ?>>
                            <?= $this->e($o->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="rarity">Rareté</label>
                <select id="rarity" name="rarity" required>
                <option value="">-- Choisir --</option>
                    <option value="4" <?= sel($data,'rarity','4') ?>>4 ★</option>
                    <option value="5" <?= sel($data,'rarity','5') ?>>5 ★</option>
                </select>
            </div>

            <div class="field">
                <?php if ($modeEdit): ?>
                    <input type="hidden" name="idPerso" value="<?= $this->e($data['idPerso']) ?>">
                <?php endif; ?>
            </div>

            <div class="field field--full">
                <label for="url_img">URL image (gacha_splash)</label>
                <input id="url_img" name="url_img" type="url"
                       placeholder="https://gensh.honeyhunterworld.com/img/....webp"
                       value="<?= $this->e($data['url_img'] ?? '') ?>" required>
            </div>
        </div>

        <div class="img-preview" id="imgPreview">
            <span></span>
        </div>

        <div class="form-actions">
            <a class="btn" href="index.php">Annuler</a>
            <button class="btn btn--primary" type="submit"><?= $this->e($btnText) ?></button>
        </div>
    </form>
</div>

<script>
    const input = document.getElementById('url_img');
    const preview = document.getElementById('imgPreview');

    function showPreview(url){
        if (!url) {
            preview.innerHTML = '<span></span>';
            return;
        }
        const img = new Image();
        img.src = url;
        img.onload = () => {
            preview.innerHTML = '';
            preview.appendChild(img);
        };
        img.onerror = () => {
            preview.innerHTML = '<span>Image invalide</span>';
        };
    }

    input.addEventListener('input', () => {
        showPreview(input.value.trim());
    });

    showPreview(input.value.trim());
</script>