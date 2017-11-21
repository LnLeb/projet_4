<?php $this->titre = 'Administration'; ?>

<nav>
    <ul>
        <li><a href="index.php?action=admin" title="Accueil de l'administration">Chapitres en cours d'écriture</a></li>
        <li><a href="index.php?action=admin#chapitresEnLigne" title="Chapitres déjà publiés">Chapitres en ligne</a></li>
        <li><a href="index.php?action=admin#gestionComm" title="Commentaires signalés">Gestion des commentaires</a></li>
    </ul>
</nav>
<section id="apercu">
    <div class="sectionCom">
        <h2><?= $chapitre['titre']; ?></h2>
        <p><?= $chapitre['contenu']; ?></p>

        <a href="index.php?action=admin">retour</a> | 
        <a href="index.php?action=admin&rubrique=updateChap&id=<?= $chapitre['id']; ?>">modifier</a> | 
        <a href="index.php?action=admin&rubrique=deleteChapitre&id=<?=$chapitre['id']; ?>">supprimer</a> | 
        <a>publier</a>
    </div>
</section>