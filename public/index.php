<?php

$blogs = json_decode(file_get_contents('../bloglist.json'));
$counter = 0;

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

        <div class="row">

            <? foreach($blogs->blogs as $link => $alt) : ?>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="blog-link-<?=$counter?>" data-href="<?=$link?>" style="cursor:pointer">
                <div class="panel panel-default">
                    <div class="panel-heading"><? if ($alt) : ?><?=$alt?><? else: ?>Blog<? endif; ?></div>
                    <div class="panel-body">
                        <div href="<?=$link?>" class="embed-responsive embed-responsive-4by3" target="_blank">
                            <iframe src="<?=$link?>" class="embed-responsive-item" style="overflow:hidden"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <?
                $counter++;
                endforeach;
            ?>

        </div>

    </div>


    <script type="text/javascript" src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('div[id*=blog-link]').mousedown(function () {
                var href = $(this).data('href');

                window.open(href);
            });
        });
    </script>
</body>
</html>
