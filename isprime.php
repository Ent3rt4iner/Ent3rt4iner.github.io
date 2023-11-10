<?php

function isPrime($number){
    $maxMultiplikator=sqrt($number);
    for ( $i = 2; $i <= $maxMultiplikator; $i++ ){
        if ($number % $i == 0){
            return false;            
        }
    }
    return true;
}

$insertedNumber = isset($_POST['max']) ? $_POST['max'] : 0;
$primes = [];

if($insertedNumber > 0) {
    for($i = 2; $i <= $insertedNumber; $i++){
        if(isPrime($i))
            array_push($primes, $i);
    }
}
?>


<h1>Primzahlen</h1>
<form method="post" action="index.php">
    <input type="number" name="max" placeholder="Maximum" required/>
    <input class="btn btn-primary" type="submit" value="Berechnen" />
</form>

<?php

if($insertedNumber > 0){
    ?>
    
    <p>
        Zwischen 0 und <?php echo $insertedNumber ?> gibt es <?php echo count($primes) ?> Primzahlen:
        <?php
            foreach ($primes as $value){
                echo "<br>$value";
            }
        ?> 
    </p>

    <?php
}

?>
