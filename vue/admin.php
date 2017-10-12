<?php $title = 'Administration'; ?>

<?php ob_start(); ?>
        <div id="admin">
            <h2>Interface de gestion du blog</h2>
            <h3>Création d'un nouveau billet</h3>
            <form method="post" action="index.php?action=admin">
                <label for="titre">Titre : </label><br>
                <input type="text" name="titre" id="titre"><br>
                <label for="extrait">Extrait : </label><br>
                <textarea name="extrait" id="extrait" rows="10" cols="150"></textarea><br>
                <label for="contenu">Contenu : </label><br>
                <textarea name="contenu" id="contenu" rows="40" cols="150"></textarea><br>
                <input type="submit" value="publier">
            </form>
        </div>
<?php $article = ob_get_clean(); ?>

<?php $aside = ''; ?>

<?php require 'gabarit.php'; ?>