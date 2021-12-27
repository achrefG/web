<?php
	require_once "../includeprojet/header.inc.php";
    require_once "../includeprojet/function.inc.php";
    echo head();
    
?>
	<div id="top">
        <div id="pageContent" class="twoCols text blog">
            <main id="leftCol">
                <?php 
				  if (isset($_GET['i'])&& !empty($_GET['i'])) {
                    $id=$_GET['i'];
					if (isset($_GET['lang'])&&!empty($_GET['lang'])) {
						switch ($_GET['lang']) {
							case 'en':
								$path = "https://api.themoviedb.org/3/movie/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd";
							break;
							case 'fr':
								$path = "https://api.themoviedb.org/3/movie/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd&language=fr-FR";
				
								break;
							default:
							$path = "https://api.themoviedb.org/3/movie/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd";
								break;
						}
						
					}else {
						$path = "https://api.themoviedb.org/3/movie/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd";
					}
						if (@json($path)) {
							setcookie("cookmov",$id, time()+3600*24*7, );
							$json = json($path);
							
						
					
						
					
                   
                       
                   //var_dump($json);
                    
                    if (isset($json['title'])) {
                        $title = $json['title'];
                    }else {
                        $title = $json['original_title'];
                    }
                    /*
                    
                      /*enregistrement de la recherche pour les statistique */
					// fichier stat.cvs dans /projet
					$filename = "./statFilms.csv" ;
					saveCSV($title,$filename);
    
					if(isset($json['poster_path'])){
						$poster = "https://image.tmdb.org/t/p/w500".$json['poster_path'];
				    }
				    else{
				 	   $poster = "..images/interogation.png";
				    }
				    if(isset($json['release_date'])){
						$year = $json['release_date'];
				    }
				    else{
					   $year = "N/A";
				    }
				    if(isset($json['overview'])){
						$plot = $json['overview'];
				    }
				    else{
					   $plot = "N/A";
				    }
				    if(isset($json['genres'][0]['name'])){
						$nbgenres = count($json['genres']);
						for($i=0; $i < $nbgenres ;$i++){
							$genres[$i] = $json['genres'][$i]['name'];
						}
					}
					else{
						$nbgenres = 0;
						$genres = "N/A";
					}
					if(isset($json['original_language'])){
						$language = $json['original_language'];
					}
					else{
						$language = "N/A";
					}
					if(isset($json['production_companies'][0]['origin_country'])){
						$country = $json['production_companies'][0]['origin_country'];
					}
					else{
						$country = 'N/A';
					}
					if(isset($json['production_companies'])){
						$writer = $json['production_companies'];
					}
					else{
						$writer = "N/A";
					}
					if(isset($json['runtime'])){
						$runtime =$json['runtime'];
					}
					else{
						$runtime = "N/A";
					}
					if(isset($json['production_companies'])){
						$nbcompanies = count($json['production_companies']);
						for($i=0; $i < $nbcompanies ;$i++){
							$companies[$i] = $json['production_companies'][$i]['name'];
						}
					}
					else{
						$companies = "N/A";
					}
					if(isset($json['popularity'])){
						$popularity =$json['popularity'];
					}
					else{
						$popularity = "N/A";
					}
					if(isset($json['vote_average'])){
						$note =$json['vote_average'];
					}
					else{
						$note = "N/A";
					}
					
                    
					$jsonCredits = json("https://api.themoviedb.org/3/movie/".$id."/credits?api_key=2f382430e0c5e5bca7caa7b21af148cd");
					//var_dump($jsonCredits);
                    if (count ($jsonCredits['cast'])>5) {
                        for ($i=0; $i < 5; $i++) { 
                            $actors[$i] = $jsonCredits['cast'][$i]['name'];  
                        }
                    }
					else{
						for ($i=0; $i < count($jsonCredits['cast']); $i++) { 
							$actors[$i] = $jsonCredits['cast'][$i]['name'];  
						}	
					}
					if(isset($jsonCredits['crew'][0]['name'])){
						$producer = $jsonCredits['crew'][0]['name'];
					}
					else{
						$producer = "N/A";
					}
					$jsonSimilar = json("https://api.themoviedb.org/3/movie/$id/similar?api_key=2f382430e0c5e5bca7caa7b21af148cd");
					//var_dump($jsonSimilar);
					if(isset($jsonSimilar['results'][0]['id'])){
						$similaire = true ;
						if (count ($jsonSimilar['results'])>3) {
							for ($i=0; $i < 3; $i++) { 
								$similarID[$i] = $jsonSimilar['results'][$i]['id']; 
								$similarName[$i] = $jsonSimilar['results'][$i]['original_title'];
								$similarPoster[$i] = "https://image.tmdb.org/t/p/w500".$jsonSimilar['results'][$i]['poster_path'];
							}
						}
					}
					else{
						$similaire = false;
						for ($i=0; $i < 3; $i++) { 
								$similarID[$i] = $id; 
								$similarName[$i] = "N/A";
								$similarPoster[$i] = "N/A";
							}
					}
                    $jsonVideo= json("https://api.themoviedb.org/3/movie/$id/videos?api_key=2f382430e0c5e5bca7caa7b21af148cd");
					if (isset($jsonVideo["results"][0]["site"])){
						if ($jsonVideo["results"][0]["site"]=="YouTube") {
							$video= "<iframe id='video' src='https://www.youtube.com/embed/".$jsonVideo['results'][0]['key']."' title='YouTube video player' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
						}
					}
					$jsonPic =json("https://api.themoviedb.org/3/movie/$id/images?api_key=2f382430e0c5e5bca7caa7b21af148cd");	
                   
                ?>
			<section>
            <h2>&starf;<?php echo $title ;?>&starf;</h2>
			<figure class="alignLeft">
                    <img <?php echo " src='".$poster."' "; ?> alt="Poster du film" />
                </figure>
                <h3>Résumé </h3>
<?php 
                             
                            if (isset($_GET['lang'])&& $_GET['lang'] = "fr") {
                                                            
                            $lang='fr';
                            }else {
                                $lang='en';
                            }
					 ?>
				
                <p <?php echo 'lang='.$lang ?>style="margin-bottom:7%">
                
                <?php echo $plot ;?>
               </p>
               
                
                <ul class="info" >
                    <li>Poster : <em> <?php echo "<a href='".$poster."' download='true' >téléchargez ici</a> ";?> </em></li>
                    <li>Année : <em> <?php echo $year ;?></em></li>
                    <li>Genre(s) : <em><?php for($i=0; $i < $nbgenres ;$i++){
												echo "".$genres[$i].", ";
											}
									 ?>
								</em></li>
					
					
					<?php
						echo "<li>Acteurs :";
						if(count ($jsonCredits['cast'])>5) {
							echo "<em>".$actors[0].",".$actors[1].", ".$actors[2].", ".$actors[3].", ".$actors[4]."</em></li>";
						}
						else{
							echo "<em>";
							for ($i=0; $i < count($jsonCredits['cast']); $i++) { 
								echo "".$actors[$i].", ";  
							}
							echo "</em></li>";
						}
					?> 
                    <li>Langue originale : <em> <?php echo $language ;?></em></li>
                    <li>Pays : <em> <?php echo $country ;?></em></li>
                    <li>Durée : <em> <?php echo $runtime ;?></em> minutes</li>
					<li>Compagnies de production: <em><?php for($i=0; $i < $nbcompanies ;$i++){
												echo "".$companies[$i].", ";
											}
									 ?>
								</em></li>
					<li>Vues : <em> <?php echo $popularity ;?></em></li>	
					<li>Score : <em> <?php echo $note ;?> / 10</em></li>
				</ul>
				
				<button class='favorite styled' type='button' onclick="window.location.href='gallerie.php?i= <?php echo $id; ;?>';">
					Gallerie de photos
				</button>
				
				<dl class="alignLeft">
					<dt>Produit par : </dt>
					<dd><?php echo $producer;?></dd>
				</dl>
                
				</section>
				<div>
				<p style ="margin-bottom: 23%"></p>
					<?php
					if (isset($video)){
						echo $video;
					}					
				?>
				</div>

				<div class="semilaire">
					<?php 
					if($similaire){?>
					<h2 lang="fr">Vous avez aimé !! &starf; Voici d'autre Films pouvant vous plaire :&starf;</h2> 
					<ul>
						<?php
						for ($i=0; $i < 3; $i++) { 
							//echo "<li><a href='mov-tmdb.php?i=".$similarID[$i]."'>".$similarName[$i]."</a></li>\n";
							?>
							<li>
								<p><?php echo $similarName[$i];?></p>
								<a href='mov-tmdb.php?i=<?php echo $similarID[$i];?>'> <img <?php echo "src='".$similarPoster[$i]."'"; ?> alt="Poster du film" /></a></li>
							
						<?php }
						} ?>	
					</ul>	
				</div>
				
				<button lang="fr" style="margin-top: 20px;" class='favorite styled' type='button' onclick="window.location.href='#top';">
				Retour en haut de la page
				</button>
				<?php
					
				}else {
					echo "<h2 lang='fr' >Aucun film trouver : <a href='index.php'>retour a la page d'acceuil</a></h2>";
				}
			}else {
				echo "<h2 lang='fr' >Aucun film trouver : <a href='index.php'>retour a la page d'acceuil</a></h2>";
			}
					?>
		   </main>
		


            <aside id='rightCol'>
    <section id='blogSearch'>
        <form action="search.php" method="get" >
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
	<section id='langue'>
        <h3>Choissez une langue pour les resutat</h3>
        <ul>
            <li><a href='?lang=fr&i=<?php echo $id  ?>'>Francais<span >Fr</span></a></li>
            <li><a href='?lang=en&i=<?php echo $id?>'>Anglais<span >En</span></a></li>
        </ul>
    </section>
</aside>
</div>
        </div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>