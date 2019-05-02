<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'db.php';
$productId = $_GET["id"];
$salesPersonId = $_GET['salesperson_id'];
$currentTime = date('Y-m-d H:i:s');

$productInfo = mysqli_query($con,"select *  from products where id = '$productId' limit 1");

$product = mysqli_fetch_array($productInfo);

//check if there exists a current sale by salesperson
$checkSale = mysqli_query($con, "select * from orders where salesperson_id = '$salesPersonId' and status = '0'");
$checkSaleResults = mysqli_num_rows($checkSale);
$orderDetails = mysqli_fetch_array($checkSale);

if ($checkSaleResults > 0) {
    mysqli_query($con, "update orders set amount = amount + '{$product['selling_price']}' where salesperson_id = '$salesPersonId' and status = '0'");
    mysqli_query($con, "insert into orders_line_item (order_id,product_id,quantity,cost) values('{$orderDetails['id']}','$productId','1','{$product['selling_price']}')");
}else {
    mysqli_query($con, "insert into orders (salesperson_id,amount,status,created_at) values ('$salesPersonId','{$product['selling_price']}','0','$currentTime')");
    $insertedOrder = mysqli_query($con, "select * from orders where salesperson_id = '$salesPersonId' and status = '0'");
    $insertedOrderDetails = mysqli_fetch_array($insertedOrder);
    $finalQuery = mysqli_query($con, "insert into orders_line_item (order_id,product_id,quantity,cost) values('{$insertedOrderDetails['id']}','$productId','1','{$product['selling_price']}')");
    if(!$finalQuery)
    {
        echo mysqli_error($con);
    }
}
echo "Product Added to Cart";
?>