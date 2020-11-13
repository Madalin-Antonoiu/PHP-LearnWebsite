<?php 

# Functions
// function sayHello($name){
//     echo "Hello there, $name! <br />";
// }
//sayHello("Mads");


function formatProduct($product){
    //echo "{$product['name']} costs ${product['price']} to buy <br />";
    return "{$product['name']} costs ${product['price']} to buy <br />";
}
//formatProduct(['name' => 'car', 'price' => 100])
$formated = formatProduct(['name' => 'car', 'price' => 100])


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"Luv PHP"</title>
</head>
<body>

<h1><?php echo $formated ?></h1>

</body>
</html>