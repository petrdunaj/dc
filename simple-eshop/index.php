<?php
session_start();
require_once "products.php";
require_once "basket.php";
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <title>simple e-shop</title>
</head>
<body>

<h1>simple e-shop</h1>
<a id="shoppingbasket" href="checkout.php"><img src="cart.png"><?php if($basket>0){echo "<span>$basket</span>";} ?></a>

<?php $prodList->printOut(); ?>

</body>
</html>
