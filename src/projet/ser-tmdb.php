<?php
	require_once "../includeprojet/header.inc.php";
    require_once "../includeprojet/function.inc.php";
    echo head();
    // KEY =  2f382430e0c5e5bca7caa7b21af148cd
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
								$path = "https://api.themoviedb.org/3/tv/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd";
							break;
							case 'fr':
								$path = "https://api.themoviedb.org/3/tv/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd&language=fr-FR";
				
								break;
							default:
							$path = "https://api.themoviedb.org/3/tv/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd";
								break;
						}
						
					}else {
						$path = "https://api.themoviedb.org/3/tv/".$id."?api_key=2f382430e0c5e5bca7caa7b21af148cd";
					}
					 if (@json($path)) {
                    	
						$json = json($path); 
						setcookie("cookser",$id, time()+3600*24*7, );  
                    //var_dump($json);
                    
                    if (isset($json['name'])) {
                        $title = $json['name'];
                    }else {
                        $title = $json['original_name'];
                    }
                    $filename = "./statSerie.csv" ;
                    saveCSV($title,$filename);
					if(isset($json['poster_path'])){
						$poster = "https://image.tmdb.org/t/p/w500".$json['poster_path'];
					}
					else{
						$poster = "../images/interogation.png";
					}
					if(isset($json['first_air_date'])){
						$year = $json['first_air_date'];
					}
					else{
						$year = "N/A";
					}
					if(isset($json['overview'])){
						$plot =$json['overview'];
					}
					else{
						$plot = "N/A";
					}
					$nbgenres = count($json['genres']);
					for($i=0; $i < $nbgenres ;$i++){
						$genres[$i] = $json['genres'][$i]['name'];
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
						$country = "N/A";
					}
                    $writer = $json['production_companies'];
					
					if(isset($json['number_of_episodes'])){
						$runtime = $json['number_of_episodes'];
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
					$jsonCredits = json("https://api.themoviedb.org/3/tv/".$id."/credits?api_key=2f382430e0c5e5bca7caa7b21af148cd");
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
					$jsonSimilar = json("https://api.themoviedb.org/3/tv/".$id."/similar?api_key=2f382430e0c5e5bca7caa7b21af148cd");
					//var_dump($jsonSimilar);
					if(isset($jsonSimilar['results'][0]['id'])){
						$similaire=true;
						if (count ($jsonSimilar['results'])>3) {
							for ($i=0; $i < 3; $i++) { 
								$similarID[$i] = $jsonSimilar['results'][$i]['id']; 
								$similarName[$i] = $jsonSimilar['results'][$i]['original_name'];
								$similarPoster[$i] = "https://image.tmdb.org/t/p/w342".$jsonSimilar['results'][$i]['poster_path'];
							}
						}
					}
					else{
						$similaire=false;
						for ($i=0; $i < 3; $i++) { 
								$similarID[$i] = $id; 
								$similarName[$i] = "N/A";
								$similarPoster[$i] = "N/A";
							}
					}
                    
                    
                    $jsonVideo= json("https://api.themoviedb.org/3/tv/".$id."/videos?api_key=2f382430e0c5e5bca7caa7b21af148cd");
					if (isset($jsonVideo["results"][0]["site"])){
						if ($jsonVideo["results"][0]["site"]=="YouTube") {
							$video= "<iframe width='75%' height='450' src='https://www.youtube.com/embed/".$jsonVideo['results'][0]['key']."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
						}
					}
                    //$Video = $jsonSimilar['results'][$i]['id']; 
                    //$similarName[$i] = $jsonSimilar['results'][$i]['original_title'];

                    
					
					$jsonPic =json("https://api.themoviedb.org/3/tv/".$id."/images?api_key=2f382430e0c5e5bca7caa7b21af148cd");
					//var_dump($jsonPic);
					//$poster = $jsonPic['posters'][0]['file_path'];
					
                ?>
			<section>
            <h2 id="pageTop">&starf;<?php echo $title ;?>&starf;</h2>
			<figure class="alignLeft">
                    <img <?php echo "src='".$poster."'"; ?> alt="Poster de la série" />
                </figure>
				<h3>Résumé </h3>
                <p style="margin-bottom:7%">
                
                <?php echo $plot ;?>
               </p>
			   
			   <ul class="info" >
                    <li>poster : <em> <?php echo "<a href='".$poster."' download='true' >télécharger ici</a> ";?> </em></li>
                    <li>Année : <em> <?php echo $year ;?></em></li>
                    <li>Genre(s) : <em> <?php
										for($i=0; $i < $nbgenres ;$i++){
											echo "".$genres[$i].",";
										}
									 ?>
					</em></li>
					<?php
						echo "<li>Acteurs :";
						if(count ($jsonCredits['cast'])>5) {
							echo "<em>".$actors[0].",".$actors[1].",".$actors[2].",".$actors[3].",".$actors[4]."</em></li>";
						}
						else{
							echo "<em>";
							for ($i=0; $i < count($jsonCredits['cast']); $i++) { 
								echo "".$actors[$i].",";  
							}
							echo "</em></li>";
						}
					?>
                    <li>langue originale : <em> <?php echo $language ;?></em></li>
                    <li>Pays : <em> <?php echo $country ;?></em></li>
                    <li>Durée : <em> <?php echo $runtime ;?></em> episodes</li>
					<li>Compagnies de production: <em><?php for($i=0; $i < $nbcompanies ;$i++){
												echo "".$companies[$i].", ";
											}
									 ?>
					</em></li>
					<li>Vues : <em> <?php echo $popularity ;?></em></li>	
					<li>Score : <em> <?php echo $note ;?> / 10</em></li>
				</ul>
				
				<button class='favorite styled' type='button' onclick="window.location.href='gallerieSeries.php?i= <?php echo $id;?>';">
                        Gallerie de photos
				</button>
				
				 <dl class="alignLeft">
                    <dt>Produit par : </dt>
                    <dd><?php echo $producer ;?></dd>
                </dl>
                    <div>
                        <?php
						
                        if (isset($video)){
							echo "<h3>Bande annonce</h3>";
                            echo $video;
                        }?>
                    </div>
				</section>
				
				
				<div class="semilaire">
					<?php 
					if($similaire){?>
					<h2>Vous avez aimé !! &starf; Voici d'autre Films pouvant vous plaire :&starf;</h2> 
					<ul>
						<?php
						for ($i=0; $i < 3; $i++) { 
							//echo "<li><a href='mov-tmdb.php?i=".$similarID[$i]."'>".$similarName[$i]."</a></li>\n";
							?>
							<li>
								<p><?php echo $similarName[$i];?></p>
								<a href='ser-tmdb.php?i=<?php echo $similarID[$i];?>'> <img <?php echo "src='".$similarPoster[$i]."'"; ?> alt="Poster du film" /></a></li>
							
						<?php }
						} ?>	
					</ul>
					
				
					
				</div>
				
                <button style="margin-top: 20px;" class='favorite styled' type='button' onclick="window.location.href='#top';">
				Retour en haut de la page
				</button>
				<?php
					
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
        <form action="search.php" method="get" >
        <?php 
        if (isset($_GET['db'])) {
           $db = $_GET['db'];
          echo "<input type='hidden' name='db' value='".$db."'/>";
        }
        ?>
            
            <h3><label for='search'>Search</label></h3>
            <input type='search' name='search' id='search' />
            <!--<input type='submit' name='search' id='search' />-->
        </form>
    </section>
       
    <section id='db'>
        <h3>Base de données</h3>
        <ul>
            <li><a href='serie.php?db=1'>The Movie Database<span class="stars">⭐⭐⭐</span></a></li>
            <li><a href='serie.php?db=2'>The Open Movie Database<span class="stars">⭐</span></a></li>
        </ul>
    </section>
    <section id='tedance'>
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