<?php
function getnbPage(){
    
    
    
    if(!($_COOKIE["SearchCookie"] == "rien")){
            $cookie_search = $_COOKIE["SearchCookie"];
    }
    $taille=-1;

    if (isset($_GET['search'])) {
        $search1 =  $_GET['search'];
        $nameWithoutSpace = preg_replace('/\s+/', '%20', $_GET['search']);
        $search = $nameWithoutSpace;
    }else if (!($_COOKIE["SearchCookie"] == "rien")) {
        $search1 =  $cookie_search;
        $search =  preg_replace('/\s+/', '%20', $search1);
    }else{
        $search = "";
        $search1 = "";
    }
    if($search != ""){
        $path = "https://api.themoviedb.org/3/search/movie?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search."&page=1";
        $json = json($path);    
        return $json['total_pages'];
    }
}
?>
<?php
function getnbPageSeries(){
    
    
    
    if(!($_COOKIE["SearchSeriesCookie"] == "rien")){
            $cookie_search = $_COOKIE["SearchSeriesCookie"];
    }

    $taille=-1;

    if (isset($_GET['search'])) {
        $search1 =  $_GET['search'];
        $nameWithoutSpace = preg_replace('/\s+/', '%20', $_GET['search']);
        $search = $nameWithoutSpace;
    }else if (!($_COOKIE["SearchSeriesCookie"] == "rien")) {
        $search1 =  $cookie_search;
        $search =  preg_replace('/\s+/', '%20', $search1);
    }else{
        $search = "";
        $search1 = "";
    }
    if($search != ""){
        $path = "https://api.themoviedb.org/3/search/tv?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search."&page=1";
        $json = json($path);    
        return $json['total_pages'];
    }
}
?>
<?php
function getnbPagemulti(){
    
    
    
    if(!($_COOKIE["SearchSeriesCookie"] == "rien")){
            $cookie_search = $_COOKIE["SearchSeriesCookie"];
    }
    $taille=-1;

    if (isset($_GET['search'])) {
        $search1 =  $_GET['search'];
        $nameWithoutSpace = preg_replace('/\s+/', '%20', $_GET['search']);
        $search = $nameWithoutSpace;
    }else if (!($_COOKIE["SearchSeriesCookie"] == "rien")) {
        $search1 =  $cookie_search;
        $search =  preg_replace('/\s+/', '%20', $search1);
    }else{
        $search = "";
        $search1 = "";
    }
    if($search != ""){
        $path = "https://api.themoviedb.org/3/search/multi?api_key=2f382430e0c5e5bca7caa7b21af148cd&query=".$search."&page=1";
        $json = json($path);    
        return $json['total_pages'];
    }
}
?>