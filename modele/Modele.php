<?php
    abstract class Modele 
    {
        // attribut : objet PDO d'accès à la BDD
        private $bdd;
        
        // Pour éxecuter des requêtes éventuellement préparées
        protected function executerRequete($sql, $params = null) 
        {
            if ($params == null) 
            {
                $resutat = $this->getBdd()->query($sql);
            }
            else 
            {
                $resultat = $this->getBdd()->prepare($sql);
                $resultat->execute($params);
            }
            return $resultat;
        }
        
        // Méthode qui renvoie l'objet de connexion à la BDD
        private function getBdd()
        {
            if ($this->bdd == null)
            {
                try
                {
                    $this->bdd = new PDO('mysql:host=localhost;dbname=projet4; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                }
                catch (Exception $e)
                {
                    $msgErreur = $e->getMessage();
                    require 'vue/erreur.php';
                }
            }
            return $this->bdd;
        }
    }
