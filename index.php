<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/vscar/styles/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/vscar/styles/globals.css">
    <title>Vscar</title>
</head>

<body id="<?php
$request = rtrim(explode("?", $_SERVER["REQUEST_URI"])[0], "/");
$isAdminRoute = false;

if (strpos($request, '/vscar/admin') === 0) {
    $isAdminRoute = true;
}

if ($isAdminRoute) {
    echo "body-pd";
} else {
    echo "body-user";
}
?>">


    <?php
    require_once("./router/Router.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

    <script src="/vscar/scripts/globals.js" type="text/javascript"> </script>




</body>

</html>