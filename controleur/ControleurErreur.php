<?php

class ControleurErreur 
{
    // Affiche une erreur
    public function erreur($msgErreur) 
    {
        require('vue/erreur.php');
    }
}