<?php

include_once('Jojotique_Champ.php');
include_once(__DIR__ . '/../general/Hydratateur.php');

/**
* Créer des champs personnalisés qui pourront être utilisé au sein des articles pour ajouter des informations simplement.
* @author Jojotique
* @version 1.0
*/

class Jojotique_Metabox
{
	protected $id, $titre, $postTypeAssocie, $champs = [];

	public function __construct(array $donnees)
	{
		add_action('admin_init', array(&$this, 'initialisation')); //Initialise que si on est dans un menu administrateur
		add_action('save_post', array(&$this, 'sauvegarde')); //Initialise la fonction de sauvegarde quand on sauvegarde l'article

		$this->hydrate($donnees, array('id', 'titre', 'postTypeAssocie'));
	}

	use Hydratateur;

	public function initialisation() {
		//Si la fonction existe
		if (function_exists('add_meta_box')) {
			add_meta_box($this->id, $this->titre, array(&$this, 'miseEnForme'), $this->postTypeAssocie); //Ajout de la fenêtre dans chalets avec un ID
		}
	}

	public function sauvegarde($post_id) {
		// Pas de sauvegarde auto, sauvegarde AJAX et sortie si le POST n'existe pas
		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX)) {
			return false;
		}

		//Vérification que l'utilisateur peut sauvegarder
		if (!current_user_can('edit_post', $post_id)) {
			return false;
		}

		//Vérification du "nonce"
		if (!wp_verify_nonce($_POST[$this->id . '_once'], $this->id)) {
			return false;
		}

		foreach ($this->champs as $champ) {
			$value = $_POST[$champ->id()];

			if (isset($_POST[$champ->id()])) {
				if (get_post_meta($post_id, $champ->id())) {
					update_post_meta($post_id, $champ->id(), $value);
				} else if ($value == '') {
					delete_post_meta($post_id, $champ->id());
				} else {
					add_post_meta($post_id, $champ->id(), $value);
				}
			}
		}
	}

	public function miseEnForme() {
		global $post; //Variable globale pour récupérer l'ID de l'article passé en POST

		foreach ($this->champs as $champ) {
			$valeur = get_post_meta($post->ID, $champ->id(), true); //Je vérifie si la valeur est définie en POST

			if ($valeur != '') {
				$champ->setValeurParDefaut($valeur); //Et la rentre dans l'objet si c'est le cas
			}

			require('templates/Jojotique_Metabox_' . $champ->type() . '.php');
		}
		//Vérifie que le formulaire a été envoyé depuis la page
		echo '<input type="hidden" name="' . $this->id . '_once" id="' . $this->id . '_once" value="' . wp_create_nonce($this->id) .'" />';
	}

	public function ajoutChamp(array $donnees) {
		$this->champs[] = new Jojotique_Champ($donnees);
		return $this; //On retourne l'objet pour pouvoir enchainer les appels de la fonction les uns après les autres
	}

	public static function JSInsertMedia() {
		add_action('admin_enqueue_scripts', function(){
			wp_register_script('jjt_uploaderJS', get_template_directory_uri() . '/../customizr_child/fct/js/js_jojotique_insert_media.js');
			wp_enqueue_script('jjt_uploaderJS');
		});
	}

	public static function ACFAffichage(int $id, string $meta, string $label, string $suffixe) {
		if (get_post_meta($id, $meta, true) != '') {
			echo '<p>' . $label . ' : ' . get_post_meta($id, $meta, true) . $suffixe . '</p>';
		} else {
			return false;
		}
	}

	public static function diaporama(int $id) {
		if (get_post_meta($id, 'jojotique_photos', true) != '') {
			$adresses = explode(',', get_post_meta($id, 'jojotique_photos', true)); //Découpe la chaine de caractère en BdD par rapport aux "," et le renvoie
			$liste_adresse = array();
			foreach ($adresses as $adresse) {
				$adresseTronquee = explode('.jpg', $adresse); //Récupère l'adresse et on lui enlève le ".jpg"
				$liste_adresse[]= $adresseTronquee[0] . '-270x250.jpg'; //Rajoute le suffixe et le rajoute au tableau
			}
			return $liste_adresse;
		} else {
			return false; //Si rien BdD renvoie false
		}
	}

	public static function adressePrincipale(string $adresse) {
		$adresseTronquee = explode('-270x250.jpg', $adresse);
		return $adresseTronquee[0] . '.jpg';
	}

	//Getter
	public function id() { return $this->id; }
	public function titre() { return $this->titre; }
	public function postTypeAssocie() { return $this->postTypeAssocie; }
	public function champs() { return $this->champs; }

	//Setters
	public function setId(string $id) {
		$this->id = $id;
	}

	public function setTitre(string $titre) {
		$this->titre = $titre;
	}

	public function setPostTypeAssocie(string $postTypeAssocie) {
		$this->postTypeAssocie = $postTypeAssocie;
	}
}
