<?php
// Si le numéro de billet passé par l'URL n'est pas bon
if(empty($billet))
{
    echo 'Erreur numéro billet';
}
// sinon on affiche le contenu :
else
{
// titre de la page
$this->titre = $billet['titre']; ?>

<!-- Menu de navigation -->
<nav>
    <ul class="navigation">
        <li><a href="index.php">Accueil</a></li>
        <?php if($_GET['id'] > 1)
        {?>
        <li><a href="index.php?action=billet&id=<?php echo $_GET['id']-1; ?>&page=1">Chapitre précédent</a></li>
        <?php
        }?>
        <?php if($_GET['id'] < $nb_billets)
        {?>
        <li><a href="index.php?action=billet&id=<?php echo $_GET['id']+1; ?>&page=1">Chapitre suivant</a></li>
        <?php
        }?>
        <li>Connexion</li>
    </ul>
</nav>
<!-- Affichage de la connexion dans la navigation -->
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

<!-- Affichage du billet qui correspond à l'id passé dans l'URL -->
<section id="sectionCom">
    <h2><?php echo $billet['titre']; ?></h2>
    <p>
        <em>Posté le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
    </p>
    <p><?php echo $billet['contenu']; ?></p>

    <!-- Affichage des commentaires qui correspondent au bon billet --><h2>Commentaires</h2>
    <?php 
    // s'il n'y a pas de commentaires pour ce billet
    if (empty($commentaires))
    {
        echo 'Pas de commentaires';
    }
    // sinon on les affiche
        else 
    {
        foreach($commentaires as $commentaire)
        {
            if ($commentaire['id_billet'] == $_GET['id'])
            {
            ?>
                <h3><?php echo $commentaire['auteur']; ?></h3>
                <p>
                    <em>Posté le <?php echo $commentaire['date_comm']; ?> à <?php echo $commentaire['heure_comm']; ?></em>
                </p>
                <p><?php echo $commentaire['commentaire']; ?></p>
            <?php
            }
        }
        // pagination s'il y a plus d'une page de comms
        if ($nb_pages > 1)
        {
            echo 'Page : ';
            for($i=1; $i<$nb_pages+1; $i++)
            {
            ?>
                <a href="index.php?action=billet&id=<?php echo $_GET['id']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php
            }
        }
    }
    ?>
    
    <!-- Pour poster un nouveau commentaire -->
    <form method="post" action="index.php?action=billet&id=<?php echo $_GET['id']; ?>">
        <p>
            <label for="auteur">Pseudo : </label><br>
            <input type="text" name="auteur" id="auteur"><br>
            <label for="comm">Commentaire : </label><br>
            <textarea name="comm" id="comm" rows="4" cols="25"></textarea><br>
            <input type="hidden" name="id_billet" value="<?php echo $_GET['id']; ?>">
            <input type="submit" value="Valider">
        </p>
    </form>                
</section>
<?php
}
?>
