<?php
function rightCol(){
    
    $rightCol= "<aside id='rightCol'>\n
    <section id='blogSearch'>\n
        <h1><label for='search'>Rechercher</label></h1>\n
        <input type='search' name='search' id='search' />\n
    </section>\n
    <section id='categories'>\n
        <h1>Catégories</h1>\n
        <ul>\n
            <li><a href='#'>Matériel <span>11</span></a></li>\n
            <li><a href='#'>Lightroom <span>2</span></a></li>\n
            <li><a href='#'>Techniques <span>4</span></a></li>\n
            <li><a href='#'>Voyages <span>15</span></a></li>\n
        </ul>\n
    </section>\n
    <section id='blogArchives'>\n
        <h1>Archives</h1>\n
        <div>\n
            <h2><a href='#'>2018 <span>21</span></a></h2>\n
            <ul>\n
                <li><a href='#'>Janvier 2018 <span>2</span></a></li>\n
                <li><a href='#'>Février 2018 <span>4</span></a></li>\n
                <li><a href='#'>Avril 2018 <span>3</span></a></li>\n
                <li><a href='#'>Mai 2018 <span>3</span></a></li>\n
                <li><a href='#'>Juin 2018 <span>4</span></a></li>\n
                <li><a href='#'>Septembre 2018 <span>3</span></a></li>\n
                <li><a href='#'>Décembre 2018 <span>2</span></a></li>\n
            </ul>\n
        </div>\n
        <div>\n
            <h2><a href='#'>2019<span>11</span></a></h2>\n
            <ul>\n
                <li><a href='#'>Janvier 2019 <span>3</span></a></li>\n
                <li><a href='#'>Février 2019 <span>1</span></a></li>\n
                <li><a href='#'>Mars 2019 <span>2</span></a></li>\n
                <li><a href='#'>Mai 2019 <span>4</span></a></li>\n
                <li><a href='#'>Septembre 2019 <span>1</span></a></li>\n
            </ul>\n
        </div>\n
    </section>\n
</aside>\n";
return $rightCol;
}
?>