<?php
    // récupération de la base de données
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : problème de connexion à la base de données : ' .$e->getMessage());
    }
