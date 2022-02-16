<?php

require_once '../lib/autoload.php';

new App\Template('Sheetstack Alkotók', 'empty');

require_once '../views/components/sheets_item.php';


?>
<div class="card mb-3" style="border:none;">
    <img class="card-img-top" src="../files/images/chopin.jfif" style="width:500px; height:337px;" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Frédéric Chopin</h5>
        <p class="card-text">A Varsói Hercegség Mazovia tartományában, a Sochaczew város melletti Żelazowa Wolában született. Bár a születés után hetekkel kitöltött anyakönyvben február 22. szerepel, a család március 1-jét tekintette születésnapjának. Édesapja, Mikołaj (Nicolas) Chopin (1771–1844) francia bevándorló, édesanyja, Tekla Justyna Krzyżanowska (1782–1861) lengyel volt. Egy nővére és két húga volt Chopinnek: Ludwika (1807–1855), Izabela (1811–1881) és Emilia (1812–1827). Néhány hónappal Fryderyk születése után a család Varsóba költözött, ahol a családfő franciatanárként dolgozott.

            Chopin zenei tehetségét nagyon fiatalon felismerték; zsenialitása a gyermek Mozartéhoz vagy Bachéhoz mérhető. Hétévesen már két polonézt (g-moll és B-dúr) szerzett. A csodagyerek híre megjelent a varsói lapokban, és a „kis Chopin” a fővárosi arisztokrata szalonok látványossága lett, és számos jótékonysági koncertet is adott.

            Első zenetanára Wojciech Żywny (1756–1842) hegedűművész volt, aki 1816-tól 1822-ig volt mestere, míg a tanítványa túl nem szárnyalta. Tehetségének további fejlesztését Wilhelm Würfel (Václav Wefel), neves zongorista és a Varsói Konzervatórium professzora vette át. 1823 és 1826 között a varsói líceumba járt, ahol édesapja is tanított. Nyaranta a szünidőt vidéken töltötte iskolai barátainál; ez időben alaposan megismerte és megszerette a lengyel népzenét, amely egyik alapját képezte későbbi műveinek is. 1826 őszétől zeneelméletet és zeneszerzést kezdett tanulni a Varsói Konzervatóriumban Józef Elsner zeneszerző keze alatt. 1831-ben Bécsbe utazott, majd Párizsban telepedett le, ahol élete java részét töltötte.

            Bécstől a párizsi karrierig
            Chopin 1829-ben járt Bécsben először, ahol zongorakoncerteket adott, és kedvező kritikákat kapott. A következő évben visszatért Varsóba, ahol a Nemzeti Színházban március 17-én bemutatta f-moll zongoraversenyét. 1831-ben Chopin örökre elhagyta Lengyelországot, és Párizsban telepedett le. 1835. augusztus 1-jén a francia állampolgárságot is megkapta.[1] Hozzákezdett az első scherzókhoz és balladákhoz, valamint etűdjei első kötetéhez. Ez idő tájt kezdődött az életét végigkísérő harca a tuberkulózissal.

            Az 1830-as évek eleje és közepe – amikor az elbukott novemberi felkelés után a nagy emigráció éppen megtelepedett Párizsban – nagyon termékeny korszaka volt. Legtöbb híres műve ekkor készült el, rendszeresen adott koncerteket, amelyekről rajongó kritikák születtek. 1838-ra Chopin ismert alakja lett Párizsnak. Közeli barátja volt az operaszerző Vincenzo Bellini és Eugène Delacroix, a festő. Barátja volt Hector Berlioz, Liszt Ferenc és Robert Schumann is; Chopin nekik ajánlotta egyes műveit.
        </p>
        <p class="card-text"><small class="text-muted">Élt: 1810-1849</small></p>
        <p class="card-text"><small class="text-muted">Műfaja: Klasszikus</small></p>
        <p class="card-text"><small class="text-muted">Hangszer: Zongora</small></p>
        <a class="btn btn-primary" href="./index.php">Vissza</a>
    </div>
</div>




<hr>
<div class="container my-5">
    <!-- itt majd azon id alapján fog menni akihez tartozik nagyon kezdetleges nek kell így kinézzen-->
    <h3>Az elérhető kották:</h3>
    <div class="sheet-items">
        <div class="row">

            <?php
            for ($i = 1; $i <= 8; $i++) {
                sheet_item([
                    'img_url'       => '/files/images/sheet_img.jpg',
                    'title'         => 'Merry-Go-Round Of Life',
                    'author_name'   => 'Joe Hisaishi',
                    'author_url'    => '/author/Joe-Hisaishi',
                    'genre'         => 'Klasszikus',
                    'page_number'   => 4,
                    'url'           => '/music/Merry-Go-Round-Of-Life'
                ]);
            }
            ?>
        </div>
    </div>
</div>