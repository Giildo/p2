<?php

include_once(__DIR__ . '/../general/Hydratateur.php');

/**
* Définit un champ sous forme d'objet pour le lire dans la page
* @param $donnees
* @author Jojotique
* @version 1.0
*/

class Jojotique_Champ
{
	protected $id, $label, $type, $valeurExemple, $valeurParDefaut, $elementAssocie, $tailleMax;

	public function __construct(array $donnees) {
		$this->hydrate($donnees, array('id', 'label', 'type', 'valeurExemple', 'valeurParDefaut', 'elementAssocie', 'tailleMax'));
	}

	use Hydratateur;

	//Getter
	public function id() { return $this->id; }
	public function label() { return $this->label; }
	public function type() { return $this->type; }
	public function valeurExemple() { return $this->valeurExemple; }
	public function valeurParDefaut() { return $this->valeurParDefaut; }
	public function elementAssocie() { return $this->elementAssocie; }
	public function tailleMax() { return $this->tailleMax; }

	//Setter
	public function setId(string $id)
	{
		$this->id = $id;
	}

	public function setLabel(string $label)
	{
		$this->label = $label;
	}

	public function setType(string $type = 'text')
	{
		$this->type = $type;
	}

	public function setValeurExemple(string $valeurExemple = '')
	{
		$this->valeurExemple = $valeurExemple;
	}

	public function setValeurParDefaut(string $valeurParDefaut = '')
	{
		$this->valeurParDefaut = $valeurParDefaut;
	}

	public function setElementAssocie(string $elementAssocie = '')
	{
		$this->elementAssocie = $elementAssocie;
	}

	public function setTailleMax(bool $tailleMax = false)
	{
		$this->tailleMax = $tailleMax;
	}
}
