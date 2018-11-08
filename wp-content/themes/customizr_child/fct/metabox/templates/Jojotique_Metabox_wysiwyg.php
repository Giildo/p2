<div class="meta-box-item-title">
	<h4><?= $champ->label() ?></h4>
</div>
<div class="meta-box-item-content">
	<?= wp_editor( $champ->valeurParDefaut(), $champ->id()) ?>
</div>
<br />
