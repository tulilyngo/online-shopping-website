
<?php
require('functions.php');

//Get all GET Data
$no_ele = count($_GET);

//Process GET Data
if ($no_ele > 0)
{
    for ($i = 0; $i < count($_GET); $i++)
    {
        //Get the current key
        $ind = key($_GET);

        //Get the current value
        $data = $_GET[$ind];

        // Set data
        if ($ind == "id_no") {
            $item_no = $data;
        } else if ($ind == "desc") {
            $desc = $data;
        } else if ($ind == "image") {
            $image = $data;
        } else {
            break;
        }

        next($_GET);
    }
}

// set my mySQL
$item_name = getItemName($item_no);
$price = getPrice($item_no);
$inventory = getInventory($item_no);


?>

<html>
<head>
    <title>Nunavut | Product</title>
    <link rel="Stylesheet" href="product_style.css" />

</head>
<body>
    <?php
    // Print item's name
    print("<h1>");
    print("$item_name");
    print("</h1>");

    // Print item's image
    print("<br/>");
    print("<img alt=\"\" src=\"");
    print("$image");
    print("\"/>");

    // Print item's description
    print("<p>");
    print("$desc");
    print("</p>");

    // Print item's info
    print("<br />");
    print("<form>");
    print("<label>Price: </label>");
    print("<span>");
    print("$");
    print("$price");
    print("</span><br />");


    // Process inventory
    if ($inventory > 0) {
        print("<label>Quantity: </label>");
        print("<input type=\"text\" id=\"quantity\" maxlength=\"2\" pattern=\"[0-9][0-9]?\"/>");
        print("<br />");
        print("<br />");
        $product = $item_no.','.$image.','.$item_name.','.$price.','.$inventory;
        print("<input id=addbox name=\"$product\" type=button alt=\"Buy Now\" onclick=additem() ><BR/>");
        print("</form>");

    } else {
        print("<BR/><H1>Sold Out</H1>");
        print("</center>");
        echo "<script language=javascript>alert('Sold Out');</script>";
        print("</form>");
    }



    ?>
</body>
</html>


<script type="text/javascript">
    function additem()
    {
        <?php
        print('inventory = '."$inventory".';');
        ?>

        var quantity = document.getElementById('quantity').value;
        quantity = parseInt(quantity);


        if (quantity > inventory) {
            <?php
            print('name = "'."$item_name".'";');
            ?>
            alert("Only " + inventory.toString() + " " + name + " left in stock");
        } else {
            var product = document.getElementById("addbox").name;
            sessionStorage.setItem(product, quantity);
            open("checkout.html", "_self");
        }

    }



</script>