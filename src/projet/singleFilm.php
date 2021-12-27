<?php
	require_once "../includeprojet/header.inc.php";
    require_once "../includeprojet/function.inc.php";
    echo head();
?>

        <div id="pageContent" class="twoCols text blog">
            <main id="leftCol">
            <?php
            if (isset($_GET['i'])&& !empty($_GET['i'])) {
                $id=$_GET['i'];
                if (@file_get_contents("http://www.omdbapi.com/?i=".$id."&apikey=f60a29b4&plot=full&r=xml")) {
                    $urlXML = file_get_contents("http://www.omdbapi.com/?i=".$id."&apikey=f60a29b4&plot=full&r=xml");
                    $xml =  simplexml_load_string($urlXML);
                    if ($xml['response'] == "True") {
                
                $title = $xml->movie['title'];
                $filename='./statFilms.csv';
                saveCSV($title,$filename);
                $poster = $xml->movie['poster'];
                $year = $xml->movie['year'];
                $plot =$xml->movie['plot'];
                $genre = $xml->movie['genre'];
                $language = $xml->movie['language'];
                $country = $xml->movie['country'];
                $type =$xml->movie['type'];
                $actors = $xml->movie['actors'];
                $writer = $xml->movie['writer'];
                $runtime =$xml->movie['runtime'];
                $runtime =$xml->movie['runtime'];
            
            ?>
                <h1 id="pageTop"><?php echo $title ;?></h1>
                <p> &starf;<?php echo $title ;?>&starf;  <strong> Actors : </strong> <?php echo $actors ;?> </p>
                <br/>
                <ul>
                    <li>genre : <em> <?php echo $genre ;?></em></li>
                    <li>type : <em> <?php echo $type ;?></em></li>
                    <li>language : <em> <?php echo $language ;?></em></li>
                    <li>country : <em> <?php echo $country ;?></em></li>
                    <li>Year : <em> <?php echo $year ;?></em></li>
                    <li>runtime : <em> <?php echo $runtime ;?></em></li>
                </ul>
               
                <br/>
                <h3>Résumé </h3>
                <p lang="en">
                
                <?php echo $plot ;?>
               </p>
                
                <ol>
                    <?php 
                    $titleWithoutSpace = preg_replace('/\s+/', '%20', $title);
                    echo "<li><a href='films.php?search=".$titleWithoutSpace."'>film similaire </a></li>"?>
                </ol>
                <h2 id="ch1">Poster and more information</h2>
                <figure class="alignLeft">
                    <img <?php echo "src='".$poster."'"; ?> alt="Image d'illustration montrant un appareil photo" />
                    <figcaption>Poster <?php echo $title ;?></figcaption>
                </figure>
                <ul class="info">
                    <li>title : <em> <?php echo $title ;?></em></li>
                    <li>poster : <em> <?php echo "<a href='".$poster."' download='true' >télécharger ici</a> ";?> </em></li>
                    <li>year : <em> <?php echo $year ;?></em></li>
                    <li>genre : <em> <?php echo $genre ;?></em></li>
                    <li>language : <em> <?php echo $language ;?></em></li>
                    <li>country : <em> <?php echo $country ;?></em></li>
                    <li>type : <em> <?php echo $type ;?></em></li>
                    <li>runtime : <em> <?php echo $runtime ;?></em></li>
                </ul>
               
                <dl>
                    <dt>writers : </dt>
                    <dd><?php echo $actors ;?></dd>
                </dl>
                
                <p><a href="#pageTop">Retour en haut de la page</a></p>
                <?php
                    }else{
                        echo "<h2>Aucun film trouver : <a href='index.php'>retour a la page d'acceuil</a></h2>";
                    }
				}else {
					echo "<h2>Aucun film trouver : <a href='index.php'>retour a la page d'acceuil</a></h2>";
				}
			}else {
				echo "<h2>Aucun film trouver : <a href='index.php'>retour a la page d'acceuil</a></h2>";
			}
					?>
            </main>

            <aside id='rightCol'>
    <section id='blogSearch'>
        <form action="films.php" method="get" >
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
    <section id='db'>
        <h3>Base de données</h3>
        <ul>
            <li><a href='films.php?db=1'>The Movie Database<span class="stars">⭐⭐⭐</span></a></li>
            <li><a href='films.php?db=2'>The Open Movie Database<span class="stars">⭐</span></a></li>
        </ul>
    </section>
    <section id='tendance'>
        <h3>Tendance</h3>
        <ul>
            <li><a href='trending.php?time=day'>Aujourd'hui<span class="stars">TOP</span></a></li>
            <li><a href='trending.php?time=week'>Cette semaine <span class="stars">TOP</span></a></li>
        </ul>
    </section>
     <!--
    <section id='blogArchives'>
        <h1>Archives</h1>
        <div>
            <h2><a href='#'>2018 <span>21</span></a></h2>
            <ul>
                <li><a href='#'>Janvier 2018 <span>2</span></a></li>
                <li><a href='#'>Février 2018 <span>4</span></a></li>
                <li><a href='#'>Avril 2018 <span>3</span></a></li>
                <li><a href='#'>Mai 2018 <span>3</span></a></li>
                <li><a href='#'>Juin 2018 <span>4</span></a></li>
                <li><a href='#'>Septembre 2018 <span>3</span></a></li>
                <li><a href='#'>Décembre 2018 <span>2</span></a></li>
            </ul>
        </div>
        <div>
            <h2><a href='#'>2019<span>11</span></a></h2>
            <ul>
                <li><a href='#'>Janvier 2019 <span>3</span></a></li>
                <li><a href='#'>Février 2019 <span>1</span></a></li>
                <li><a href='#'>Mars 2019 <span>2</span></a></li>
                <li><a href='#'>Mai 2019 <span>4</span></a></li>
                <li><a href='#'>Septembre 2019 <span>1</span></a></li>
            </ul>
        </div>
    </section>
    -->
</aside>
    </div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>