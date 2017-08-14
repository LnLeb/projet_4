 <?php 
        // récupération de la base de données
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
