<!DOCTYPE html>
<html>
<body style="background-color:#ee5057;">
<head>
    <title>CampingNest | cart</title>
    <link rel="stylesheet" href="main.css">
    
</head>
    <header>
            <img src="img/logo_tent.jpg" width="200px">
            <h1>Campground Booking</h1>
    </header>
    <main>
    <h1 style="color:white;">Your Cart</h1>
        <?php if (count($cart) == 0) : ?>
            <p>There are no items in your cart.</p>
        <?php else: ?>
            <form action="." method="post">
                <input type="hidden" name="action" value="update">
                <table>
                    <tr id="cart_header">
                        <th class="left">Campground Location</th>
                        <th class="right">Cost</th>
                        <th class="right">Night</th>
                        <th class="right">Item Total</th>
                    </tr>
                <?php foreach($cart as $key => $item) :
                    $cost  = number_format($item['cost'],  2);
                    $total = number_format($item['total'], 2);
                ?>
                    <tr>
                        <td>
                            <?php echo $item['name']; ?>
                        </td>
                        <td class="right">
                            $<?php echo $cost; ?>
                        </td>
                        <td class="right">
                            <input type="text" class="cart_qty"
                                name="newqty[<?php echo $key; ?>]"
                                value="<?php echo $item['qty']; ?>">
                        </td>
                        <td class="right">
                            $<?php echo $total; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    <tr id="cart_footer">
                        <td colspan="3"><b>Subtotal</b></td>
                        <td>$<?php echo murach\cart\get_subtotal($cart); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="right">
                            <input type="submit" value="Update Cart">
                        </td>
                    </tr>
                </table>
            <p>Click "Update Cart" to update quantities in your
                cart.<br> Enter a quantity of 0 to remove an item.
            </p>
            </form>
        <?php endif; ?>
        <p><a href=".?action=show_add_item">Add Item</a></p>
        <p><a href=".?action=empty_cart">Empty Cart</a></p>
    </main>
</body>
</html>