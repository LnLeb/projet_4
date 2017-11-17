<?php $this->titre = 'Administration'; ?>
<!-- menu de navigation -->
<nav>
    <ul>
        <li><a href='index.php'>Accueil</a></li>
        <li><a href='index.php?action=admin&rubrique=nouveauChapitre'>Nouveau chapitre</a></li>
        <li><a href='index.php?action=admin#gestionComm'>Gestion des commentaires</a></li>
        <li><a href='index.php?action=admin&rubrique=deconnexion'>Déconnexion</a></li>
    </ul>
</nav>

<!-- liste des chapitres publiés -->
<section id="admin">
    <div class=administration>
    <article id="chapitresEnLigne">
        <h2>Chapitres en ligne : </h2>
        <table>
            <?php
            foreach($billets as $billet)
            {
            ?>
            <tr>
                <h3><?= $billet['titre']; ?></h3>
                <p><?=$billet['extrait']; ?></p>
                <a href="index.php?action=billet&id=<?=$billet['id'] ?>&page=1">Lire</a> | 
                <a href="index.php?action=admin&rubrique=update&id=<?= $billet['id']; ?>">Mettre à jour</a> |
                <a href="index.php?action=admin&rubrique=deleteBillet&id=<?= $billet['id']; ?>">Supprimer</a> 
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
        }
        set_time_limit(3);
        $_SESSION['info'] = '';
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
                        <?= $commentaire['auteur']; ?>, le <?= $commentaire['dateComm']; ?> à <?= $commentaire['heureComm']; ?> : "<?= $commentaire['commentaire']; ?>".
                        </p>
                        <a href="index.php?action=admin&rubrique=updateCom&id=<?= $commentaire['id'];?>">Valider</a> | 
                        <a href="index.php?action=admin&rubrique=deleteCom&id=<?= $commentaire['id']; ?>">Supprimer</a>
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
