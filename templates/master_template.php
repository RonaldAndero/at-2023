<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= BASE_URL ?>">
    <title>Sisseastumine</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="vendor/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/codemirror.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <?php if (isset($welcome)): ?>
        <link href="assets/css/welcome_page.css" rel="stylesheet">
    <?php endif; ?>
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/components/bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- ################################################################## -->
<!-- ################################################################## -->
<!-- ##########            THIS SITE WAS DONE BY:           ########### -->
<!-- ########## RENEE SÄKS, http://www.escaper.ee/renee/cv  ########### -->
<!-- ########## CARMEN HAAV, carmen.haav@khk.ee             ########### -->
<!-- ########## Raul Kallasmaa, raul.kallasmaa@khk.ee       ########### -->
<!-- ################################################################## -->
<!-- ################################################################## -->

<!-- #####################################################################
___________              __           ____  __.___ ___  ____  __.
\__    ___/____ ________/  |_ __ __  |    |/ _/   |   \|    |/ _|
  |    |  \__  \\_  __ \   __\  |  \ |      </    ~    \      <
  |    |   / __ \|  | \/|  | |  |  / |    |  \    Y    /    |  \
  |____|  (____  /__|   |__| |____/  |____|__ \___|_  /|____|__ \
               \/                            \/     \/         \/
###################################################################### -->

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a href="http://khk.ee/" target="_blank"><img id="khk-logo" src="images/khk_logo.png" alt="logo"/></a>
        </div>
        <div class="navbar-form navbar-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <h4><?= $_SESSION['name'] . ', ' . $_SESSION['social_id'] ?></h4>
            <?php endif; ?>
        </div>
    </div>
</nav>


<div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <?php if (!file_exists("views/$controller/{$controller}_$action.php")) error_out('The view <i>views/' . $controller . '/' . $controller . '_' . $action . '.php</i> does not exist. Create that file.'); ?>
    <?php @require "views/$controller/{$controller}_$action.php"; ?>
</div>

<script src="assets/js/main.js"></script>

<footer>
    <div class="col-md-4 footer-block">
        <span>Tartu Kutsehariduskeskus</span><br/>
        <span><a href="https://goo.gl/wGteKA" target="_blank">Kopli 1, 50115 Tartu</a></span><br/>
    </div>
    <div class="col-md-4 footer-block">
        <span>E-post: <a href="mailto:info@khk.ee">info@khk.ee</a> </span><br/>
        <span>Telefon: <a href="tel:+3727361866">7 361 866</a></span><br/>
    </div>
    <div class="col-md-4 footer-block">
        <a href="http://www.facebook.com/kutseharidus" target="_blank">
            <img id="fb-logo" src="images/fb_logo.png" alt="fb-logo">
        </a>
    </div>
</footer>
</body>
</html>