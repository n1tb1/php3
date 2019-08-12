<?php

for($size = 1000; $size < 1000000; $size *= 10) {
    echo PHP_EOL . "Testing inputing size: $size" . "<br>";
    for($s = microtime(true), $container = Array(), $i = 0; $i < $size; $i++) $container[$i] = NULL;
    echo "Array(): " . (microtime(true) - $s) . "<br>";

    $container1 = new SplFixedArray($size);
    for($s = microtime(true), $i = 0; $i < $size; $i++) $container1[$i] = NULL;
    echo "SplArray(): " . (microtime(true) - $s) . "<br><br>";

    echo PHP_EOL . "Testing checking size2: $size" . "<br>";
    $s = microtime(true);
    foreach($container as $key => $value) $container[$key] = NULL;
    echo "Array(): " . (microtime(true) - $s) . "<br>";

    $s = microtime(true);
    foreach($container1 as $key => $value) $container1[$key] = NULL;
    echo "SplArray(): " . (microtime(true) - $s) . "<br><br>";
}
