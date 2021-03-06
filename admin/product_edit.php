<?php
    include "../config.php";
    checkLogin();
    $categories = $db->query("SELECT * FROM categories");

    $productId = (int) $_GET['id'];
    $result = $db->query("SELECT * FROM products WHERE id=$productId");
    $product = $result->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($product);
    // die;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // collecting posted values into varaibles
        $id = (int) $_POST['id'];
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // preparing insert sql (DML)
        $sql = "UPDATE products
                SET category_id=$category_id,
                name='$name',
                price=$price,
                description='$description',
                status=$status
                WHERE id=$id";

        // Run the sql
        $db->query($sql);

        // Updating image
        $target = "../uploads/products";
        if (is_uploaded_file($_FILES['product_image']['tmp_name'])) {
            $oldFileName = $_POST['old_product_image'];
            if (file_exists("../uploads/products/$oldFileName")) {
                unlink("../uploads/products/$oldFileName");
            }

            $filename = $id.'-'.$_FILES['product_image']['name'];
            move_uploaded_file($_FILES['product_image']['tmp_name'], $target.'/'.$filename);
            $sqlUpdate = "UPDATE products set product_image='$filename' where id=$id";
            $db->query($sqlUpdate);
        }

        header("Location: products.php?message=Product successfully updated!");
        die;
    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php include 'partials/head.php'; ?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'partials/header.php'; ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'partials/menu.php'; ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Create New Product</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Admin</a></li>
                                    <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- Notice -->
            <?php if(isset($_GET['message'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                        echo $_GET['message'];
                    ?>
                </div>
            <?php } ?>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="hidden" name="id" value="<?php echo $productId; ?>">
                                <div class="card-body">
                                    <h4 class="card-title">Fill the details:</h4>
                                    <div class="form-group row">
                                        <label for="category" class="col-sm-3 control-label col-form-label">Select Category</label>
                                        <div class="col-sm-9">
                                            <select  name="category_id" class="form-control">
                                                <option value="" selected="">Select Category</option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category['id']; ?>" <?php echo $product['category_id'] == $category['id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control" id="name" placeholder="Product Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-3 control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="price" value="<?php echo $product['price']; ?>" class="form-control" id="price" placeholder="Product Price" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3" for="product_image">Product Image</label>
                                        <div class="col-md-9">
                                            <div class="custom-file" id="pictureInput">
                                                <input type="file" name="product_image" id="product_image" class="custom-file-input" id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                            </div>
                                            <?php if (!empty($product['product_image'])) { ?>
                                                <input type="hidden" name="old_product_image" value="<?php echo $product['product_image']; ?>">
                                                <div id="target-photo" class="mt-2">
                                                    <img src="../uploads/products/<?php echo $product['product_image']; ?>">
                                                </div>
                                            <?php } else { ?>
                                                <div id="target-photo" class="mt-2"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" id="description" placeholder="Product Description..."><?php echo $product['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Status</label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation1" name="status" value="1" <?php echo $product['status'] == 1 ? 'checked="checked"': ''; ?> required>
                                                <label class="custom-control-label" for="customControlValidation1">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="status" value="0" <?php echo $product['status'] == 0 ? 'checked="checked"': ''; ?> required>
                                                <label class="custom-control-label" for="customControlValidation2">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'partials/footer.php'; ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <?php include 'partials/scripts.php'; ?>
    <!-- This is needed for image preview -->
    <script type="text/javascript">
      $(function() {
        $('#pictureInput').on('change', function(event) {
          var files = event.target.files;
          var image = files[0]
          var reader = new FileReader();
          reader.onload = function(file) {
            var img = new Image();
            img.src = file.target.result;
            $('#target-photo').html(img);
          }
          reader.readAsDataURL(image);
          console.log(files);
        });
      });
    </script>
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>
</body>

</html>