<?php
function films(){
if(!($_COOKIE["SearchCookie"] == "rien")){
		$cookie_search = $_COOKIE["SearchCookie"];
	}
    $taille=0;

    if (isset($_GET['search'])) {
        $search1 =  $_GET['search'];
        $nameWithoutSpace = preg_replace('/\s+/', '%20', $_GET['search']);
		setcookie("SearchCookie", $nameWithoutSpace, time() + (86400 * 30));
        $search = $nameWithoutSpace;
    }else if (!($_COOKIE["SearchCookie"] == "rien")) {
        $search =  $cookie_search;
        $search1 =  str_replace('%20', ' ', $search);
    }else{
        $search = "";
        $search1 = "";
    }
    $urlXMLs = file_get_contents("http://www.omdbapi.com/?s=".$search."&apikey=f60a29b4&r=xml&type=movie");
    $xmls = simplexml_load_string($urlXMLs);
    if($xmls) {
        $taille =count($xmls->result); // recupere la taille du tableau xml, c'est a dire le nombre de films trouvés
        if ($taille ==0) {
            for ($i=0; $i <3; $i++) { 
                $title[$i] ="";
                $image[$i] ="";
                $year[$i] = "";
                $plot[$i]="";     
            }
        }else {
            for ($i=0; $i < count($xmls->result); $i++) { 
                $id[$i] = $xmls->result[$i]['imdbID'];
                $urlXML[$i] = file_get_contents("http://www.omdbapi.com/?i=".$id[$i]."&apikey=f60a29b4&r=xml");
                $xml[$i] =  simplexml_load_string($urlXML[$i]);                
                $title[$i] = $xml[$i]->movie['title'];
                $image[$i] = $xml[$i]->movie['poster'];
                $year[$i] = $xml[$i]->movie['year'];
                $plot[$i] =$xml[$i]->movie['plot'];                
            }
        }
    } else {
        echo "Nothing found. Add the info manually";
        for ($i=0; $i <3; $i++) { 
            $title[$i] ="";
            $image[$i] ="";
            $year[$i] = "";
            $plot[$i] = "";    
        }
    }     

                $articles="";
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
                }else{
                $articles="<article>
                <header>
                <h2>Résultat de recherche pour : <strong>".$search1."</strong></h2>
                <p>Asstuce !! pour plus de résultat utilé <strong>the movie data base</strong> </p>
                </header>
                <p>merci pour votre cofiance</p>
            </article><!--Fin du 0 eme article-->";
                for ($i=0; $i <$taille ; $i++) { 

                    $articles.= " 
                    <article>
                        <header>
                        <h2>Film : ".$title[$i]." </h2>
                        <p><strong>".$year[$i]."</strong></p>
                        </header>
                        <p><img src=' ".$image[$i]."' alt='Image d illustration de l article' /></p>
                        <p lang='en'>".$plot[$i]."<a href='singleFilm.php?i=".$id[$i]."'>Lire la suite</a></p>
                    </article><!--Fin du $i eme article-->
                    ";
                }
            }
                return $articles;
            }
?>
<?php
function series(){
if(!($_COOKIE["SearchCookie"] == "rien")){
		$cookie_search = $_COOKIE["SearchCookie"];
	}
    $taille=0;

    if (isset($_GET['search'])) {
        $search1 =  $_GET['search'];
        $nameWithoutSpace = preg_replace('/\s+/', '%20', $_GET['search']);
		setcookie("SearchCookie", $nameWithoutSpace, time() + (86400 * 30));
        $search = $nameWithoutSpace;
    }else if (!($_COOKIE["SearchCookie"] == "rien")) {
        $search =  $cookie_search;
        $search1 =  str_replace('%20', ' ', $search);
    }else{
        $search = "";
        $search1 = "";
    }
    $urlXMLs = file_get_contents("http://www.omdbapi.com/?s=".$search."&apikey=f60a29b4&r=xml&type=series");
    $xmls = simplexml_load_string($urlXMLs);
    if($xmls) {
        $taille =count($xmls->result); // recupere la taille du tableau xml, c'est a dire le nombre de films trouvés
        if ($taille ==0) {
            for ($i=0; $i <3; $i++) { 
                $title[$i] ="";
                $image[$i] ="";
                $year[$i] = "";
                $plot[$i]="";     
            }
        }else {
            for ($i=0; $i < count($xmls->result); $i++) { 
                $id[$i] = $xmls->result[$i]['imdbID'];
                $urlXML[$i] = file_get_contents("http://www.omdbapi.com/?i=".$id[$i]."&apikey=f60a29b4&r=xml");
                $xml[$i] =  simplexml_load_string($urlXML[$i]);                
                $title[$i] = $xml[$i]->movie['title'];
                $image[$i] = $xml[$i]->movie['poster'];
                $year[$i] = $xml[$i]->movie['year'];
                $plot[$i] =$xml[$i]->movie['plot'];                
            }
        }
    } else {
        echo "Nothing found. Add the info manually";
        for ($i=0; $i <3; $i++) { 
            $title[$i] ="";
            $image[$i] ="";
            $year[$i] = "";
            $plot[$i] = "";    
        }
    }     

                $articles="";
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
                }else{
                $articles="
                 <article>
                        <header>
                        <h2>Résultat de recherche pour : <strong>".$search1."</strong></h2>
                        <p>Asstuce !! pour plus de résultat utilé <strong>the movie data base</strong> </p>
                        </header>
                        <p>merci pour votre cofiance</p>
                    </article><!--Fin du 0 eme article-->
                    
                ";
                for ($i=0; $i <$taille ; $i++) { 

                    $articles.= " 
                    <article>
                        <header>
                        <h2>Film : ".$title[$i]." </h2>
                        <p><strong>".$year[$i]."</strong> |Acteur principal | 3 commentaires</p>
                        </header>
                        <p><img src=' ".$image[$i]."' alt='Image d illustration de l article' /></p>
                        <p lang='en'>".$plot[$i]."<a href='singleSerie.php?i=".$id[$i]."'>Lire la suite</a></p>
                    </article><!--Fin du $i eme article-->
                    ";
                }
            }
                return $articles;
            }
?>