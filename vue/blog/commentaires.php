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
        
        <?php
        if(isset($billet_vide) AND $billet_vide == true)
        {
            echo 'Erreur numéro billet';
        }
        else
        {
        ?>
        <!-- Affichage du bon billet -->
        <article class="news">
            <h3>
                <?php echo $billet['titre']; ?> 
                <em>Le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
            </h3>
            <p><?php echo $billet['contenu']; ?></p>
        </article>

        <!-- Commentaires -->
        <h2>Commentaires</h2>
        
        <?php 
        if(isset($commentaire_vide) AND $commentaire_vide == true) {
            echo 'Pas de commentaires';
        }
        else
        {
        foreach($commentaires as $commentaire)
        {
            if ($commentaire['id_billet'] == $_GET['billet'])
            {
        ?>
        <p>
            <strong><?php echo $commentaire['auteur']; ?></strong> Le <?php echo $commentaire['date_comm']; ?> à <?php echo $commentaire['heure_comm']; ?><br>
            <?php echo $commentaire['commentaire']; ?>
        </p>
        
        <?php
            }
        }
        }
        ?>
        
        <!-- Ajout de commentaires -->
        <form method="post" action="../../modele/blog/get_commentaires.php">
            <p>
                <label for="auteur">Pseudo : </label><br>
                <input type="text" name="auteur" id="auteur"><br>
                <label for="comm">Commentaire :</label><br>
                <textarea name="comm" id="comm" rows="4" cols="25"></textarea><br>
                <input type="hidden" name="id_billet" value="<?php echo $_GET['billet']; ?>">
                <input type="submit" value="Valider">
            </p>
        </form>
        <?php
        }
        ?>
    </body>
</html>
