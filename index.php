<?php
// On inclut le routeur qui gère l'affichage des pages en fonction des paramètres transmis par l'url ou affiche des messages d'erreur
require('controleur/Routeur.php');

// création d'un objet routeur pour utiliser sa méthode requête
$routeur = new Routeur();
$routeur->routerRequete();
