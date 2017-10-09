<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Billet simple pour l'Alaska</title>
        <link rel="stylesheet" href="../../vue/blog/projet4.css">
        <link rel="icon" href="../../vue/blog/img/favicon.jpg">
    </head>
    
    <body>
        <header>
            <h1><a href="../../controleur/blog/index.php">Billet simple pour l'Alaska</a></h1>
            <p>Jean Forteroche</p>
        </header>
        <section>
            <aside>
                <p>Connexion à l'administration : </p>
                <form method="post" action="../../controleur/blog/admin.php">
                    <label for="identifiant">Identifiant : </label>
                    <input type="text" name="identifiant" id="identifiant"> <br>
                    <label for="motdepasse">Mot de passe : </label>
                    <input type="password" name="motdepasse" id="motdepasse"> <br>
                    <input type="submit" value="Valider">
                </form>
            </aside>
            <article>
            <h2>Derniers chapitres :</h2>

                <?php
                foreach($billets as $billet)
                {
                ?>
                
                <h3>
                    <?php echo $billet['titre']; ?> 
                </h3>
                <p>
                    <em>Posté le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
                </p>
                <p>
                    <?php echo $billet['extrait']; ?><br>
                    <em><a href="commentaire.php?billet=<?php echo $billet['id']; ?>">Lire tout le chapitre</a></em>
                </p>
            </article>
            
            <?php
            }
            ?>
        </section>
        
        <footer>
            <p>Mentions légales</p>
        </footer>
    </body>
    
</html>
