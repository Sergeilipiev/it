<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    <link rel="stylesheet" href="css/style.css">-->
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .link {
            text-align: center;
            margin: 100px;
        }
    </style>
</head>
<body>
<header>
    <div class="link">
        <form id="myForm">
            <div><label for="link">Вставьте ссылку</label></div>
            <input id="link" type="text"><br/><br/>
            <div><label for="link2">Свое название ссылки (Не обязательно)</label></div>
            <input id="link2" type="text"><br/><br/>
            <input type="submit" value="Сгенерировать">
        </form>
        <br>
        <div id="content"></div>
    </div>
</header>
<script>
    jQuery(document).ready(function () {
        jQuery('#myForm').submit(function () {
            jQuery.ajax({
                type: "POST",
                url: "request.php",
                data: "link=" + $("#link").val() + "&" + "link2=" + $("#link2").val(),
                success: function (html) {
                    jQuery("#content").html(html);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>

<?php
$routes = explode('/', $_SERVER['REQUEST_URI']);
//echo $routes[1];
if ($routes[1]) {
    $csv = array_map('str_getcsv', file('file.csv'));
    foreach ($csv as $val) {
        if ($val[0] === $routes[1]) {
            echo $val[1];
            header("Location: " . $val[1]);
            break;
        }
    }
}
?>

