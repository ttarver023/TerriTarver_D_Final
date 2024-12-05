<!DOCTYPE html>
<html>
<head>
    <title>CampingNest | Booking</title>
    <link rel="stylesheet" href="main.css">
    
</head>
<body style="background-color:#ee5057;">
    <header>
        <img src="img/logo_tent.jpg" width="200px">
        <h1>Campground Booking</h1>
    </header>
    <main>
        <h1 style="color:white;">Add Item</h1>
        <form action="." method="post" >
            <input type="hidden" name="action" value="add">

            <label>Name:</label>
            <select name="productkey">
            <?php foreach($products as $key => $product) :
                $cost = number_format($product['cost'], 2);
                $name = $product['name'];
                $item = $name . ' ($' . $cost . ')';
            ?>
                <option value="<?php echo $key; ?>">
                    <?php echo $item; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Night:</label>
            <select name="itemqty">
            <?php for($i = 1; $i <= 10; $i++) : ?>
                <option value="<?php echo $i; ?>">
                    <?php echo $i; ?>
                </option>
            <?php endfor; ?>
            </select><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Item">
        </form>
        <p><a href=".?action=show_cart">View Cart</a></p>
    </main>
</body>
</html>