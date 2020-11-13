<?php 

# comparison and booleans
// echo true; // "1"
// echo false; // ""
// echo 5 > 10;
//echo '5' == 5;
//echo '5' === 5;
//echo 'shaun' == 'Shaun';

# Conditional statements
// $price = 20;
// if($price < 30){
//     echo "Hurray";
// } else {
//     echo "Nay";
// }

# Continue and break

$products = [
    ['name' => 'shiny star', 'price' => 20],
    ['name' => 'green shell', 'price' => 10],
    ['name' => 'red shell', 'price' => 15],
    ['name' => 'gold coin', 'price' => 5],
    ['name' => 'lightning bolt', 'price' => 40],
    ['name' => 'banana skin', 'price' => 2]
];

// If loop finds gold coin it goes out of the loop imediately;
foreach($products as $product){
    if($product['name'] === 'gold coin'){
        break;
    }
    echo $product['name'] . '<br/>';
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP</title>
</head>
<body>
    <!--<h1>hello, ninjas!</h1> -->

</body>
</html>