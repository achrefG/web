<?php
	require_once "../includeprojet/header.inc.php";
    require_once "../includeprojet/nbpage.inc.php";
    require_once "../includeprojet/omdb.inc.php";
    require_once "../includeprojet/tmdbseries.inc.php";
    echo head();
    
?>
 <?php
 /**
  * file_get_contents(http://www.omdbapi.com/?s=star wars&amp;apikey=f60a29b4&amp;r=xml): failed to open stream: HTTP request failed! HTTP/1.1 400 Bad Request in C:\wamp64\www\td7\projet\films.php on line 7
Call Stack
#	Time	Memory	Function	Location
1	0.0089	365032	{main}( )	...\films.php:0
2	0.0092	365184	file_get_contents ( )	...\films.php:7
 
* API KEY FOR IMDB API k_jl2r4omi https://imdb-api.com/en/API/SearchMovie/k_jl2r4omi

*API KEY FOR THE MOVIE DATABASE 2f382430e0c5e5bca7caa7b21af148cd

*/       
    ?>
        <div id="pageContent" class="twoCols blogList blog">
            <main id="leftCol">
                <?php 
                if(isset($_GET['db'])&& !empty($_GET['db'])) {
                    $db = $_GET['db'];
                    if ($db==2) {
                        echo series();
                    }else {
                        if (isset($_GET['page'])) {
                            echo series_tmdb($_GET['page']);
                        }else{
                            echo series_tmdb();
                        }
                    }
                    
                }else  
                    if (isset($_GET['page'])) {
                        echo series_tmdb(($_GET['page']));
                    }else{
                        echo series_tmdb();
                    }        
                ?>
                
                 
            </main><!--Ici se termine le #leftCol-->
            <aside id='rightCol'>
    <section id='blogSearch'>
        <form action="serie.php" method="get" >	
        <?php 
        if (isset($_GET['db'])) {
           $db = $_GET['db'];
          echo "<input type='hidden' name='db' value='".$db."'/>";
        }
        ?>
            
            <h3><label for='search'>Rechercher</label></h3>
            <input type='search' name='search' id='search' />
            <!--<input type='submit' name='search' id='search' />-->
        </form>
    </section>
        <!--
    <section id='categories'>
        <h1>Catégories</h1>
        <ul>
            <li><a href='#'>Action<span>11</span></a></li>
            <li><a href='#'>Comédies<span>2</span></a></li>
            <li><a href='#'>Drame‎s  <span>15</span></a></li>
            <li><a href='#'>Romantique<span>11</span></a></li>
            <li><a href='#'>Horreur<span>15</span></a></li>
        </ul>
    </section>
    -->
    <section id='pages'>
        <h3>Pages</h3>
        <?php
        $nbpage = getnbPageSeries();
    
        if (isset($_GET['page'])&& $nbpage!=1 ) {
            if(1<$_GET['page']  ){
                $Précédente=$_GET['page']-1;
             ?>
             
                <button class='favorite styled2' name='pagePre' id='page' type='button' onclick="window.location.href=<?php echo "'serie.php?page=".$Précédente."'";?>;">
                Précédente
                </button>
                <button class='favorite styled2' name='page1' id='page' type='button' onclick="window.location.href=<?php echo "'serie.php?page=1'";?>;">
                Page 1
                </button>
                <?php
            } 
            if ($_GET['page']<$nbpage) {
                $Suivante=$_GET['page']+1;
                ?>
                <button class='favorite styled2' name='page' id='pageSuiv' type='button' value='3' onclick="window.location.href=<?php echo "'serie.php?page=".$Suivante."'";?>;">
                Suivante
                </button>
                <?php
            }   
        }elseif ($nbpage>1 ) {
          
        
            
            ?>
            <button class='favorite styled2' type='button' name='page' id='page'  value='3' onclick="window.location.href='serie.php?page=2';">
            Suivante
            </button>
            <?php
        }
       
        
        ?>
        
        
        
    </section>
    <section id='db'>
        <h3>Base de données</h3>
        <ul>
            <li><a href='serie.php?db=1'>The Movie Database<span class="stars">⭐⭐⭐</span></a></li>
            <li><a href='serie.php?db=2'>The Open Movie Database<span class="stars">⭐</span></a></li>
        </ul>
    </section>
    <section id='tendance'>
        <h3>Tendance</h3>
        <ul>
            <li><a href='trending.php?time=day'>Aujourd'hui<span class="stars">TOP</span></a></li>
            <li><a href='trending.php?time=week'>Cette semaine <span class="stars">TOP</span></a></li>
        </ul>
    </section>
    <section id='langue'>
        <h3>Choissez une langue pour les resutat</h3>
        <ul>
            <li><a href='?lang=fr'>Francais<span >Fr</span></a></li>
            <li><a href='?lang=en'>Anglais<span >En</span></a></li>
        </ul>
    </section>
</aside>
            </div><!--Ici se termine le #pageContent-->
<?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
     /*enregistrement de la recherche pour les statistique 
    * fichier stat.cvs dans /projet
    * $film="";
    $trouver=true;
    
    $filename = "stat.csv" ;
    $file = fopen ($filename , 'r+');
    
    $prenom=$_GET['search'];  
    
    while (!feof($file)) {
        $fields=fgetcsv($file,999,";");
        if (is_array($fields)) {
            $count = count($fields);
            if ($count>1) {
                foreach ($fields as $filed) {
                    var_dump($field);
                    if($field[0]==$prenom){
                        $field[1]=$field[1]+1;
                        $trouver=false;
                    }
                }
            }
            var_dump($fields);
            if ($trouver) {
                $a=[$_GET['search'],0];
                fputcsv($file, $a, ";");
            }
        }  
        }
        fclose($file);
    
    **/
?>