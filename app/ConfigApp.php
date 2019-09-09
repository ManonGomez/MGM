<?php
namespace App;

//class qui permet d'externaliser la config dans un fichier à part
//ce fichier retourne un tableau qui contient différentes données 
// connexion à la bdd
//connecion à unsplash
//config.php esy à ajouter au .gitignore
class ConfigApp {

    private $settings = [];

    public function __construct()
    {
        //transmet toutes les données de config.php dans $settings
        $this->settings = require 'config.php';
    }

    /**
     * Permet de récuperer la donnée que l'on souhite en passant la clé en paramètre
     * exemple : dans config.php il y a $configApp['database']. Pour récupérer cette valeur
     * il faut appeler get('database')
     */
    public function get($key) {
        if ( isset($this->settings[$key]) ) {
            return $this->settings[$key];
        }
    }


}