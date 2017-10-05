<?php
    if(isset($_POST['identifiant']) AND $_POST['identifiant'] == "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] == "alaska")
        {
?>
<!doctype html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>Gestion du blog</title>
        <link rel="stylesheet" href="../../vue/blog/css.css">
    </head>
    
    <body>
        <h1>Interface de gestion du blog</h1>
        <!-- Lien vers la page des billets -->
        <p><a href="../../controleur/blog/index.php">Retour à la liste des billets</a></p>
        
        <!-- Ajout de billet -->
        <h2>Création d'un nouveau billet</h2>
        <form method="post" action="../../modele/blog/ajout_billet.php">
            <p>
                <label for="titre">Titre : </label><br>
                <input type="text" name="titre" id="titre"><br>
                <textarea name="contenu" id="contenu" rows="4" cols="25"></textarea><br>
                <input type="submit" value="poster">
            </p>
        </form>
    </body>
</html>

<?php
} else
{
    echo 'Identifiant ou mot de passe incorrect';
}