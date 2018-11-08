<div class="meta-box-item-title">
	<h4><?= $champ->label() ?></h4>
</div>
<div class="meta-box-item-content form-group">
	<div class="input-group">
		<input type="<?= $champ->type() ?>" name="<?= $champ->id() ?>" id="<?= $champ->id() ?>" placeholder="<?= $champ->valeurExemple() ?>" value="<?= $champ->valeurParDefaut() ?>" class="form-control" <?php if($champ->tailleMax() == true) {echo('style="width:100%"');} ?> />
		<?php if($champ->elementAssocie() != '') : ?><span class="input-group-addon"><?= $champ->elementAssocie(); ?></span><?php endif; ?>
	</div>
</div>
<br />
