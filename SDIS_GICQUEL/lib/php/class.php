<?php 

class Pompier{
    
    //Variables
    protected $_matricule;
    protected $_nom;
    protected $_prenom;
    protected $_dateNaissance;
    protected $_statut;
    protected $_grade;
    protected $_dateObtention;
    protected $_recepteur;
    protected $_telFixe;
    protected $_telPortable;
    
    //Constructeurs
    function __construct($id, $libelle) {
        $this->_id = $id;
        $this->_libelle = $libelle;
    }
    
    
    //Accesseurs
}


?>