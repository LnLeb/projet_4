<?php

class ControleurErreur 
{
    // Affiche une erreur
    public function erreur($msgErreur) 
    {
        $vue = new Vue('erreur');
        $vue->generer(array('erreur' => $msgErreur));
    }
}
