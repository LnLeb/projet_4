<?php 
$this->titre = 'Billet simple pour l\'Alaska'; 

if (isset($_SESSION['identifiant'])){
    $connexion = '?action=admin';
}
else {
    $connexion = '#connexion';
}
?>
<article id="navigation">
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#chapitres">Les chapitres</a></li>
            <li><a href="index.php<?= $connexion ?>">Connexion</a></li>
        </ul>
    </nav>
    <!-- Affichage des chapitres dans la navigation -->
    <ul id="chapitres">
    <?php foreach($allBillets as $billet)
    {
    ?>
        <li><a href="index.php?action=billet&id=<?= $billet['id']; ?>&page=1"><?= $billet['titre']; ?></a></li>
        <?php }?>
    </ul>
    <!-- Affichage de la connexion dans la navigation -->
    <form method="post" action="index.php?action=admin" id="connexion">
        <label for="identifiant">Identifiant : </label>
        <input type="text" name="identifiant" id="identifiant"><br>
        <label for="motdepasse">Mot de passe : </label>
        <input type="password" name="motdepasse" id="motdepasse"><br>
        <input type="submit" value="Se connecter" class="bouton">
        <p class="errInfo">
        <?php 
        if(isset($_SESSION['info']) || $_SESSION['info'] != '')
        {
            echo $_SESSION['info']; 
        }
        ?>
        </p>
    </form>
</article>

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
                    <h3><?= $billet['titre']; ?></h3>
                    <p>
                        <em>Posté le <?= $billet['dateCrea']; ?> à <?= $billet['heureCrea']; ?></em>
                    </p>
                    <p><?= $billet['extrait']; ?>..</p>
                    <em><a href="index.php?action=billet&id=<?= $billet['id']; ?>&page=1">Lire le chapitre</a></em>
                </div>
            <?php
            }
            ?>
            </div>
        </article>

        <!-- présentation de l'auteur et derniers chapitres publiés -->
        <aside>
            <div id="asidePres">
                <h2>Présentation de l'auteur : </h2>
                <img src="contenu/img/portrait.jpg" alt="portrait Jean Forteroche">
                <p>Jean Forteroche est né en 1955 à Paris. Après de brillantes études à la Sorbonne, il décide de tout quitter et part seul en Alaska. De retour en France, il entreprend d'écrire des romans pour raconter son aventure. "Billet simple pour l'Alaska" fait suite à "Seul au bout du monde" et "La neige et le froid". </p>
            </div>
            
            <!-- trois derniers commentaires publiés -->
            <div id="asideCom">
                <h2 id="comRec">Commentaires récents : </h2>
                <?php 
                foreach($derniersCommentaires as $commentaire)
                {
                    ?>
                        <h3><?= $commentaire['auteur']; ?></h3>
                        <p>
                            <em>Posté le <?= $commentaire['dateComm']; ?> à <?= $commentaire['heureComm']; ?></em>
                        </p>
                        <p>" <?= $commentaire['commentaire']; ?> "</p>
                    <?php
                }
                ?>
            </div>
        </aside>
    </section>
