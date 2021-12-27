<?php
	require_once "../includeprojet/header.inc.php";
    echo head();
?>
        <div id="pageContent" class="about">
            <main>
				<h1>A propos de nous</h1>
				<p class="text">Voici le projet de deux étudiants en L2 - Informatique de l'université CY Cergy Paris Université pour le cours de M. Marc Lemaire. </p>
                
				
                <h2>Objectif de ce projet</h2>
                <p class="text">Nous avons créé ce site dans le cadre du projet de l'UE Développement Web intitulé : "Movies &#38; Series", où nous mettons en œuvre l’ensemble des éléments techniques HTML / PHP/ CSS que nous avons appris.</p>
            



<section class="team text-center section-padding" id="team">
          <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="arrow" lang="en">We're a team that adore what we do</h2>
                </div>
              </div>
              <div class="row">
                <div class="team-wrapper">
                  <div id="teamSlider">
                    <ul class="slides">
                      <li>
                        <div class="col-md-4 wp5">
                          <img src="../images/achref.png" alt="Team Member"/>
                          <h2 id="chap">Ghezil Achref</h2>
                          <p>Etudiant d'origine Algeriéne ayant obtenu un Bac S au Lycée international Alexandre Dumas d'Alger, Motivé et ambitieux ,Cherche toujours a s'améliorer.</p>
                          <div class="social">
                            <ul class="social-buttons">
                              <li><a href="https://www.linkedin.com/in/achref-ghezil-2529481b9" class="social-btn"><i class="fa fa-linkedin"></i></a></li>
                              <li><a href="https://instagram.com/achrefghezil" class="social-btn"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                          </div>
                        </div>

                        <div class="col-md-4 wp5 delay-05s">
                          <img src="../images/banti.png" alt="Team Member"/>
                          <h2>Nicolas Bantikos</h2>
                          <p>Etudiant d'origine grecque ayant obtenu un Bac S au Lycée Paul Lapie, est passionné par les nouvelles technologies.</p>
                          <div class="social">
                            <ul class="social-buttons">
                              <li><a href="https://instagram.com/nico_banti" class="social-btn"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        
                      </li>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
        </section>




        <h3>  -- </h3>

        <div class="centerAbout" style="padding: 30px;">
          <h2>A propos de vous </h2>
               <?php
                $urlXML = "http://www.geoplugin.net/xml.gp?ip=xx.xx.xx.xx";
                $xml = simplexml_load_file($urlXML);
                echo    '<h3> Your position via Geoplugin xml stream  </h3>
                        <p>Pays : '.$xml->geoplugin_countryName.'</p>
                        <p>Région : '.$xml->geoplugin_region.'</p>
                        <p>Département : '.$xml->geoplugin_regionName.'</p>
                        <p>Ville : '.$xml->geoplugin_city.'</p>';
                ?>
        </div>

        <div class="center2">
            <h5 style="text-align: center;">tout les droit son réserve : module dev-web</h5>
            <img src="../images/CYU_logo.png" alt="logo de Cy cergy université"/>
            <img src="../images/layout/nb_logo.png" height="129" alt="logo page web"/>
        </div>
        








            </main>
</div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>