<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Commentaires</title>
        <link rel="stylesheet" href="../../vue/blog/css.css">
    </head>
    
    <body>
        <h1>Mon super blog !</h1>
        <!-- Lien vers la page des billets -->
        <p><a href="../../controleur/blog/index.php">Retour à la liste des billets</a></p>
        
        <!-- Affichage du bon billet -->
        <article class="news">
            <h3>
                <?php echo htmlspecialchars($billet['titre']); ?> 
                <em>Le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
            </h3>
            <p><?php echo nl2br(htmlspecialchars($billet['contenu'])); ?></p>
        </article>
        
        
        <!-- Commentaires -->
        <h2>Commentaires</h2>
        
        <?php 
        
        foreach($commentaires as $commentaire)
        {
            
        ?>
        <p>
            <strong><?php echo $commentaire['auteur']; ?></strong> Le <?php echo $commentaire['date_comm']; ?> à <?php echo $commentaire['heure_comm']; ?><br>
            <?php echo $commentaire['commentaire']; ?>
        </p>
        
        <?php
        }
        ?>

        
    </body>
</html>
