<!doctype html>

<html>

    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" href="css.css">
    </head>
    
    <body>
        <h1>Mon super blog !</h1>
        <p>Derniers billets du blog : </p>
        
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
        // récupération des 5 dernières entrées de la table
        $reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%imin%ss\') AS heure_crea FROM billets ORDER BY date_crea DESC LIMIT 0,5');
        while ($donnees = $reponse->fetch())
        {
        ?>
        <!-- Affichage des billets -->
        <article class="news">
            <h3>
                <?php echo htmlspecialchars($donnees['titre']); ?> 
                <em>Le <?php echo $donnees['date_crea']; ?> à <?php echo $donnees['heure_crea']; ?></em>
            </h3>
            <p>
                <?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?>
            </p>
            <!-- Lien vers la page de commentaires avec l'id du billet dans l'url -->
            <em><a href="commentaires.php?ref=<?php echo $donnees['id']; ?>">Commentaires</a></em>
        </article>
        
        <?php
        }
        // fin de la requête
        $reponse->closeCursor();
        ?>
        
    </body>

</html>