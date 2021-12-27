<?php
	require_once "../includeprojet/header.inc.php";
    require_once "../includeprojet/function.inc.php";
    echo head();
    $path = "https://api.themoviedb.org/3/trending/all/week?api_key=2f382430e0c5e5bca7caa7b21af148cd";
    $time = "semaine" ;
    if (isset($_GET["time"]) ) {
        switch ($_GET['time']) {
            case 'day':
                $time = "journéé" ;
                $path = "https://api.themoviedb.org/3/trending/all/day?api_key=2f382430e0c5e5bca7caa7b21af148cd";
                break;
            case 'week':
                $time = "semaine" ;
                $path = "https://api.themoviedb.org/3/trending/all/week?api_key=2f382430e0c5e5bca7caa7b21af148cd";
                break;

            default:
                break;
        }
		
    }
    $json = json($path);
?>
<!-- http://www.omdbapi.com/?i=tt3896198&apikey=f60a29b4 -->
        <div id="pageContent" class="galleries">
        <div>
            <?php
            if(isset($time)){
                switch ($time) {
                    case 'journéé':
                        ?>
                        <button class='favorite styled' type='button' onclick="window.location.href='trending.php?time=week';">
                        Tendance de la semaine
                        </button>
                        <?php
                        break;

                    case 'semaine':
                        ?>
                        <button class='favorite styled' type='button' onclick="window.location.href='trending.php?time=day';">
                        Tendance de la journéé
                        </button>
                        <?php
                        break;
                    
                    default:
                        ?>
                        <button class='favorite styled' type='button' onclick="window.location.href='trending.php?time=semaine';">
                        Tendance de la semaine
                        </button>
                        <?php
                        break;
                }
               
            }
            ?>
            



                    
        </div>
            <main>
                <?php 
               
                ?>
                <h2> Tandance de la <?php echo $time ?> </h2>
                <h3> Vos meilleur : Film  &Xopf; Série &Xopf; TV shows</h3>
                <ul>
                <?php  for ($i=0; $i <count($json['results']) ; $i++) { ?>
                       
                    
                
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
                         }else {
                            $title = $json['results'][$i]['name'];
                         }
                         ?>
                            <h2><?php echo $title ; ?></h2>
                            <?php $poster_path = "https://image.tmdb.org/t/p/w500".$json['results'][$i]['poster_path']?>
                            <img src=<?php echo $poster_path ?> alt="Poster du filme ">

                            <p>
                            <?php
                            if (isset($json['results'][$i]['media_type'])&& isset($json['results'][$i]['release_date'])&&isset($json['results'][$i]['vote_average'])) {
                                echo "Type : ".$json['results'][$i]['media_type']." || ".$json['results'][$i]['release_date']." || Vote : ".$json['results'][$i]['vote_average']."/10"; 
                            }
                            ?></p>
                            
                            <p>
                            <?php
                            
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
                                    echo "langue originale ".$json['results'][$i]['original_language'];
                                    break;
                            }
                            ?>
                            </p>
                            <p><?php 
                            $ovoverview = $json['results'][$i]['overview'];
                            $short_ovoverview = recupererDebutTexte($ovoverview, 100);
                            echo $short_ovoverview; ?></p>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </main>
            
                        </div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>