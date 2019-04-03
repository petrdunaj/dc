<!--
<?php
if (isset($_GET["addtobasket"])) {
    $basketProducts = array();
    $notInBasket = true;
    if (isset($_SESSION["basket"])) {
        $basketProducts = $_SESSION["basket"];
        foreach ($basketProducts as $id=>$value) {
            if ($id == $_GET["addtobasket"]) {
                echo "$id >> $value\n";
                $basketProducts[$id] = ++$value;
                $notInBasket = false;
            }
        }
    }
    if (!isset($_SESSION["basket"]) or $notInBasket) {
        $basketProducts[$_GET["addtobasket"]] = 1;
    }
    $_SESSION["basket"] = $basketProducts;
}

$basket = 0;
if (isset($_SESSION["basket"])) {
    $basket = count($_SESSION["basket"]);
}
?>
-->
