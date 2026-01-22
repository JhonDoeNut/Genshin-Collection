<?php
$data = $data ?? [];
$this->layout('template', ['title' => 'Add Attribute', 'message' => $message ?? null]);

function sel($data, $key, $value): string {
    return (isset($data[$key]) && $data[$key] == $value) ? 'selected' : '';
}
?>

<h1>Ajouter un attribut</h1>

<div class="form-card">
    <form method="post" action="index.php?action=add-perso-attribute">
        <div class="form-grid">

            <div class="field">
                <label for="type">Type</label>
                <select id="type" name="type" required>
                    <option value="">-- Type --</option>
                    <option value="origin" <?= sel($data, 'type', 'origin') ?>>Origin</option>
                    <option value="element" <?= sel($data, 'type', 'element') ?>>Element</option>
                    <option value="unitclass" <?= sel($data, 'type', 'unitclass') ?>>UnitClass</option>
                </select>
            </div>

            <div class="field">
                <label for="name">Nom</label>
                <input id="name" name="name" type="text"
                       placeholder="ex: Pyro / Mondstadt / Sword"
                       value="<?= $this->e($data['name'] ?? '') ?>"
                       required>
            </div>

            <div class="field field--full">
                <label for="url_img">URL image</label>
                <input id="url_img" name="url_img" type="url"
                       placeholder="https://.../image.webp"
                       value="<?= $this->e($data['url_img'] ?? '') ?>"
                       required>
            </div>

        </div>

        <div class="img-preview" id="imgPreview">
            <span></span>
        </div>

        <div class="form-actions">
            <a class="btn" href="index.php">Annuler</a>
            <button class="btn btn--primary" type="submit">Enregistrer</button>
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
