Redovisning
====================================

Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------

Första kursmomentet är nu klart men först lite om mig och mina uppfattningar.

Som jag sitter och programmerar just nu är på en Asus dator. Men mitt mål är att programmera på min Macbook pro. Jag vill sätta upp Sublime text 2 som jag har det på min asus dator. Att när jag sparar lokalt, sparas det även upp på servern. Jag har försökt ordna detta men det var inte så lätt som jag trodde så jag måste ta en närmre titt på det.

Jag är inte bekant med ramverk sens innan men det intresserad mig en del. Detta sättet att programmera har jag aldrig varit med om innan. Jag har varit den som har några html filer och en css fil men ju mer jag lär mig och ser hur man kan bygga upp det på ett betydligt enklare sätt. Men det är betydligt många fler filer att hålla reda på och svårare.

De begeppen jag läste om i artikeln "Objektorienterade konstruktioner för ramverk med PHP" har jag lite kunskap om men så som det beskrevs i den artikeln förstod jag det betydligt bättre än vad jag kunde innan.

Anax-MVC modellen är rolig, jag börjar få en aning om hur den fungerar. Mycket ha koll på och veta var det ligger och hur man ska göra allt.

Nu lite om hur det gick med kursmomentet. Det började med att vi var ett gäng på torsdagen som gick igenom hur Anax-MVC fungerar. Det fick mig att se hur det fungerade. Sen på kvällen började jag fila på om jag kunde få Sublime text 2 på min Macbook. Efter att jag insåg att jag inte skulle hinna göra det innan jag var tvungen att lämna in så släppte jag det och valde att göra det på min Asus.
Jag kom igång bra med "Bygg en me-sida med Anax-MVC" och allt flöt på. Emellanåt fick jag problem med att veta var koden skulle finnas och hur den skulle skriva. Jag fick problem med .htaccess filen med vad som skulle stå i den och hur. Det fick jag hjälp av en i chatten och vi diskuterad det och han förklarade vad som skulle ändras så den blev som den skulle. Jag hade glömt skriva in RewriteBase. Jag ändrade det och nu blev allt bättre när jag skulle kasta tärning.
Jag ändrade även i css filerna så jag får den att se lite mer som jag vill. Jag ändrade även header bilden och texten. Jag ändrade även färgerna på menyn så den matchar bilden i headern.

Kmom02: Kontroller och modeller
------------------------------------

Det första jag gjorde var att jag skulle installera så php fungerade. Problemet var bara att jag uppfattade det som om jag skulle göra det på studentservern så innan jag fick bukt på var jag skulle göra det och varför saker inte fungerade när jag kom längre in i kursmomentet hade en bra stund av veckan gått. Men jag fick tillslut PHP installerat på rätt ställe och det att fungera. Nästa var att installera composer och även denna blev att jag installerade på fel ställe. Men med lite hjälp av Mos så installerades det på rätt ställe och på rätt sätt. Nästa steg var det stora momentet. Det var att få in kommentarer på me-sidan. ’Det började ganska enkelt men när jag sedan var klar med guiden så skulle jag lägga in så jag kunde kommentera på två sidor på min me-sida. Jag valde då att sätta första sidan kommenterbar och även redovisningssidan. Jag fastnade på hur jag skulle göra för att få olika kommentarer på olika sidor. Det fick jag lösa genom att hålla koll på vilken sidan det var jag hade kommenterat på. Jag fick alltså skapa en variable till i post formuläret. När det sen fungerade fungerade inte det längre med att redigera eller att radera kommentarer. Då var det fel i funktionerna med vad jag skickade in för parametrar. Men för att hitta det problemet var inte helt lätt. Efter många om och men så lyckades problemet lokaliseras och nu fungera allt som det ska.

Att jobba med composer vet jag inte riktigt hur det känns. Jag har kommit igång men det är ändå en lång väg kvar känns det som. Jag har inte riktigt fått en hum om hur det fungerar.

Packagist har jag inte tittat på mycket på så jag vet inte riktigt vad det finns för något. Kanske senare hinner jag kanske titta på det och ta det då.

Kmom03: Bygg ett eget tema
------------------------------------

