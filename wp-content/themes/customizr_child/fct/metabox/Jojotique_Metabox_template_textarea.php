<div class="meta-box-item-title">
	<h4><?= $champ->label() ?></h4>
</div>
<div class="meta-box-item-content">
	<textarea type="<?= $champ->type() ?>" name="<?= $champ->id() ?>" id="<?= $champ->id() ?>" placeholder="<?= $champ->valeurExemple() ?>" style="width: 100%;" /><?= $champ->valeurParDefaut() ?></textarea>
</div>
<br />