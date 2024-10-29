<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="vue/public/css/normalize.css">
    <link rel="stylesheet" href="vue/public/css/style.css">
</head>
<body>
    <?php
    include("vue/header.php");
    echo $content;
    include("vue/footer.php");
    ?>
</body>
</html>