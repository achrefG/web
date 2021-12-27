<?php
	require_once "../includeprojet/header.inc.php";
    echo head();
    $filename = "contact23062020.csv" ;
    $file = fopen ($filename , 'a+');
    if (isset($_GET['fName']) &&isset($_GET['fName'])&&isset($_GET['fName'])) {
        $a = [$_GET['fName'],$_GET['lName'],$_GET['email'],$_GET['message']];
        fputcsv($file, $a, ";");
        fclose($file);   
    }
   

?>
        <div id="pageContent" class="oneCol text">
            <main>
                <h1>Merci</h1>
                <p>Merci pour votre message. Notre équipe reprendra contact avec vous dans les 3 jours ouvrables.</p>
                <p>À très bientôt</p>
            </main>
        </div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>