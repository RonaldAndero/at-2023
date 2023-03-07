<?php if ($auth->is_admin): ?>

    <h3><?= __("Abi") ?></h3>

    <div class="help-box">
        <h4>Tulemused</h4>
        <ul>

            <li>Tulemuste lehel on võimalik ükshaaval igat testi tulemust kustutada.</li>
            <li>Tulemuste lehel on lahter "Korduv", mille all on nupp "Luba". Selle nupuga on
                võimalik lubada sisseastujal testi uuesti teha, kui mingil põhjusel peaks midagi
                valesti minema.
            </li>
            <li>Tulemuste lehel on nupp "Tühjenda", mis liigutab kõik andmed Tulemuste tabelist
                Logi tabelisse.
            </li>
        </ul>
        <hr>
        <h4>Praktilised ülesanded</h4>
        <ul>
            <li>Praktiliste ülesannete lehel saab lisada, muuta ja kustutada praktilisi ülesandeid.</li>
        </ul>
        <hr>
        <h4>Teoreetilised küsimused</h4>
        <ul>
            <li>Teoreetiliste küsimuste lehel saab lisada, muuta ja kustutada teoreetilisi küsimusi.</li>
            <li>Teoreetiliste küsimuste lisamiseks on nupp "Lisa küsimus", millele vajutades avaneb moodulaken, kus saab
                lisada küsimuse ja vastusevariandid.
            </li>
            <li>Teoreetilisi küsimusi saab pealkirja järgi otsida kasutades otsingumootorit.</li>
        </ul>
        <hr>
        <h4>Hindamine</h4>
        <ul>
            <li>Hindamise lehel saab vasakul asuvast tabelist valida isiku, kelle praktilist testi
                hinnata. Hinnata saab 10-palli süsteemis ning hinde valimisel uuendatakse hinne
                automaatselt.
            </li>
            <li>
                Vajutades ülesande pealkirjale avaneb ülesande kirjeldus moodulaknas.
            </li>
            <li>Vajutades nupule "Eelvaade" on võimalik moodulaknas vaadata
                sisseastuja HTMLi koodi tulemust.
            </li>
            <li>Lingile vajutades avaneb HTMLi koodi tulemus uues
                aknas.
            </li>
        </ul>
        <hr>
        <h4>Logi</h4>
        <ul>
            <li>Logi tabelist saab vaadata vanu tulemusi, mis on tulemuste tabelist ära kustutatud.</li>
            <li>Logi tabelist saab otsida inimesi kõigi tabeli väärtuste järgi.</li>
            <li>Logi tabelis saab järjestada inimesi kõigi tabeli parameetrite järgi kasvavalt kahanevaks või
                vastupidi.
            </li>
        </ul>
        <hr>
        <h4>Seaded</h4>
        <ul>
            <li>Seadete lehel saab muuta teoreetiliste küsimuste arvu testis, genereerida testile uut PIN-koodi, avada
                ja sulgeda testi ning määrata kui kaua test avatud on, 2-8 tundi.
            </li>
            <li>Seadete lehel saab valida, kas kasutada HTML koodi valideerimist W3C API kaudu, kas
                kuvada HTML-i reaalajas eelvaadet praktilise ülesande juures, kas pingerida on
                avalik või mitte, ja kui on avalik, siis kas nimed on avalikud või peidetud.
            </li>
            <li>Võimalik on vahetada ka administraatori parooli. Parooli vahetamisel tuleb täita
                teatud kriteeriumid.
            </li>
        </ul>
        <h4>Üldine</h4>
        <ul>
            <li>Samal ajal ei ole võimalik olla sisselogitud administraatorina ja testilahendajana.</li>
            <li>Välja logida on ka võimalik brauseris kui kirjutada pealehe URL-i taha "/logout"</li>
        </ul>
    </div>
<?php endif; ?>