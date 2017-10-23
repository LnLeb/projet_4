<?php $this->titre = 'Administration'; ?>

<div id="admin">
    <h2>Interface de gestion du blog</h2>
            
    <h3>Chapitres en ligne : </h3>
    <table>
        <?php
            foreach($billets as $billet)
            {
            ?>
                <tr>
                    <h4><?php echo $billet['titre']; ?></h4>
                    <a href="index.php?action=billet&id=<?php echo $billet['id']; ?>">Lire</a> |
                    <a href="">Mettre à jour</a> |
                    <a href="">Supprimer</a> 
                </tr>
            <?php
            }
            ?>
            </table> 
            
            <h3>Création d'un nouveau billet : </h3>
            <form method="post" action="index.php?action=admin">
                <label for="titre">Titre : </label><br>
                <input type="text" name="titre" id="titre"><br>
                <label for="extrait">Extrait : </label><br>
                <textarea name="extrait" id="extrait" rows="10" cols="150"></textarea><br>
                <label for="contenu">Contenu : </label><br>
                <textarea name="contenu" id="contenu" rows="40" cols="150"></textarea><br>
                <input type="submit" value="publier">
            </form>
            
            <h3>Nouveaux commentaires : </h3>
            <table>
            
            
            
            </table>
        </div>
