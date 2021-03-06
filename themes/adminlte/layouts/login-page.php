<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LandingAsset;
use app\assets\ServiceWorkerAsset;

LandingAsset::register($this);
ServiceWorkerAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Manifest Progressive Web App -->
        <link rel="manifest" href="manifest.json">

        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= Yii::$app->name ?> | <?= Yii::$app->controller->id ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="bundles/landing-page/assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="/js/font-awesome/all.js" crossorigin="anonymous"></script>

        <?php echo $this->head() ?>
    </head>
    <body id="page-top">
        <?php echo $this->beginBody(); ?>
        <!-- Navigation-->
        <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"><a class="js-scroll-trigger" href="#page-top"><?= Yii::$app->name ?></a></li>
                <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?= Url::to(['/site/index']) ?>">Home</a></li>
                <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?= Url::to(['/site/index']) ?>#about">About</a></li>
                <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?= Url::to(['/site/index']) ?>#services">Services</a></li>
                <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?= Url::to(['/site/index']) ?>#portfolio">Portfolio</a></li>
                <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?= Url::to(['/site/index']) ?>#contact">Contact</a></li>
            </ul>
        </nav>


        <?php echo $content ?>


        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <ul class="list-inline mb-5">
                    <li class="list-inline-item">
                        <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="icon-social-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="icon-social-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a class="social-link rounded-circle text-white" href="#!"><i class="icon-social-github"></i></a>
                    </li>
                </ul>
                <div class="small text-center text-muted">
                    Copyright &copy;
                    <!-- This script automatically adds the current year to your website footer-->
                    <!-- (credit: https://updateyourfooter.com/)-->
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    - <?= Yii::$app->params['company'] ?>
                </div>
            </div>
        </footer>

        <?php echo $this->endBody(); ?>

    </body>
</html>

<?php $this->endPage() ?>
