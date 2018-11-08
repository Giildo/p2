<div class="meta-box-item-title">
	<h4><?= $champ->label() ?></h4>
</div>
<div class="meta-box-item-content">
	<input type="<?= $champ->type() ?>" name="<?= $champ->id() ?>" id="<?= $champ->id() ?>" placeholder="<?= $champ->valeurExemple() ?>" value="<?= $champ->valeurParDefaut() ?>" />
	<button type="button" id="jojotique-insert-media-button" class="button add_media js_jojotique_insert_media" data-id="<?= $champ->id() ?>" data-editor="content" data-multiple="true">
		<span class="wp-media-buttons-icon"></span>
		Ajouter un média
	</button>
  <?php if (!empty($champ->valeurParDefaut())): ?>
    <a href="<?= $champ->valeurParDefaut(); ?>" class="thickbox" style="display: block;">
      <img src="<?= $champ->valeurParDefaut(); ?>" style="max-width: 200px; max-height: 200px;" />
    </a>
  <?php endif; ?>
</div>
<br />

<!--
	Ajout d'un bouton qui charge les média qui se trouve dans le champ.
	Il a la class 'js_jojotique_insert_media' qui est retravaillé en JS pour lancer la boite des média
	Il a un data-id pour retrouver le champ qui lui ai associé
-->
