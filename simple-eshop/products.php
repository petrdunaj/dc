<?php
require_once "mysql.php";
class product {
    public $id;
    public $name;
    public $price;
    public $imgurl;
    public $onstock;
    public $categories = array();

    public function __construct($id, $name, $price, $imgurl, $onstock, $categories)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->imgurl = $imgurl;
        $this->onstock = $onstock;
        $this->categories = $categories;
    }
}

class products {
    private $items = array();

    function __construct() {
		$this->items = array();
    }
    public function addProduct(product $prod) {
        $this->items[$prod->id] = $prod;
    }
    public function printOut() {
        echo "<div id=\"products\">\n";
        foreach ($this->items as $product) {
            echo "\t<div class=\"prod\">\n";
            echo "\t\t<img src=\"$product->imgurl\">\n";
            echo "\t\t<div class=\"name\">\n\t\t\t<div class=\"categories\">";
            foreach ($product->categories as $category) {
                echo "<span>$category</span>";
            }
            echo "</div>\n\t\t\t<p>" . $product->name . "</p>\n\t\t</div>\n";
            echo "\t\t<div class=\"basket\">\n";
            echo "\t\t\t<div class=\"price\">$ " . $product->price . "</div>\n";
            echo "\t\t\t<div class=\"" . ($product->onstock ? "onstock" : "outofstock") ."\">" . ($product->onstock ? "on stock" : "out of stock") ."</div>\n";
            echo "\t\t\t<a class=\"green-button\" href=\"?addtobasket=$product->id\">add to basket</a>\n";
            echo "\t\t</div>\n";
            echo "\t</div>\n";
        }
        echo "</div>\n";
    }
    public function checkoutList() {
        echo "<div id=\"checkout\">\n";
        if (isset($_SESSION["basket"])) {
            echo "\t<table>\n\t\t<tr><th>Product</th><th>stock</th><th>price</th><th>quantity</th><th>total price</th></tr>\n";
            $totalPrice = 0;
            $notOnStock = false;
            foreach ($_SESSION["basket"] as $id=>$value) {
                echo "\t\t<tr><td>" . $this->items[$id]->name . "</td><td>" . ($this->items[$id]->onstock ? "on stock" : "out of stock") ."</td><td>$ " . $this->items[$id]->price . "</td><td>$value</td><td>$ " . ($this->items[$id]->price)*$value . "</td></tr>\n";
                $totalPrice += ($this->items[$id]->price)*$value;
                if ($this->items[$id]->onstock == false) { $notOnStock = true; }
            }
            echo "\t\t<tr><td>&nbsp;</td></tr>\n\t\t<tr><td></td><td colspan=\"4\"><h3>Total price: $ $totalPrice</h3></td></tr>\n";
            echo "\t\t<tr><td></td><td colspan=\"4\"><a class=\"red-button\" href=\"?deletebasket\">REMOVE ALL</a> ";
            echo $notOnStock ? "<a class=\"grey-button\">CHECK ON STOCK</a>" : "<a class=\"green-button\" href=\"#\">PLACE ORDER</a>";
            echo "</td></tr>\n";
        } else {
            echo "Shopping basket is empty ...";
        }
        echo "\t</table>\n</div>\n";
    }
}

$prodList = new products();
/*
$prodList->addProduct(new product(1, "Lorem ipsum dolor sit amet", 19, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", true, ["catA", "catB", "catE"]));
$prodList->addProduct(new product(2, "Consectetur adipiscing elit", 11, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", true, ["catC", "catD"]));
$prodList->addProduct(new product(3, "Vestibulum sed magna bibendum", 13, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", true, ["catA"]));
$prodList->addProduct(new product(4, "venenatis lorem et", 5, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", false, ["catB"]));
$prodList->addProduct(new product(5, "viverra ante", 17, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", true, ["catC"]));
$prodList->addProduct(new product(6, "Duis nec viverra dolor", 29, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", false, ["catB", "catC"]));
$prodList->addProduct(new product(7, "Pellentesque erat ex", 7, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", true, ["catA", "catD"]));
$prodList->addProduct(new product(8, "scelerisque sit amet lectus id", 23, "https://www.dixonscarphone.com/~/media/Images/D/Dixons-Carphone/logo/dc-social-logo.jpg", true, ["catD"]));
*/

function getProductsFromDB($mysql) {
    $q = "SELECT * FROM products";
    $p = $mysql->query($q);
    if ($p->num_rows > 0) {
        global $prodList;
        while ($r = $p->fetch_assoc()) {
            $q = "SELECT c.name FROM prod_cat pc JOIN categories c ON pc.id_cat = c.id WHERE pc.id_prod = " . $r["id"] . " ORDER BY c.id";
            $c = $mysql->query($q);
            $cat = array();
            while ($cc = $c->fetch_assoc()) { $cat[] = $cc['name']; }
            $prodList->addProduct(new product($r["id"], $r["name"], $r["price"], $r["imgurl"], $r["onstock"] ? true : false, $cat));
        }
    }
}
getProductsFromDB($conn);
?>
