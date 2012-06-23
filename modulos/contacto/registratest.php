<?php
//foreach ($_REQUEST as $key => $value) {
//    echo "<i>$key</i> = $value<br>";
//}


mt_srand(time());
for ($i = 0; $i < 10; $i++) {
    
    $aleatorio = mt_rand(1, 50);
    echo $aleatorio."<br>";
}
    