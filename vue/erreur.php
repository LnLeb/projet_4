<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start() ?>
<p>Une erreur est survenue : <?= $msgErreur ?></p>
<?php $article = ob_get_clean(); 

$aside = '';

require 'vue/gabarit.php'; ?>