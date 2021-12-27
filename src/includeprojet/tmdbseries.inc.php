<?php
require_once "../includeprojet/function.inc.php";
function series_tmdb_trend(){
    if (isset($_GET['lang'])&&!empty($_GET['lang'])) {
        switch ($_GET['lang']) {
            case 'en':
                $path = "https://api.themoviedb.org/3/trending/tv/week?api_key=2f382430e0c5e5bca7caa7b21af148cd";
                break;
            case 'fr':
                
                $path = "https://api.themoviedb.org/3/trending/tv/week?api_key=2f382430e0c5e5bca7caa7b21af148cd&language=fr-FR";
              

                break;
            default:
            $path = "https://api.themoviedb.org/3/trending/tv/week?api_key=2f382430e0c5e5bca7caa7b21af148cd";
            break;
        }
        
    }else {
        $path = "https://api.themoviedb.org/3/trending/tv/week?api_key=2f382430e0c5e5bca7caa7b21af148cd";

    }
    $json = json($path);
    $taille =count($json['results']);
    if ($taille != 0) {
        for ($i=0; $i < $taille; $i++) { 
            $id[$i] = $json['results'][$i]['id'];       
            if (isset( $json['results'][$i]['title'])) {
                $title[$i] = $json['results'][$i]['title'];
            }else {
                $title[$i] = $json['results'][$i]['name'];
            }      
            $image[$i] = "https://image.tmdb.org/t/p/w500".$json['results'][$i]['poster_path'];
            
            if (isset($json['results'][$i]['release_date'])) {
                $year[$i] =  $json['results'][$i]['release_date'];
            }else {
                $year[$i] = "------";
            }  
            
            $plot[$i] = $json['results'][$i]['overview'];               
        }
    }  
    $articles="";
    $articles="
    <article>
    <header>
    <h2>Le TOP des Séries</h2>
    <p>Effectuer des recherches pour avoir plus de résultats</p>
    </header>
    <p>Merci pour votre visite </p>
</article><!--Fin du -1 eme article-->
    ";
                for ($i=0; $i <$taille ; $i++) { 

                    $articles.= " 
                    <article>
                        <header>
                        <h2>Film : ".$title[$i]." </h2>
                        <p><strong>".$year[$i]."</strong></p>
                        </header>
                        <p><img src=' ".$image[$i]."' alt='Image d illustration de l article' /></p>
                        <p lang='en'>".$plot[$i]."<a href='ser-tmdb.php?i=".$id[$i]."'>Lire la suite</a></p>
                    </article><!--Fin du $i eme article-->
                    ";
                }
                
                return $articles;
}
?>
<?php
function series_tmdb($page=1){
    
    
    
    if(!($_COOKIE["SearchSeriesCookie"] == "rien")){
            $cookie_search = $_COOKIE["SearchSeriesCookie"];
    }
    $taille=-1;

    if (isset($_GET['search'])) {
        $search1 =  $_GET['search'];
        $nameWithoutSpace = preg_replace('/\s+/', '%20', $_GET['search']);
		setcookie("SearchSeriesCookie", $nameWithoutSpace, time() + (86400 * 30));
        $search = $nameWithoutSpace;
    }else if (!($_COOKIE["SearchSeriesCookie"] == "rien")) {
        $search =  $cookie_search;
        $search1 =  str_replace('%20', ' ', $search);
    }else{
        $search = "";
        $search1 = "";
    }
    if($search != ""){
        if (isset($_GET['lang'])&&!empty($_GET['lang'])) {
            switch ($_GET['lang']) {
                case 'en':
                    $path = "https://api.themoviedb.org/3/search/tv?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search;
                    break;
                case 'fr':
                    $path = "https://api.themoviedb.org/3/search/tv?api_key=2f382430e0c5e5bca7caa7b21af148cd&language=fr-FR&query=".$search;
                    
                  
    
                    break;
                default:
                $path = "https://api.themoviedb.org/3/search/tv?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search;
                break;
            }
            
        }else {
            $path = "https://api.themoviedb.org/3/search/tv?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search;
    
        }

        $json = json($path);

        if (!(($page>$json['total_pages']) || ($page<=0 ))) {
            $path .="&page=".$page;
        }
        //$path = "https://api.themoviedb.org/3/search/tv?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search."&page=".$page;
        $json = json($path);
        
            
        $nombre_resultat = $json['total_results'];
            $nombre_pages = $json['total_pages'];
        //var_dump($json);
            $taille =count($json['results']);
             // recupere la taille du tableau xml, c'est a dire le nombre de films trouvés
            if ($taille != 0) {
                for ($i=0; $i < $taille; $i++) { 
                    $id[$i] = $json['results'][$i]['id'];
                    //$urlXML[$i] = file_get_contents("http://www.omdbapi.com/?i=".$id[$i]."&apikey=f60a29b4&r=xml");
                    //$xml[$i] =  simplexml_load_string($urlXML[$i]);  
                    if (isset($json['results'][$i]['name'])) {
                        $title[$i] =  $json['results'][$i]['name'];
                    }else{
                        $title[$i] =  "Nom de série Inconnue"  ;
                    }
                   
                    if (isset($json['results'][$i]['poster_path'])) {
                        $image[$i] = "https://image.tmdb.org/t/p/w500".$json['results'][$i]['poster_path'];
                    }else {
                        $image[$i] = "../images/interogation.png";
                    }
                   
					if(isset($json['results'][$i]['release_date'])){
						$year[$i] =  $json['results'][$i]['release_date'];
					}
					else{
						$year[$i] = "N/A";
					}
                    $plot[$i] = $json['results'][$i]['overview'];               
                }
            }  

                    $articles="";
                    
                    if ($taille==-1) {
                        echo series_tmdb_trend();
                    }
                    if ($taille == 0) {
                        $articles.= " 
                        <article>
                        <header>
                            <h2>Aucun resultat trouvé pour :  &#171; ".$search1." &#187; veuillez reéssayer </h2>
                            <p>Astuse : faites une recherche dans l'autre base de données (droite) pour avoir une diversité de résultat</p>
                        </header>
                        <p>merci pour votre visite</p>
                        
                    </article><!--Fin du eme article-->
                    
                        ";
                    }
                    if ($taille > 0) {
                    $articles="
                    <article>
                            <header>
                            <h2>Résultat de recherche pour &#171; ".$search1." &#187;</h2>
                            <p>Nombre de resultat trouver <strong>".$nombre_resultat."</strong> || Nombre de pages trouver <strong>".$nombre_pages."</strong> </p>
                            </header>
                            <p>merci pour votre confiance</p>
                        </article><!--Fin du 0 eme article-->

                    ";
                    for ($i=0; $i <$taille ; $i++) { 

                        $articles.= " 
                        <article>
                            <header>
                            <h2>Série: ".$title[$i]." </h2>
                            <p><strong>".$year[$i]."</strong></p>
                            </header>
                            <p><img src='".$image[$i]."' alt='Image d illustration de l article' /></p>
                            <p lang='en'>".$plot[$i]."<a href='ser-tmdb.php?i=".$id[$i]."'>Lire la suite</a></p>
                        </article><!--Fin du $i eme article-->
                        ";
                    }
                }
            
            return $articles;
    }else {
        echo series_tmdb_trend();
    }
    
}
?>
