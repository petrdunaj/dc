<?php
session_start();
require_once('products.php');
if (isset($_GET["deletebasket"])) {
    unset($_SESSION["basket"]);
}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <title>simple e-shop - checkout</title>
</head>
<body>

<h1><a href=".">simple e-shop</a> - checkout</h1>

<?php
$prodList->checkoutList();
?>

</body>
</html>
