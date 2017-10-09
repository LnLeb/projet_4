<?php
if(isset($billet_vide) AND $billet_vide == true)
{
    echo 'Erreur numéro billet';
}
else
{
?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <title><?php echo $billet['titre']; ?></title>
        <link rel="stylesheet" href="../../vue/blog/projet4.css">
    </head>
    
    <body>
         <header>
            <h1><a href="../../controleur/blog/index.php">Billet simple pour l'Alaska</a></h1>
            <p>Jean Forteroche</p>
        </header>
        <section>
            <aside>
                <p>Connexion à l'administration : </p>
                <form method="post" action="../../modele/blog/admin.php">
                    <label for="identifiant">Identifiant : </label>
                    <input type="text" name="identifiant" id="identifiant"> <br>
                    <label for="motdepasse">Mot de passe : </label>
                    <input type="password" name="motdepasse" id="motdepasse"> <br>
                    <input type="submit" value="Valider">
                </form>
            </aside>
            <article>
                <h2>Chapitre <?php echo $billet['id']; ?></h2>
                <h3>
                    <?php echo $billet['titre']; ?>
                </h3>
                <p>
                    <em>Posté le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
                </p>
                <p>
                    <?php echo $billet['contenu']; ?>
                </p>
            </article>
            <article>
                <h2>Commentaires</h2>
                
                <?php 
                if (isset($commentaire_vide) AND $commentaire_vide == true)
                {
                    echo 'Pas de commentaires';
                }
                else 
                {
                    foreach($commentaires as $commentaire)
                    {
                        if ($commentaire['id_billet'] == $_GET['billet'])
                        {
                ?>
                  
                <h3>
                    <?php echo $commentaire['auteur']; ?>
                </h3>
                <p>
                    <em>Posté le <?php echo $commentaire['date_comm']; ?> à <?php echo $commentaire['heure_comm']; ?></em>
                </p>
                <p>
                    <?php echo $commentaire['commentaire']; ?>
                </p>
                
                <?php
                        }
                    }
                }
                ?>
                
                <form method="post" action="../../modele/blog/add_commentaires.php">
                    <p>
                        <label for="auteur">Pseudo : </label><br>
                        <input type="text" name="auteur" id="auteur"><br>
                        <label for="comm">Commentaire : </label><br>
                        <textarea name="comm" id="comm" rows="4" cols="25"></textarea><br>
                        <input type="hidden" name="id_billet" value="<?php echo $GET_['billet']; ?>">
                        <input type="submit" value="Valider">
                    </p>
                </form>                
            </article>
        </section>
    </body>
</html>

<?php
}
?>
