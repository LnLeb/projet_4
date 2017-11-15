<?php $this->titre = 'Administration'; ?>
<!-- navigation dans l'administration -->
<nav>
    <ul>
        <li><a href='index.php?action=admin'>Chapitres en ligne</a></li>
        <li><a href='index.php?action=admin&rubrique=nouveauChapitre'>Nouveau chapitre</a></li>
        <li><a href='#gestionComm'>Gestion des commentaires</a></li>
        <li><a href='index.php?action=admin&rubrique=deconnexion'>Déconnexion</a></li>
    </ul>
</nav>

<!-- zone de création d'un nouveau chapitre avec tinyMce -->
<article class="articleChapitre">
    <h2>Création d'un nouveau billet : </h2>
    <form method="post" action="index.php?action=admin&rubrique=postBillet">
        <label for="titre">Titre : </label><br>
        <input type="text" name="titre" id="titre"><br>
        <label for="extrait">Extrait : </label><br>
        <textarea name="extrait" id="extrait" rows="8" ></textarea><br>
        <label for="contenu">Contenu : </label><br>
        <textarea name="contenu" id="contenuAdmin" rows="40"></textarea><br>
        <input type="submit" value="publier">
    </form>
</article>

<script type="text/javascript" src="contenu/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinyMCE.init({
    mode : "textareas",
    theme : "modern"
    });
</script>