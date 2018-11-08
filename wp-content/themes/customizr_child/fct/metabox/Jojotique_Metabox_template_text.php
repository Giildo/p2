<div class="meta-box-item-title">
	<h4><?= $champ->label() ?></h4>
</div>
<div class="meta-box-item-content">
	<input type="<?= $champ->type() ?>" name="<?= $champ->id() ?>" id="<?= $champ->id() ?>" placeholder="<?= $champ->valeurExemple() ?>" value="<?= $champ->valeurParDefaut() ?>" style="width: 100%;" />
</div>
<br />