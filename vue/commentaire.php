<?php
if(isset($billet_vide) AND $billet_vide == true)
{
    echo 'Erreur numéro billet';
}
else
{
?>

<?php $title = $billet['titre']; ?>

<?php ob_start(); ?>
    <h2><?php echo $billet['titre']; ?></h2>
    <p>
        <em>Posté le <?php echo $billet['date_crea']; ?> à <?php echo $billet['heure_crea']; ?></em>
    </p>
    <p><?php echo $billet['contenu']; ?></p>
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
        }
        ?>        
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
    </article>
<?php $article = ob_get_clean(); ?>

<?php $aside = '' ?>

<?php require 'gabarit.php'; ?>

<?php
}
?>