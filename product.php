<?php
if (!isset($_SESSION)) {
    session_start();
}
$message = '';
$con = mysqli_connect("127.0.0.1", "root", "", "estock");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$productId = $_GET['id'];
$query = mysqli_query($con, "select * from products where id= '$productId'");
if ($query) {
    while ($row = mysqli_fetch_array($query)) {
        $name = $row['name'];
        $category = $row['category'];
        $quantity = $row['quantity'];
        $buying_price = $row['buying_price'];
        $selling_price = $row['selling_price'];
        $supplier_id = $row['supplier_id'];
        $created_at = $row['created_at'];
    }
}


if (isset($_POST['submit'])) {
    $id = $_POST['productId'];
    $nameNew = $_POST['name'];
    $categoryNew = $_POST['category'];
    $quantityNew = $_POST['quantity'];
    $buying_priceNew = $_POST['buying_price'];
    $selling_priceNew = $_POST['selling_price'];
    $supplier_idNew = $_POST['supplier_id'];

    $updateQuery = mysqli_query($con, "update products set name = '$nameNew',category = '$categoryNew',quantity = '$quantityNew'
,buying_price = '$buying_priceNew',selling_price = '$selling_priceNew',supplier_id = '$supplier_idNew' where id = '$id'");

    if ($updateQuery) {

         header("Location: products.php");
    } else {
        $message = "Sorry product has not been updated. Try again";
    }
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
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css">
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
    <?php include 'includes/side-bar.php' ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Product</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Product Statement
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div>
                                    <?php echo "<span style='color: red;'>" . $message . "</span><br>"; ?>
                                </div>
                                <form class="form" action="product.php" method="POST">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Name</p>
                                                <input class="form-control" type="text" name="name" placeholder="Name"
                                                       value="<?php echo $name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Category</p>
                                                <select name="category" id="category" class="form-control"
                                                        data-placeholder="Select Category...">
                                                    <option><?php echo $category; ?></option>
                                                    <option>Fruits</option>
                                                    <option>Bakery</option>
                                                    <option>Confectionery</option>
                                                    <option>Flour</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Supplier</p>
                                                <select name="supplier_id" id="supplier_id" class="form-control"
                                                        data-placeholder="Select Supplier...">
                                                    <?php
                                                    $query = mysqli_query($con, "select * from suppliers");

                                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                                        ?>
                                                        <option <?php if ($row['id'] == $supplier_id) echo 'selected'; ?>
                                                                value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Quantity</p>
                                                <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                                                <input class="form-control" type="number" name="quantity"
                                                       placeholder="Quantity" value="<?php echo $quantity; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Buying Price</p>
                                                <input class="form-control" type="number" name="buying_price"
                                                       placeholder="Buying Price" value="<?php echo $buying_price; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Selling Price</p>
                                                <input class="form-control" type="number" name="selling_price"
                                                       placeholder="Selling Price"
                                                       value="<?php echo $selling_price; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary pull-right">Save
                                            changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                    </div>

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
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment-with-locales.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.0.0/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/datetime-moment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('select').chosen();
    });
</script>

</body>
</html>