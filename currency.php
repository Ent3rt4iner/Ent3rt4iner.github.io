<?php
    $currencies = ["Euro", "US Dollar", "Schweizer Franken", "Pfund Sterling"];

    function buildExchangeRates($exchangeRates){
        for($i = 0; $i < count($exchangeRates); $i++){
            for($j = 0; $j < count($exchangeRates[$i]); $j++){
                $rate = $exchangeRates[$i][$j];
                if($rate == 0 && $i != $j) {
                    $exchangeRates[$i][$j] = 1 / $exchangeRates[$j][$i];
                } else if($i == $j){
                    $exchangeRates[$i][$j] = 1;
                }
            }
        }
        return $exchangeRates;
    }

    $exchangeRates = [
        [0, 1.1, 1.2, 0.9],
        [0, 0, 1.1, 0.8],
        [0, 0, 0, 0.75],
        [0, 0, 0, 0]
    ];
    $exchangeRates = buildExchangeRates($exchangeRates);

    $source = isset($_POST['source']) ? array_search($_POST['source'], $currencies) : "Euro";
    $destination = isset($_POST['destination']) ? array_search($_POST['destination'], $currencies) : "Euro";
?>

<h1>Währungsrechner</h1>
<form method="POST" action="index.php">
    <div>
        <div>
        <p class="mb-0 mt-5">Wert: </p>
            <input name="value" type="number" step="0.01" value="1" />
        </div>
        <div>
            <p class="mb-0 mt-5">Ausgangswährung: </p>
            <select name="source">
                <?php
                    foreach($currencies as $currency) {
                ?>
                    <option 
                        value="<?php echo $currency ?>"
                        <?php echo (strcmp($currencies[$source], $currency) == 0) ? " selected" : "" ?>
                        >
                        <?php echo $currency ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div>
            <p class="mb-0 mt-5">Zielwährung: </p>
            <select name="destination">
                <?php
                    foreach($currencies as $currency) {
                ?>
                    <option 
                        value="<?php echo $currency ?>"
                        <?php echo (strcmp($currencies[$destination], $currency) == 0) ? " selected" : "" ?>
                        >
                        <?php echo $currency ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>
    </div>
    <button class="btn btn-primary mt-5">Berechnen</button>
</form>

<?php
    if(isset($_POST['source']) && isset($_POST['destination']) && isset($_POST['value'])){
        $factor = $exchangeRates[$source][$destination];
        $result = round($factor * $_POST['value'], 2);
        ?>
            <p class="bold">
                Umrechnungsergebnis: <?php echo $result ?>
            </p>
        <?php
    }
?>
