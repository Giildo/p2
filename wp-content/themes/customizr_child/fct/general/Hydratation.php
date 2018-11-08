<?php

/**
* Hydrate les objets en appelant les setters de la fonction et en leur faisant passer la valeur en attribut
* @param $data[array] : tableau associatif regroupant les paires "attribut" => "valeur"
* @param $verificationTableau[array] = [] : tableau associatif qui est récupéré pour vérifier si toutes les paires ont été crées pour l'objet
* @author Giildo
* @version 1.1
*/

trait Hydratation
{
    public function hydrate(array $donnees, array $verificationTableau = [])
    {
        //Récupère le tableau qui vérifiera si tous les attributs de l'objet son dans le tableau "donnees", si ce n'est pas le cas il les ajoute
        foreach ($verificationTableau as $valeur) {
            if (!array_key_exists($valeur, $donnees)) {
                $donnees[$valeur] = '';
            }
        }

        //Récupère le tableau associatif qui contient les données à passer aux attributs
        foreach ($donnees as $attribut => $valeur)
        {
            //Construit le nom de la méthode setter qui sera appelée pour modifier l'attribut
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode]))
            {
                //Vérifie si la valeur est nulle, si c'est le cas, appel la méthode setter sans attribut pour récupérer la valeur par défaut de la méthode
                if ($valeur != '') {
                    $this->$methode($valeur);
                } else {
                    $this->$methode();
                }
            }
        }
    }
}