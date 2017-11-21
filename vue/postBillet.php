<?php $this->titre = 'Administration'; ?>

<nav>
    <ul>
        <li><a href="index.php?action=admin" title="Accueil de l'administration">Chapitres en cours d'écriture</a></li>
        <li><a href="index.php?action=admin#chapitresEnLigne" title="Chapitres déjà publiés">Chapitres en ligne</a></li>
        <li><a href="index.php?action=admin#gestionComm" title="Commentaires signalés">Gestion des commentaires</a></li>
    </ul>
</nav>


<section class="adminUpdate">
    <div class="administration">
        <!-- Zone de mise à jour du chapitre en cours d'écriture sélectionné, avec TyniMce -->
        <article class="articleChapitre">
            <h2>Publication du chapitre en cours d'écriture : </h2>
            <form method="post" action="index.php?action=admin&rubrique=postBillet&id=<?= $chapitre['id']; ?>">
                <label for="titre">Titre : </label><br>
                <input type="text" name="titre" id="titre" value="<?= $chapitre['titre']; ?>"><br>
                <label for="extrait">Extrait : </label><br>
                <textarea name="extrait" id="extrait" rows="8" ><?= $chapitre['extrait']; ?></textarea><br>
                <label for="contenu">Contenu : </label><br>
                <input type="hidden" name="id" value="<?= $chapitre['id']; ?>">
                <textarea name="contenu" id="contenuAdmin" rows="40"><?= $chapitre['contenu']; ?></textarea><br>
                <input type="submit" value="publier" class="bouton">
            </form>
        </article>
    </div>
</section>

<script type="text/javascript" src="contenu/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinyMCE.init({
    mode : "textareas",
    theme : "modern"
    });
</script>