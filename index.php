<?php
require_once('database/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon" />
    <link rel="preload" as="image" href="assets/images/logo/logo.png">
    <title>Majelis Kopi</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/datatable.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <style>
        .fit {
            width: 1%;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <?php include_once('layout/sidebar.php'); ?>
    <div class="overlay"></div>

    <main class="main-wrapper">
        <?php include_once('layout/navbar.php'); ?>
        <?php
        if (isset($_GET['page'])) {
        } else include_once('halaman/dashboard/dashboard.php');
        ?>
    </main>
</body>

</html>