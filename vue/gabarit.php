<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <title><?php  echo $titre ?></title>
        <link rel="stylesheet" href="contenu/projet4.css?<? echo time(); ?>">
        <link rel="icon" href="contenu/img/favicon.jpg">
    </head>
    
    <body>
        <div id="conteneur">
            <header>
                <h1>Billet simple pour l'Alaska</h1>
                <p>Jean Forteroche</p>
            </header>
            <section>
                <?php echo $contenu ?>
            </section>
            <footer>
                <p>Site école réalisé par Hélène Leblanc pour OpenClassrooms, projet 4 du parcours Développeur Web Junior<br>
                hébergeur : 1&amp;1. Adresse postale : 1&amp;1 Internet SARL, 7 place de la Gare, BP 70109, 57201 Sarreguemines Cedex<br>
                Images libres de droit récupérées sur pixabay.com, wikipedia.org et wikimedia.org</p>
            </footer>
        </div>
    </body>

</html>
