<?php
header('Content-Type: application/json');

$con = mysqli_connect("127.0.0.1", "root", "", "estock");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//$sqlQuery = "select name,email,address from users ORDER BY id desc ";
$sqlQuery = "SELECT date(created_at) As order_date
     , COUNT(id) AS num_orders
     , SUM(amount) AS daily_total
  FROM orders
 GROUP BY date(created_at)";

$result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
