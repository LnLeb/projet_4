<?php session_start(); ?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <title><?php $title ?></title>
        <link rel="stylesheet" href="contenu/projet4.css?<? echo time(); ?>">
        <link rel="icon" href="contenu/img/favicon.jpg">
    </head>
    
    <body>
        <div id="conteneur">
            <header>
                <h1>Billet simple pour l'Alaska</h1>
                <p>Jean Forteroche</p>
                <nav>
                    <ul>
                        <li>Accueil</li>
                        <li>Les chapitres</li>
                        <li>Connexion</li>
                    </ul>
                </nav>
                <ul id="chapitres">
                <?php foreach($billets as $this->billet->accueil()->$allBillets);
                {?>
                    <li><a href="index.php?action=billet&id=<?php echo $billet['id']; ?>"><?php echo $billet['titre']; ?></a></li>
                <?php }?>
                </ul>
                <form method="post" action="index.php?action=admin" id="connexion">
                    <label for="identifiant">Identifiant : </label>
                    <input type="text" name="identifiant" id="identifiant"><br>
                    <label for="motdepasse">Mot de passe : </label>
                    <input type="password" name="motdepasse" id="motdepasse"><br>
                    <input type="submit" value="Connexion">
                    <button><a href="index.php">Déconnexion</a></button>
                </form>
                <?php 
                if (isset($_POST['identifiant']) AND $_POST['identifiant'] != "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] != "alaska2.0") 
                {
                    echo '<p id="erreur">Identifiant ou mot de passe incorrect</p>';
                }
                ?>
            </header>
            <section>
                <?php $contenu ?>
            </section>
            <footer>
                <p>Site école réalisé par Hélène Leblanc pour OpenClassrooms, projet 4 du parcours Développeur Web Junior<br>
                hébergeur : 1&amp;1. Adresse postale : 1&amp;1 Internet SARL, 7 place de la Gare, BP 70109, 57201 Sarreguemines Cedex<br>
                Images libres de droit récupérées sur pixabay.com, wikipedia.org et wikimedia.org</p>
            </footer>
        </div>
    </body>

</html>
