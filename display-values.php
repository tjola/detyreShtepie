<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<!--Forma me te cilen perdoruesi ben perygjedhjen e vitit-->
<body>

    <div class="border-2 border-purple-100 border-opacity-100 p-4 m-6 w-1/2 align-center">
     
        <form action="" method="post" class="text-center">
            <h4 class="py-3 font-bold text-purple ">Ju lutem përzgjidhni një vit</h4>
            <input type="checkbox" name="vitet[]" value="2021"> 2021<br>
            <input type="checkbox" name="vitet[]" value="2022"> 2022<br>
            <input type="checkbox" name="vitet[]" value="2023"> 2023<br>
            <input class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Kërko">
        </form>
<!-- Array me te dhenat per pajisjet-->
        <?php
        if (isset($_POST['submit'])) {
            $pajisjet = [
                "2021" => [
                    "Laptop" => 500,
                    "Smartphone" => 400,
                    "Tablet" => 100,
                    "Kompjuter Desktop" => 200
                ],
                "2022" => [
                    "Laptop" => 550,
                    "Smartphone" => 450,
                    "Tablet" => 120,
                    "Kompjuter Desktop" => 250
                ],
                "2023" => [
                    "Laptop" => 600,
                    "Smartphone" => 500,
                    "Tablet" => 150,
                    "Kompjuter Desktop" => 300
                ],
            ];

            $vitet_e_perzgjedhura = $_POST['vitet'];
//nese nuk ka asnje vit te perygjedhur jepet mesazhi me poshte
            if (count($vitet_e_perzgjedhura) == 0) {
                echo "<p>Përzgjidhni te paktën një nga vitet.</p>";
            } else {
                foreach ($vitet_e_perzgjedhura as $vitet) {
                    $shitjet_e_pajisjeve = $pajisjet[$vitet];
                    //sipas kerkesave duhet te kemi shitjet maximale ne baye te vitit te perzgjedhur
                    $shitjet_maksimale = max($shitjet_e_pajisjeve);
                    $pajisja_shitje_maksimale = array_search($shitjet_maksimale, $shitjet_e_pajisjeve);
                     //sipas kerkesave duhet te kemi shitjet minimale ne baye te vitit te perzgjedhur
                    $shitjet_minimale = min($shitjet_e_pajisjeve);
                    $pajisja_shitje_minimale = array_search($shitjet_minimale, $shitjet_e_pajisjeve);
                    //shitjet totale dhe mesatare ne rast se shitjet mesatare dalin me presje behet floor per rrumbullakosje te vleres qe te jete vlere e plote
                    $shitje_totale = array_sum($shitjet_e_pajisjeve);
                    $shitje_mesatare = floor($shitje_totale / count($shitjet_e_pajisjeve));
                    //afishimin e te gjithe variablave ne vendin e duhur sipas mesazhit perkates
                    echo "<h1 class='text-center'>Shitjet për vitin: $vitet</h1>";
                    echo "<table class='w-1/2 table-auto mx-auto border-2 py-4'>";
                    echo "<tr class=' bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 p-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left'><th>Pajisje</th><th>Shitje</th></tr>";
                    foreach ($shitjet_e_pajisjeve as $pajisje => $shitje) {
                        echo "<tr><td class='border-b border-gray-200 hover:bg-gray-100 p-2'>$pajisje</td><td class='border-b border-gray-200 hover:bg-gray-100'>$shitje</td></tr>";
                    }
                    echo "</table>";
                    echo "<p>Pajisja me e shitur:  $pajisja_shitje_maksimale ($shitjet_maksimale)</p>";
                    echo "<p>Pajisja me pak e shitur: $pajisja_shitje_minimale ($shitjet_minimale)</p>";
                    echo "<p>Sasia mesatare e shitjeve: $shitje_mesatare</p>";
                    echo "<p>Totali i shitjeve: $shitje_totale</p>";
                }
            }
        }
        ?>
    </div>
</body>

</html>