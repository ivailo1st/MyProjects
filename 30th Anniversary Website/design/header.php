<?php require_once("title.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $siteName . '' . $title; ?></title>
    <meta name="description" content="<?php echo $siteName . '' . $title; ?>">
    <base href="<?php echo (($siteBase == '') ? '/' : $siteBase); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='favicon.ico' rel='icon' type='image/x-icon'/>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/nightwing-full-gutter.min.css">
    <link rel="stylesheet" href="js/jquery.fancybox.css" />
    <link rel="stylesheet" href="css/main.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">Използвате <strong>остарял</strong> уеб браузър. Молим ви да го <a href="http://browsehappy.com/">ъпгрейднете</a>, за да подобрите вашието ["experience" ама като го преведа "изживяване" не звучи яко :D].</p>
    <![endif]-->
    <?php
        $isLoggedIn = (isset($_COOKIE['logged']) ? $_COOKIE['logged'] : false);
        echo ($isLoggedIn ? '<a href="cp.php"><img src="img/cp_icon.png" id="loggedLogo"/></a>' : '');
    ?>

    <header>
        <div class="titles">
            <h1>30 Години</h1>
            <h2>СОУ "Св. Климент Охридски"<br> гр.Троян</h2>
        </div>
    </header>

    <?php include ('navigation.php'); ?>

    <div class="container-custom">
        <div class="row">
            <section id="main" class="span9">