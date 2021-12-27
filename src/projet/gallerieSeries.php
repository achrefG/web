<?php
	require_once "../includeprojet/header.inc.php";
	require_once "../includeprojet/function.inc.php";
    echo head();
?>




        <section id="pageContent" class="oneCol galleries">
            <main class="singleGallery">
			<?php 
                   if (isset($_GET['i'])&& !empty($_GET['i'])) {  
						$id=$_GET['i'];
						$jsonPic = json("https://api.themoviedb.org/3/tv/$id/images?api_key=2f382430e0c5e5bca7caa7b21af148cd");
						$test = $jsonPic;
				   }
?>

<?php if( $test!= null){?>
                <h1>Gallerie</h1>
				
                <ul>
				<?php  for ($i=0; $i <count($jsonPic['backdrops']) ; $i++) { ?>
				
					<li>
					
						<?php $poster_path = "https://image.tmdb.org/t/p/w500".$jsonPic['backdrops'][$i]['file_path']?>
								<img src=<?php echo $poster_path ?> alt="Photos de la série ">
							
					</li>
				<?php } ?>							
                </ul>
				
				
<?php }else{
	echo "<h1>Série sans photos</h1>";
}
			?>
			
            </main>
        </section><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>