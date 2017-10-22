<?php

class ControleurAdmin
{
    public function admin()
    {
        if ((isset($_POST['identifiant']) AND $_POST['identifiant'] == "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] == "alaska2.0") OR (isset($_SESSION['identifiant'])))
        {
            $_SESSION['identifiant']=$_POST['identifiant'];
            // on affiche la page (vue)
            require('vue/admin.php');
        }
        else 
        {
            require('vue/accueil.php');
        }
    }
    
    public function deconnexion()
    {
        if(isset($_SESSION['identifiant'])) {
        session_destroy(); 
        } 
        require('vue/accueil.php');
    }
}