Detta kursmomentet trodde jag skulle vara roligare än vad det var. Det vara bara att fixa grids och inte mycket med design och färg som jag uppfattar som tema. Jag tycker det är bra med gridbaserad layout det delar upp koden och sidan på ett bättre sätt. Det är även lättare att få det på det sättet genom att göra gridlayout. Jag tyckte det var bra att om man gjorde sidan mindre på bredden att griden anpassade sig efter det.

Hur less är uppbyggt att man importar flera filer är både bra och dåligt. Då ska man veta var man har lagt varje sak men samtidigt blir det inte så långa filer att gå igenom för att hitta saker.

Min tidiga erfarenhet av CSS-ramverk på detta sättet är obefintlig. Jag har aldrig använt det.

Jag gjorde inget med detta temat då jag inte såg något att sväva iväg med. Förstår heller inte hur jag skulle göra det. Tveksam till om jag kommer använda mig av tema på detta sättet igen. Kanske vissa delar men inte allt.

Kämpa på och fortsätt framåt. Man måste kämpa för att klara av nya utmaningar.

Kmom04: Databasdrivna modeller
------------------------------------

De problemen jag hade på vägen var att när jag skulle installera Cform så skulle jag inte skriva ”composer install —no-dev” utan bara "composer install”. Visste inte riktigt varför men det var blandat genom hela kursmomentet och när jag skulle installera CDatabase så blev det problem igen. Det löste jag genom att bara köra ”composer update”.

När jag sedan skulle göra kontakt med databasen så hitta den inte min config-fil och det var inte så konstigt då den inte var inkluderad i filen jag körde. Det löstes ju enkelt genom att inkludera den.

Mina tankar på formulär är kul. Speciellt nu när man sparar kommentarerna och användarna i en databas istället för att de sparas i session. Det gör det lite roligare och kommentarerna finns kvar. Jag valde att istället för sqlite, mySQL. Varför jag gjorde det kan jag inte förklara utan mer att jag har jobbat mer med mySQL innan. Nästa steg är ju att länka samman användarna och kommentarerna. Så man kan se vem som har kommenterat det genom att användaren syns.

Kmom05: Bygg ut ramverket
------------------------------------

Jag valde att bygga ut mitt ramverk så jag kan få RSS flöde från dbwebb forumet. Det kändes kul att ha det då det är programmering och det är just det som jag håller på med nu. Den koden jag hittade var ifrån ett kod exempel på w3schools.se (http://www.w3schools.com/php/php_ajax_rss_reader.asp). Det ger ett exempel på nyheter från Google och NBC. Så jag fick istället klistra in rss länken för forumet på dbwebb och försöka utläsa vad jag skulle hämta för att få det att bli snyggt. Det var väldigt svårt att ta reda på vilka variabler man skulle hämta från filen men efter många timmars hårt arbete ramlade det äntligen ner i knäet.

När jag sedan hade en fungerande test sida så skulle jag implementera det som en router på min index.php sida. Jag fick även då första göra om det så jag skapade en klass, RSS.
När jag sen hade skapat det så skulle jag göra så att routen fungerade. Det fungerade felfritt och jag har nu en RSS flödes sida.

Att få upp det på Github och sen vidare till Packagist var lättare än vad jag trodde det skulle vara. Jag fick lite problem när jag skulle göra så att det var autoload på Packagist. Det jag missade då var att lägga in domänen på GitHub inställningarna. Sen skulle jag även tycka på ”test service” på GitHub och när jag hade gjort det fungerade allt där med.

Kmom06: Verktyg och CI
------------------------------------

Jag stötte inte på jätte många problem på detta moment men det var svårt att få till min test fil. Först hade jag problem med att den inte hittande min test fil för att de inte hade rätt namn. När det väl var ändrat gick det fort att fixa.

Under detta moment har jag lärt mig hur jag laddar upp filer till GitHub via terminalen och det är väldigt användbart! Tre kommandon sen ligger de senaste filerna på GitHub.

Innan jag gjorde detta moment visste jag inte att man skulle testa filer och klasser på detta sätt. Det är ju ett rätt bra sätt att testa så sakerna fungerar som de ska. Så för mig var detta helt nytt.

Det jobbigaste var att fixa test filen med PHPUnit. Men att fixa med Travis och Scrutinizer var lätt. Det gick snabbt att göra de delarna. Att jobba med Travis och Scrutinizer tyckte jag var enkelt och smart. Tummen upp för de verktygen.
