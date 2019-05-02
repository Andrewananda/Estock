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

$checkIfOrderLineItemExist = mysqli_query($con, "select * from orders_line_item where order_id='{$orderDetails['id']}' and product_id = '$productId'");
$numOrdersLineItem = mysqli_num_rows($checkIfOrderLineItemExist);


if ($numOrdersLineItem > 1) {
    mysqli_query($con, "update orders set amount = amount - '{$product['selling_price']}' where salesperson_id = '$salesPersonId' and status = '0'");
    mysqli_query($con, "delete from orders_line_item where order_id='{$orderDetails['id']}' and product_id = '$productId'");
}else {
    mysqli_query($con, "delete from orders_line_item where order_id='{$orderDetails['id']}' and product_id = '$productId'");
    mysqli_query($con,"delete from orders where id = '{$orderDetails['id']}'");
}
echo "Product removed from Cart";
