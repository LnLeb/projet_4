<?php
if (isset($_POST['identifiant']) AND $_POST['identifiant'] == "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] == "alaska2.0")
{
?>

<!doctype html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>Administration</title>
        <link rel="stylesheet" href="../../vue/blog/projet4.css">
    </head>
    
    <body>
        <header>
            <h1><a href="../../controleur/blog/index.php">Billet simple pour l'Alaska</a></h1>
            <p>Jean Forteroche</p>
        </header>
        <section>
            <h2>Interface de gestion du blog</h2>
            <h3>Création d'un nouveau billet</h3>
            <form method="post" action="../../modele/blog/ajout_billet.php">
                <label for="titre">Titre : </label><br>
                <input type="text" name="titre" id="titre"><br>
                <textarea name="extrait" id="extrait" rows="4" cols="25"></textarea><br>
                <textarea name="contenu" id="contenu" rows="4" cols="25"></textarea><br>
                <input type="submit" value="publier">
            </form>
        </section>
    </body>
    
</html>

<?php
}
else
{
    echo 'Identifiant ou mot de passe incorrect';
}