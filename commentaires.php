<!doctype html>

<html>

    <head>
        <meta charset="utf-8">
        <title>Commentaires</title>
        <link rel="stylesheet" href="css.css">
    </head>
    
    <body>
        <h1>Mon super blog !</h1>
        <!-- Lien vers la page des billets -->
        <p><a href="index.php">Retour à la liste des billets</a></p>
        
        <?php 
        // connexion à la bdd
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
        // récupération du billet qui correspond à l'id transmis par l'url
        $req = $bdd->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%imin%ss\') AS heure_crea FROM billets WHERE id=?');
        $req->execute(array($_GET['ref']));
        $donnees = $req->fetch();
        ?>
        
        <!-- Affiche l'article concerné -->
        <article class="news">
            <h3>
                <?php echo htmlspecialchars($donnees['titre']); ?> 
                <em>Le <?php echo $donnees['date_crea']; ?> à <?php echo $donnees['heure_crea']; ?></em>
            </h3>
            <p><?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?></p>
        </article>
        
        <h2>Commentaires</h2>
        
        <?php
        // fin de la première requête
        $req->closeCursor();
        
        // deuxième requête : les commentaires qui correspondent au bon article
        $req = $bdd->prepare('SELECT id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%imin%ss\') AS heure_comm FROM commentaires WHERE id_billet=? ORDER BY date_commentaire');
        $req->execute(array($_GET['ref']));
        // Affiche tous les commentaires de l'article
        while ($donnees = $req->fetch())
        {
        ?>
        
        <p>
            <strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_comm']; ?> à <?php echo $donnees['heure_comm']; ?><br>
            <?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?>
        </p>
        
        <?php 
        }
        // fin de la deuxième requête
        $req->closeCursor();
        ?>
        
    </body>

</html>