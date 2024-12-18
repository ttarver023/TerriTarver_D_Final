<?php
require_once('cart.php');

// Start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
session_set_cookie_params($lifetime, '/');
session_start();

// Get the cart array from the session
if (empty($_SESSION['cart13'])) {
    $cart = [];
} else {
    $cart = $_SESSION['cart13'];
}

// Create a table of products
$products = [
    'MMS-1754' => ['name' => 'campground A', 'cost' => '50.50'],
    'MMS-6289' => ['name' => 'campground B', 'cost' => '80.50'],
    'MMS-3408' => ['name' => 'campground C', 'cost' => '30.50'],
    'MMS-1234' => ['name' => 'campground D', 'cost' => '100.00'],

];

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed
switch($action) {
    case 'add':
        $key = filter_input(INPUT_POST, 'productkey');
        $quantity = filter_input(INPUT_POST, 'itemqty');
        $product = $products[$key];
        murach\cart\add_item($cart, $key, $quantity, $product);
        $_SESSION['cart13'] = $cart;
        header('Location: .?action=show_cart');
        break;
    case 'update':
        $new_qty_list = filter_input(INPUT_POST, 'newqty', 
                FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach($new_qty_list as $key => $qty) {
            if ($cart[$key]['qty'] != $qty) {
                murach\cart\update_item($cart, $key, $qty);
            }
        }
        $_SESSION['cart13'] = $cart;
        header('Location: .?action=show_cart');
        break;
    case 'show_cart':
        include('cart_view.php');
        break;
    case 'show_add_item':
        include('add_item_view.php');
        break;
    case 'empty_cart':
        $cart = [];
        $_SESSION['cart13'] = $cart;
        include('cart_view.php');
        break;
}
?>