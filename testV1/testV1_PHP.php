<?php
function isPrime($num) {
    if ($num <= 1) return false;
    if ($num <= 3) return true;
    if ($num % 2 == 0 || $num % 3 == 0) return false;
    for ($i = 5; $i * $i <= $num; $i += 6) {
        if ($num % $i == 0 || $num % ($i + 2) == 0) return false;
    }
    return true;
}

$numbers = range(1, 100);
$numbers = array_reverse($numbers);

$result = array_map(function($num) {
    if (isPrime($num)) return null;
    if ($num % 3 == 0 && $num % 5 == 0) return "FooBar";
    if ($num % 3 == 0) return "Foo";
    if ($num % 5 == 0) return "Bar";
    return $num;
}, $numbers);

$result = array_filter($result, function($num) {
    return $num !== null;
});

echo implode(", ", $result);
?>
