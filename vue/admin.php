<?php $this->titre = 'Administration'; ?>
<nav>
    <ul>
        <li><a href='#chapitresEnLigne'>Chapitres en ligne</a></li>
        <li><a href='#nouveauChapitre'>Nouveau chapitre</a></li>
        <li><a href='#gestionComm'>Gestion des commentaires</a></li>
        <li><a href='index.php'>Déconnexion</a></li>
    </ul>
</nav>

<section id="admin">
    <article id="chapitresEnLigne">
        <h2>Chapitres en ligne : </h2>
        <table>
            <?php
            foreach($billets as $billet)
            {
            ?>
            <tr>
                <h3><?php echo $billet['titre']; ?></h3>
                <a href="index.php?action=billet&id=<?php echo $billet['id']; ?>&page=1">Lire</a> |
                <a href="">Mettre à jour</a> |
                <a href="">Supprimer</a> 
            </tr>
            <?php
            }
            ?>
        </table> 
    </article>
    <article id="nouveauChapitre">
        <h2>Création d'un nouveau billet : </h2>
        <form method="post" action="index.php?action=admin">
            <label for="titre">Titre : </label><br>
            <input type="text" name="titre" id="titre"><br>
            <label for="extrait">Extrait : </label><br>
            <textarea name="extrait" id="extrait" rows="10" cols="150"></textarea><br>
            <label for="contenu">Contenu : </label><br>
            <textarea name="contenu" id="contenuAdmin" rows="40" cols="150"></textarea><br>
            <input type="submit" value="publier">
        </form>
    </article>
    <article id="gestionComm">
        <h2>Nouveaux commentaires : </h2>
        <table>
            
            
            
        </table>
    </article>
</section>
