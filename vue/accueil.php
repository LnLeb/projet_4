<?php 
// titre de la page
$this->titre = 'Billet simple pour l\'Alaska'; 
?>

<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li>Les chapitres</li>
        <li>Connexion</li>
    </ul>
</nav>
    <!-- Affichage des chapitres dans la navigation -->
    <ul id="chapitres">
    <?php foreach($allBillets as $billet)
    {
    ?>
        <li><a href="index.php?action=billet&id=<?php echo $billet['id']; ?>&page=1"><?php echo $billet['titre']; ?></a></li>
        <?php }?>
    </ul>
    <!-- Affichage de la connexion dans la navigation -->
    <form method="post" action="index.php?action=admin" id="connexion">
        <label for="identifiant">Identifiant : </label>
        <input type="text" name="identifiant" id="identifiant"><br>
        <label for="motdepasse">Mot de passe : </label>
        <input type="password" name="motdepasse" id="motdepasse"><br>
        <input type="submit" value="Connexion">
        <button><a href="index.php">Déconnexion</a></button>
        <?php
        if (isset($_POST['identifiant']) AND $_POST['identifiant'] != "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] != "alaska2.0") 
        {
            echo '<p id="erreur">Identifiant ou mot de passe incorrect</p>';
        }
        ?>
    </form>

<section id="contenuAccueil">
    <article id="presentation">
        
        <!-- Présentation du blog -->
        <img src="contenu/img/alaska.jpg" alt="Alaska">
        <p id="textePresentation">"Amis lecteurs, je vous souhaite la bienvenue dans cette toute nouvelle aventure! J'ai décidé d'écrire ce troisième roman de façon toute particulière : je posterai les chapitres sur ce blog, les uns après les autres, une fois qu'ils seront rédigés, et m'aiderai de vos commentaires pour écrire la suite. Etes-vous prêts à partager cette histoire avec moi? Inspirée par vous, écrite pour vous, en voici le commencement..." <br><br>
        Jean Forteroche</p>
        
        <!-- trois derniers chapitres publiés -->
        <h2>Derniers chapitres publiés :</h2>
        <div id="derniersChap">
        <?php
        foreach($derniersBillets as $billet)
        {
        ?>
            <div>
                <h3><?php echo $billet['titre']; ?></h3>
                <p>
                    <em>Posté le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
                </p>
                <p>
                    <?php echo $billet['extrait']; ?>
                </p>
                <em><a href="index.php?action=billet&id=<?php echo $billet['id']; ?>&page=1">Lire le chapitre</a></em>
            </div>
        <?php
        }
        ?>
        </div>
    </article>

    <aside>
        <img src="contenu/img/portrait.jpg" alt="portrait Jean Forteroche">
        <h2>Présentation de l'auteur : </h2>
        <p>Jean Forteroche est né en 1955 à Paris. Après de brillantes études à la Sorbonne, il décide de tout quitter et part seul en Alaska. De retour en France, il entreprend d'écrire des romans pour raconter son aventure. "Billet simple pour l'Alaska" fait suite à "Seul au bout du monde" et "La neige et le froid". </p>
        
        <!-- trois derniers commentaires publiés -->
        <h2>Commentaires récents : </h2>
        <?php 
        foreach($derniersCommentaires as $commentaire)
        {
        ?>
            <h3><?php echo $commentaire['auteur']; ?></h3>
            <p>
                <em>Posté le <?php echo $commentaire['date_comm']; ?> à <?php echo $commentaire['heure_comm']; ?></em>
            </p>
            <p><?php echo $commentaire['commentaire']; ?></p>
        <?php
        }
        ?>
    </aside>
</section>
