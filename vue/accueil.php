<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
    <h2>Présentation du concept : </h2>
    <p>"Amis lecteurs, je vous souhaite la bienvenue dans cette toute nouvelle aventure! J'ai décidé d'écrire ce troisième roman de façon toute particulière : je posterai les chapitres sur ce blog, les uns après les autres, une fois qu'ils seront rédigés, et m'aiderai de vos commentaires pour écrire la suite. Etes-vous prêts à partager cette histoire avec moi? Inspirée par vous, écrite pour vous, en voici le commencement..." <br>
    Jean Forteroche</p>
    <h2>Derniers chapitres :</h2>

    <?php
    foreach($billets as $billet)
        {
    ?>
    <h3><?php echo $billet['titre']; ?></h3>
    <p>
        <em>Posté le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
    </p>
    <p>
        <?php echo $billet['extrait']; ?><br>
        <em><a href="index.php?action=billet&id=<?php echo $billet['id']; ?>">Lire tout le chapitre</a></em>
    </p>
    <?php
    }
    ?>
<?php $article = ob_get_clean(); ?>

<?php ob_start(); ?>
    <h3>Présentation de l'auteur : </h3>
    <img src="contenu/img/portrait.jpg" alt="portrait Jean Forteroche">
    <p>Jean Forteroche est né en 1955 à Paris. Après de brillantes études à la Sorbonne, il décide de tout quitter et part seul en Alaska. De retour en France, il entreprend d'écrire des romans pour raconter son aventure. "Billet simple pour l'Alaska" fait suite à "Seul au bout du monde" et "La neige et le froid". </p>
<?php $aside = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
