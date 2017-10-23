<?php

require_once ('modele/BilletManager.php');
require_once ('modele/CommentaireManager.php');
require_once ('vue/Vue.php');

class ControleurAdmin
{
    
        private $billet;
    
    public function __construct()
    {
        $this->billet = new BilletManager();
    }
    
    public function admin()
    {
        if ((isset($_POST['identifiant']) AND $_POST['identifiant'] == "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] == "alaska2.0") OR (isset($_SESSION['identifiant'])))
        {
            $_SESSION['identifiant']=$_POST['identifiant'];
            
            $billets = $this->billet->get_billets(0, 500);
        
            // sécurisation de l'affichage
            foreach($billets as $cle=>$this->billet)
            {
                $billets[$cle]['titre'] = htmlspecialchars($this->billet->titre());
            }
            
            // on affiche la page (vue)
            $vue = new Vue('admin');
            $vue->generer(array('billet' => $billet));
        }
        else 
        {
            require('index.php');
        }
    }
    
    public function deconnexion()
    {
        if(isset($_SESSION['identifiant'])) {
        session_destroy(); 
        } 
        require('index.php');
    }
}
