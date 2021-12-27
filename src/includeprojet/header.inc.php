<?php

$value = "rien";

setcookie("SearchCookie", $value, time() + (86400 * 30),"/");
setcookie("SearchSeriesCookie", $value, time() + (86400 * 30),"/");


function head($titre = "N 	&#38; A Films",$isindex=false){
    $style="";
    if($isindex){
    $json = file_get_contents('https://api.nasa.gov/planetary/apod?api_key=6otE4XcHFQg6GCz6kuhfTQCebgjkaRRnjaWclE4a');
    $jsondec = json_decode($json,true);

   
        $style="
        <style>
        #pageContent{
        padding: 100px 20px;
        min-height: 100vh;
        background-image: url(".$jsondec['url'].");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        }
    
    </style>";
    }
    $tmp = "
    <!DOCTYPE html>\n
<html lang='fr'>\n
    <head>\n
        <meta charset='utf-8' />\n
        <meta http-equiv='X-UA-Compatible' content='IE=edge'/>\n
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>\n
   
    <title>$titre</title>\n
        <link rel='stylesheet' href='../css/normalize.css' />\n
        <link rel='stylesheet' href='../css/na.css' />\n
        
        <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css' />
        <link href='https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' rel='stylesheet' />
        <link rel='stylesheet' href='../css/td.css'/>\n
        
        <link rel='icon' type='image/png' href='../images/layout/nb_logo.png' />\n
        <script src='../js/jquery-3.4.1.min.js'></script>\n
        <script src='../js/menu.js'></script>\n
        $style    
    </head>\n
    <body>\n
        <header id='mainHeader'>\n
            <img src='../images/layout/nb_logo.png' alt='Logo N&#38;A' id='logoImg' />\n
            <h1>N &amp; A pour des Films et des séries </h1>\n
            <nav id='mainNav'>\n
                <h2 class='accessibility'>Menu principal</h2>\n
                <p class='accessibility'><a href='#pageContent' title='Accéder directement au contenu principal de cette page'>Passer le menu</a></p>\n
                <ul>\n
                    <li><a href='index.php' title='Vers la page accueil du site'>Accueil</a></li>\n
                  
                   
                    <li><a href='films.php' title='consulter notre page de films'>Films</a></li>\n
                    <li><a href='serie.php' title='consulter notre page de series'>Series</a></li>\n
                    <li><a href='statistique.php' title='statistique des meuiller films'>Statistique</a></li>\n
                    <li><a href='contact.php' title='Vers la page de contact de ce site'>Contact</a></li>\n
                    <li><a href='about.php' title='En savoir plus sur ce site et sur ses propriétaires'>About</a></li>\n
                    
                    
                </ul>\n
            </nav>\n
            <button id='menuToggle'><img src='../images/layout/hamburger.svg' alt='Ouvrir / Fermer le menu' /></button>\n
                    </header><!--Ici se termine le #mainHeader-->\n
        ";
        return $tmp  ;
}
