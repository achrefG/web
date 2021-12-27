<?php
function json($path){
    //
    $json = file_get_contents($path);
    $jsondec = json_decode($json,true);
    return $jsondec;

}
?>

<?php
function recupererDebutTexte ($origine, $longueurAGarder)
{
        if (strlen ($origine) <= $longueurAGarder)
            return $origine;
         
        $debut = substr ($origine, 0, $longueurAGarder);
        $debut = substr ($debut, 0, strrpos ($debut, ' ')) . '';
         
        return $debut;
}
?>
<?php
function saveCSV($film,$filename){
    //$film="";
    $trouver=false;
    $file = fopen ($filename , 'a+');
    //$film=$_GET['test'];
    $a = array();
    while (!feof($file)) {
        $fields=fgetcsv($file,999,";");
        //var_dump($fields);
        if (is_array($fields)) {
            $count = count($fields);
            if($fields[0]==$film){
                $occurance=$fields[1]+1;
                $newfields= array($film,$occurance);
                array_push($a,$newfields);
                $trouver=true;
            }else {
                $new= array($fields[0],$fields[1]);
                array_push($a,$new);
            }
        }
    }
    ftruncate($file,0);
    fclose($file);
    $file = fopen ($filename , 'a+');
    
    if (!$trouver) {
        $newfields= array('name' => $film,'occurance'=>1 );
        array_push($a,$newfields);
        //var_dump($a);
    }
    for ($i=0; $i < count($a); $i++) { 
        fputcsv($file, $a[$i], ";");
    }
    //fputcsv($file, $a, ";");
    fclose($file);
    }

    function readCsvOccurance($filename){
        $trouver=false;
        $file = fopen ($filename , 'a+');
        $occurance = array();
        while (!feof($file)) {
            $fields=fgetcsv($file,999,";");
            if (is_array($fields)) {
                array_push($occurance,$fields[1]);
            }
        }
        return $occurance;
    }
    function readcsvfilms($filename){
        $file = fopen ($filename , 'a+');
        $films = array();
        while (!feof($file)) {
            $fields=fgetcsv($file,999,";");
            if (is_array($fields)) {
                array_push($films,$fields[0]);
            }
        }
        return $films;
    }
    function readCsvNbStat($filename){
        $file = fopen ($filename , 'a+');
        $nbfilms = 0;
        while (!feof($file)) {
            $fields=fgetcsv($file,999,";");
            if (is_array($fields)) {
                $nbfilms++;
            }
        }
        return $nbfilms;
    }

?>

