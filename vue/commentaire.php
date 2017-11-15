<?php
// Si le numéro de billet passé par l'URL n'est pas bon
if(empty($billet))
{
    echo 'Erreur numéro billet';
}
// sinon on affiche le contenu :
else
{
$this->titre = $billet['titre']; ?>

<!-- Menu de navigation -->
<nav>
    <ul class="navigation">
        <li><a href="index.php">Accueil</a></li>
        <?php if($_GET['id'] > 1)
        {?>
        <li><a href="index.php?action=billet&id=<?= $_GET['id']-1; ?>&page=1">Chapitre précédent</a></li>
        <?php
        }?>
        <?php if($_GET['id'] < $nbBillets)
        {?>
        <li><a href="index.php?action=billet&id=<?= $_GET['id']+1; ?>&page=1">Chapitre suivant</a></li>
        <?php
        }?>
        <li><a href="#connexion">Connexion</a></li>
    </ul>
</nav>
<!-- Affichage de la connexion dans la navigation -->
<form method="post" action="index.php?action=admin" id="connexion">
    <label for="identifiant">Identifiant : </label>
    <input type="text" name="identifiant" id="identifiant"><br>
    <label for="motdepasse">Mot de passe : </label>
    <input type="password" name="motdepasse" id="motdepasse"><br>
    <input type="submit" value="Connexion">
    <a href="index.php?action=deconnexion"><button>Déconnexion</button></a>
</form>

<!-- Affichage du billet qui correspond à l'id passé dans l'URL -->
<section id="sectionCom">
    <h2><?= $billet['titre']; ?></h2>
    <p>
        <em>Publié le <?= $billet['dateCrea']; ?> à <?= $billet['heureCrea']; ?></em>
    </p>
    <p><?= $billet['contenu']; ?></p>

    <!-- Affichage des commentaires qui correspondent au bon billet --><h2 id="postComm">Commentaires</h2>
    <?php 
    if(!empty($commentaires))
    {
        foreach($commentaires as $commentaire)
        {
            if ($commentaire['id_billet'] == $_GET['id'] && $commentaire['valide'] == 'TRUE')
            {
            ?>
                <h3><?= $commentaire['auteur']; ?></h3>
                <p>
                    <em>Posté le <?= $commentaire['dateComm']; ?> à <?= $commentaire['heureComm']; ?></em>
                </p>
                <p><?= $commentaire['commentaire']; ?></p>
                <form method="post" action="index.php?action=signalerCom&idCom=<?= $commentaire['id']; ?>&idBillet=<?= $commentaire['id_billet']; ?>">
                <label for="signaler">Ce commentaire vous paraît déplacé? : </label>
                <input type="submit" name="signaler" value="Signaler">
                </form>
            <?php
            }
        }
    }
    else
    {
        echo 'Aucun commentaire';
    }
    // pagination s'il y a plus d'une page de comms
    if ($nbPages > 1)
    {
        echo '<br>Page : ';
        for($i=1; $i<$nbPages+1; $i++)
        {
        ?>
            <a href="index.php?action=billet&id=<?= $_GET['id']; ?>&page=<?= $i; ?>#postComm"><?= $i; ?></a>
        <?php
        }
    }
    ?>    
    <!-- Pour poster un nouveau commentaire -->
    <h2 id="ajoutCom">Ajouter un commentaire : </h2>
    <form method="post" action="index.php?action=commenter&id=<?= $_GET['id']; ?>&page=1">
        <p>
            <label for="auteur">Pseudo : </label><br>
            <input type="text" name="auteur" id="auteur"><br>
            <label for="comm">Commentaire : </label><br>
            <textarea name="comm" id="comm" rows="4" cols="25"></textarea><br>
            <input type="hidden" name="idBillet" value="<?= $_GET['id']; ?>">
            <input type="submit" value="Valider">
        </p>
    </form>
</section>
<?php
}
?>
