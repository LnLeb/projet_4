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

<!-- Zone de mise à jour du billet sélectionné, avec TyniMce -->
<article class="articleChapitre">
    <h2>Mise à jour d'un chapitre : </h2>
    <form method="post" action="index.php?action=admin&rubrique=update&id=<?= $billet['id']; ?>">
        <label for="titre">Titre : </label><br>
        <input type="text" name="titre" id="titre" value="<?= $billet['titre']; ?>"><br>
        <label for="extrait">Extrait : </label><br>
        <textarea name="extrait" id="extrait" rows="8" ><?= $billet['extrait']; ?></textarea><br>
        <label for="contenu">Contenu : </label><br>
        <textarea name="contenu" id="contenuAdmin" rows="40"><?= $billet['contenu']; ?></textarea><br>
        <input type="submit" value="mettre à jour">
    </form>
</article>

<script type="text/javascript" src="contenu/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinyMCE.init({
    mode : "textareas",
    theme : "modern"
    });
</script>