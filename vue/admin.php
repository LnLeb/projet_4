<?php $this->titre = 'Administration'; ?>
<!-- menu de navigation -->
<nav>
    <ul>
        <li><a href="index.php" title="Page de présentation">Accueil</a></li>
        <li><a href="index.php?action=admin&rubrique=nouveauChapitre" title="Création d'un chapitre">Nouveau chapitre</a></li>
        <li><a href="index.php?action=admin#gestionComm" title="Commentaires signalés">Gestion des commentaires</a></li>
        <li><a href="index.php?action=admin&rubrique=deconnexion" title="déconnexion de l'administration">Déconnexion</a></li>
    </ul>
</nav>

<!-- liste des chapitres publiés -->
<section id="admin">
    <div class=administration>
    <article id="chapitresEnCreation">
        <h2>Chapitre(s) en cours d'écriture : </h2> 
        <?php 
        if(!empty($chapitres)) {
            ?>
            <table>
                <?php
                foreach($chapitres as $chapitre)
                {
                ?>
                    <tr>
                        <h3><?= $chapitre->titre(); ?></h3>
                        <p><?= $chapitre->extrait(); ?></p>
                        <a href="index.php?action=admin&rubrique=apercu&id=<?= $chapitre->id(); ?>">Apperçu</a> | 
                        <a href="index.php?action=admin&rubrique=updateChap&id=<?= $chapitre->id(); ?>">Mettre à jour</a> | 
                        <a href="index.php?action=admin&rubrique=deleteChapitre&id=<?= $chapitre->id(); ?>">Supprimer</a> | 
                        <a href="index.php?action=admin&rubrique=publierChap&id=<?=$chapitre->id(); ?>">Publier</a>
                    </tr>
                <?php        
                }
                ?>
            </table>
        <?php
        }
        else
        {
            echo 'Aucun chapitre en cours d\'écriture pour le moment';
        }
        ?>
    </article>
    <article id="chapitresEnLigne">
        <h2>Chapitres en ligne : </h2>
        <table>
            <?php
            foreach($billets as $billet)
            {
            ?>
            <tr>
                <h3><?= $billet->titre(); ?></h3>
                <p><?=$billet->extrait(); ?></p>
                <a href="index.php?action=billet&id=<?=$billet->id() ?>&page=1" title="accès au chapitre">Lire</a> | 
                <a href="index.php?action=admin&rubrique=update&id=<?= $billet->id(); ?>" title="Page de mise à jour">Mettre à jour</a> |
                <a href="index.php?action=admin&rubrique=deleteBillet&id=<?= $billet->id(); ?>" title="Supression définitive">Supprimer</a> 
            </tr>
            <?php
            }
            ?>
        </table> 
        <p class="info">
        <?php 
        if(isset($_SESSION['info']) || $_SESSION['info'] != '')
        {
            echo $_SESSION['info']; 
            $_SESSION['info'] = '';
        }
        ?>
        </p>
    </article>

    <!-- commentaires signalés à valider -->
    <article id="gestionComm">
        <h2>Commentaires signalés à valider ou supprimer : </h2>
        <table>
            <?php
            if(!empty($commentaires))
            {
                foreach($commentaires as $commentaire)
                {
                ?>
                    <tr>
                        <p>
                        <?= $commentaire->auteur(); ?>, le <?= $commentaire->date_commentaire(); ?> : "<?= $commentaire->commentaire(); ?>".
                        </p>
                        <a href="index.php?action=admin&rubrique=updateCom&id=<?= $commentaire->id();?>" title="remise en ligne">Valider</a> | 
                        <a href="index.php?action=admin&rubrique=deleteCom&id=<?= $commentaire->id(); ?>" title="suppression définitive">Supprimer</a>
                    </tr>
                <?php
                }
            }
            else
            {
                echo 'Aucun commentaire à valider pour l\'instant';
            }
            ?>
        </table>
    </article>
    </div>
</section>
