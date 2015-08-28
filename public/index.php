<?php

$blogs = json_decode(file_get_contents('../bloglist.json'));

?>

<!DOCTYPE html>
<html>
<head>
    <title><?=$blogs->name?></title>

    <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/vendor/font-awesome/css/font-awesome.min.css" />
</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1><?=$blogs->name?> <small><?=$blogs->description?></small></h1>
        </div>

        

    </div>


    <script type="text/javascript" src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
