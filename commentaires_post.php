<!doctype html>

<html>

    <head>
        <meta charset="utf-8">
        <title>Commentaires du blog</title>
    </head>
    <body>
        <?php 
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
        // on insère les infos dans la table avec une requête préparée
        $req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())');
        $req->execute(array(
        'id_billet'=>$_GET['ref'],
        'auteur'=>$_POST['auteur'],
        'commentaire'=>$_POST['comm']
        ));
        
        header('Location: commentaires.php');
        ?>
    
    </body>

</html>