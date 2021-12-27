<?php
	require_once "../includeprojet/header.inc.php";
    require_once "../includeprojet/nbpage.inc.php";
    require_once "../includeprojet/function.inc.php";
    require_once "../includeprojet/tmdb.inc.php";
    
    echo head();
    if (isset($_GET['search'])&&!empty($_GET['search']) ) {
        $search=$_GET['search'];
        $search = preg_replace('/\s+/', '%20', $_GET['search']);
        if (isset($_GET['page'])) {
            $path = "https://api.themoviedb.org/3/search/multi?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search;
            $json = json($path);
            if (!(($_GET['page']>$json['total_pages']) || ($_GET['page']<=0 ))) {
                $path = "https://api.themoviedb.org/3/search/multi?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search."&page=".$_GET['page'];
            }
            
        }else{
        $path = "https://api.themoviedb.org/3/search/multi?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search;
        }
    }else {
        $search="          -    ";
        $path = "https://api.themoviedb.org/3/search/multi?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search;
    }
    //$path = "https://api.themoviedb.org/3/search/multi?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=";
    $json = json($path);
?>
<!-- http://www.omdbapi.com/?i=tt3896198&apikey=f60a29b4 


-->
        <div id="pageContent" class="galleries">
            <main>
                <?php 
               
                ?>
                
                <h2> Résultat de recherche pour "<?php
                $search= str_replace('%20', ' ', $search);
                 echo $search; ?>" 
                 </h2>
                <h3> Vos meilleur : Film  &Xopf; Série &Xopf; TV shows</h3>
                <ul>
                
                <?php 
                if(isset($json['results'])){
                                 for ($i=0; $i <count($json['results']) ; $i++) { 
                       
                    
                    ?>
                
                    <li>
                        
                        <?php
                         $id = $json['results'][$i]['id'];
						 if($json['results'][$i]['media_type'] != "tv"){
							echo "<a href='mov-tmdb.php?i=".$id."'>";
						 }
						 else{
							 echo "<a href='ser-tmdb.php?i=".$id."'>";
						 }
                         if (isset( $json['results'][$i]['title'])) {
                            $title = $json['results'][$i]['title'];
                         }elseif (isset($json['results'][$i]['name'])) {
                             # code...
                         
                            $title = $json['results'][$i]['name'];
                         }
                         ?>
                            <h2><?php
                             if ($title) {
                                echo $title ; 
                             }
                             ?></h2>
                            <?php
                            if (isset($json['results'][$i]['poster_path'])) {
                                $poster_path = "https://image.tmdb.org/t/p/w500".$json['results'][$i]['poster_path'];
                            }else {
                                $poster_path ="../images/interogation.png";
                            }
                            ?>
                            
                            <img src=<?php echo $poster_path ?> alt="Poster du filme ">

                            <p>
                            <?php
                            if (isset($json['results'][$i]['media_type'])&& isset($json['results'][$i]['release_date'])&&isset($json['results'][$i]['vote_average'])) {
                                echo "Type : ".$json['results'][$i]['media_type']." || ".$json['results'][$i]['release_date']." || Vote : ".$json['results'][$i]['vote_average']."/10"; 
                            }
                            ?></p>
                            
                            <p>
                            <?php
                            if (!isset($json['results'][$i]['original_language'])) {
                                echo "Langue originale : <strong>Inconnue</strong>";
                            }else {
                                
                            
                            switch ($json['results'][$i]['original_language']) {
                                case 'en':
                                    echo "Langue originale : <strong>Anglais</strong>";
                                    break;
                                case 'fr':
                                        echo "langue originale : <strong>Francais</strong>";
                                        break;
                                case 'ja':
                                    echo "langue originale <strong>Japonais</strong>";
                                    break;
                                
                                default:
                                    if ($json['results'][$i]['original_language']) {
                                        echo "langue originale ".$json['results'][$i]['original_language'];
                                    }
                                   
                                    break;
                            }
                        }
                            ?>
                            </p>
                            <p><?php 
                            if ( isset($json['results'][$i]['overview'])) {
                                $ovoverview = $json['results'][$i]['overview'];
                                $short_ovoverview = recupererDebutTexte($ovoverview, 100);
                            echo $short_ovoverview; }?></p>
            
                           
                        </a>
                    </li>
                <?php }} ?>
                </ul>
                <h2>Pages</h2>
        <?php
        $nbpage = getnbPagemulti();
        if (isset($_GET['page'])&& $nbpage!=1 ) {
            if ( is_numeric($_GET['page'])) {
               
            
            if(1<$_GET['page']  ){
                $Précédente=$_GET['page']-1;
             ?>
             
                <button class='favorite styled2' name='page' id='page' type='button' onclick="window.location.href=<?php echo "'search.php?page=".$Précédente."&search=".$_GET['search']."'";?>;">
                Précédente
                
            </button>
                <button class='favorite styled2' name='page' id='page' type='button' onclick="window.location.href=<?php echo "'search.php?page=1&search=".$_GET['search']."'";?>;">
                Page 1
                </button>
                <?php
            } 
            if ($_GET['page']<$nbpage) {
                $Suivante=$_GET['page']+1;
                ?>
                <button class='favorite styled2' name='page' id='page' type='button' value='3' onclick="window.location.href=<?php echo "'search.php?page=".$Suivante."&search=".$_GET['search']."'";?>;">
                Suivante
                </button>
                <?php
            }   
        }
    }elseif ($nbpage>1 ) {
          
        
            
        ?>
        <button class='favorite styled2' type='button' name='page' id='page'  value='3' onclick="window.location.href=<?php echo "'search.php?page=2&search=".$_GET['search']."'";?>;">
        Suivante
        </button>
        <?php
    }
       
        
        ?>
            </main>
            
</div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>
