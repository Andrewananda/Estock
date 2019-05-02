<?php
if (!isset($_SESSION)) {
    session_start();
}

$salesPersonId = $_SESSION['id'];

$con = mysqli_connect("127.0.0.1", "root", "", "estock");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kotem General Stores</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.0.0/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/skins/square/purple.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
    <?php include 'includes/side-bar.php'?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Cart</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="products.php" class="btn btn-primary btn-sm pull-right add-btn"><i class="fa fa-plus"></i> Add Item</a>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Shopping Cart
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Selling Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $getOrders = mysqli_query($con, "select * from orders where salesperson_id = '$salesPersonId' and status = '0'");
                                    $orderDetails = mysqli_fetch_array($getOrders);
                                    $query = mysqli_query($con, "select * from orders_line_item where order_id = '{$orderDetails['id']}'");

                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        $productId = $row['product_id'];
                                        $getProductQuery = mysqli_query($con, "select * from products where id = '$productId'");
                                        $getProductDetails = mysqli_fetch_array($getProductQuery);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo $getProductDetails['name'];?></td>
                                            <td class="center"><?php echo $row['quantity'];?></td>
                                            <td class="center"><?php echo $getProductDetails['selling_price'];?></td>
                                            <td class="center">
                                                <button id="<?php echo $row['id'] ?>" class="btn btn-danger" onclick="removeFromCart(this.id)"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <!-- /.table-responsive -->
                                <div class="well">
                                    <h4>Total:</h4>
                                    <span class="badge badge-info"><?php echo 'Ksh. '.$orderDetails['amount']; ?></span>
                                </div>
                                <a href="checkout.php" class="btn btn-primary"><i class="fa fa-money"></i> Checkout</a>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.0.0/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/datetime-moment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<!-- Custom Theme JavaScript -->

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

<script>
    function removeFromCart(id) {
        let salesPersonId = "<?php echo $salesPersonId; ?>";
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                location.reload()
            }
        }
        xmlhttp.open("GET", "remove-cart.php?id=" + id+ "&salesperson_id=" + salesPersonId, true);
        xmlhttp.send();

    }
</script>

</body>
</html>