<h1>Product</h1>
<?Php

var_dump($products);
foreach ($products as $product) {
?>
    <form method="post" action="product/remove">
        <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
        <button type="submit">
            delete one
        </button>
    </form>

<?php
}

?>