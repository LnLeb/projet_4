<!doctype html>
<html>

    <head>
        <meta charset='utf-8'>
        <title>Mon blog</title>
        <link rel="stylesheet" href="../../vue/blog/css.css">
    </head>
    
    <body>
        <h1>Mon super blog !</h1>
        <!-- zone de connexion -->
        <p>Connexion : </p>
        <form method="post" action="../../vue/blog/gestion.php">
            <label for="identifiant">Identifiant : </label>
            <input type="text" name="identifiant" id="identifiant"> <br>
            <label for="motdepasse">Mot de passe : </label>
            <input type="password" name="motdepasse" id="motdepasse"> <br>
            <input type="submit" value="Valider">
        </form>
        <p>Derniers billets du blog :</p>
        
        <?php
        
        foreach($billets as $billet)
        {
        
        ?>
        
        <article class="news">
            <h3>
                <?php echo $billet['titre']; ?>
                <em>Le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>            
            </h3>
            <p>
                <?php echo $billet['contenu']; ?><br>
                <em><a href="commentaires.php?billet=<?php echo $billet['id']; ?>">Commentaires</a></em>
            </p>
        </article>
        <?php
        }
        ?>
    </body>

</html>
