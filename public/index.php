<?php
//router
$pageParam = $_GET['page'] ?? ''; 
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toys Store</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
    
    <link rel="stylesheet" href="../view/css/global.css">
    <link rel="stylesheet" href="../view/css/footerStyle.css">
    <link rel="stylesheet" href="../view/css/headerStyle.css">
    <link rel="stylesheet" href="../view/css/cart.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8a0a2d882c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="bg-white" style = "background-image: url('../view/resources/IMG/b.jpg');background-attachment: fixed; background-repeat: no-repeat; background-size: cover; ">
    <?php 
    include '../view/layout/header.php';
    $marginClass = in_array($pageParam, ['login', 'sign-up', 'account']) ? 'mt-5' : 'default-margin'; 
    ?>
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fa fa-arrow-up"></i>
    </a>
    <script src="../assets/js/product.js"></script>
    <div class="container <?php echo $marginClass; ?>" >
        <?php
        switch ($pageParam) {
            case '':
                include '../view/pages/home.php';
                echo'<link rel="stylesheet" href="../view/css/home.css">';
                echo'<script src="../assets/js/home.js"></script>';
                break;
            case 'cart':
                include '../view/pages/cart.php';
                echo'<link rel="stylesheet" href="../view/css/cart.css">';
                echo'<script src="../assets/js/cart.js"></script>';
                break;
            case 'login':
                include '../view/middlewares/redirectAuthentication.php';
                include '../view/pages/login.php';
                break;
            case 'sign-up':
                include '../view/pages/register.php';
                break;
            case 'account':
                include '../view/middlewares/AuthMiddleware.php';
                include '../view/pages/account.php';
                echo '<link rel="stylesheet" href="../view/css/account.css">';
                echo '<script src="../assets/js/account.js"></script>';
                break;
            case 'pay':
                include '../view/pages/pay.php';
                echo '<link rel="stylesheet" href="../view/css/pay.css">';
                echo '<script src="../assets/js/pay.js"></script>';
                break;
            case 'forum':
                include '../view/pages/forum.php';
                echo '<link rel="stylesheet" href="../view/css/forum.css">';
                echo '<script src="../assets/js/forum.js"></script>';
                break;
            case 'product':
                include '../view/pages/product.php';
                echo '<link rel="stylesheet" href="../view/css/product.css">';
                echo '<script src="../assets/js/product.js"></script>';
                break;
            case 'product-detail':
                include '../view/pages/product_detail.php';
                echo '<link rel="stylesheet" href="../view/css/product_detail.css">';
                echo '<script src="../assets/js/product_detail.js"></script>';
                break;
            default:
                # code...
                break;
        }
        ?> 
        <!-- Back to Top Button -->
        <a href="#" class="back-to-top" id="backToTop">
            <i class="fa fa-arrow-up"></i>
        </a>
    </div>
    <script src="../assets/js/mobileMenu.js"></script>
    <script src="../assets/index.js"></script>
    <script src="../assets/js/auth.js"></script>
    <script src="../assets/js/cart.js"></script>
</body>
</html>
<?php
include '../view/layout/footer.php';
?>