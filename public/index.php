<?php

//router
$pageParam = $_GET['page'] ?? ''; 
include '../view/layout/header.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toys Store</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../assets/index.js"></script>
    <script src="../assets/js/auth.js"></script>
    <link rel="stylesheet" href="../view/css/footerStyle.css">
    <link rel="stylesheet" href="../view/css/headerStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8a0a2d882c.js" crossorigin="anonymous"></script>
</head>
<body class="bg-white" style = "background-image: url('../view/resources/IMG/background.jpg')">

    <div class="container" style="margin-top: 79px;">
        <?php
        switch ($pageParam) {
            case '':
                include '../view/pages/home.php';
                echo'<link rel="stylesheet" href="../view/css/home.css">';
                echo'<script src="../assets/js/home.js"></script>';
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
</body>
<?php
include '../view/layout/footer.php';
?>
</html>