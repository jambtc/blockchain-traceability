<?php
use yii\helpers\Url;
use app\components\Settings;

$owner = Settings::owner();
?>

<!-- Masthead-->
<header class="masthead d-flex">
    <div class="container alert alert-info text-center my-auto" style="opacity: 0.7;">
        <h1 class="mb-1"><?= Yii::t('app','Blockchain based traceability program') ?></h1>
        <h3 class="mb-5"><em><?= Yii::t('app','The blockchain is an efficient way to manage traceability.') ?></em></h3>
        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
    </div>
    <div class="overlay"></div>
</header>

<!-- About-->
<section class="content-section content-about bg-light w-100" id="about">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-10 mx-auto alert alert-info" style="opacity: 0.7;">
                <h2><?= Yii::t('app','Extraordinary vineyards, unique wines') ?></h2>
                <p class="lead mb-5">
                    <?= Yii::t('app','Our vineyards have their roots in the history of a territory where viticulture and the cultivation of cherries have been practiced for millennia. Caressed by the wind, between orchards and Mediterranean scrub, it is here, in the blinding beauty of these places,
                    that we cultivate our passion.'); ?>
                </p>
                <a class="btn btn-dark btn-xl js-scroll-trigger" href="<?= Url::to(['/site/login']) ?>"><?= Yii::t('app','Sign in') ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Services-->
<section class="content-section content-services text-white text-center w-100" id="services">
    <div class="container">
        <div class="content-section-heading">
            <h3 class="text-secondary mb-0">Services</h3>
            <h2 class="mb-5">What We Offer</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-screen-smartphone"></i></span>
                <h4><strong>Iot</strong></h4>
                <p class="text-faded mb-0"><?= Yii::t('app','Iot tracking of the agri-food chain')?> </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-pencil"></i></span>
                <h4><strong>Agrifood</strong></h4>
                <p class="text-faded mb-0"><?= Yii::t('app','Innovation food and agrifood made in Italy') ?></p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-like"></i></span>
                <h4><strong>Verify chain</strong></h4>
                <p class="text-faded mb-0">
                    Everywhere you
                    <i class="fas fa-heart"></i>
                    can control everything!
                </p>
            </div>
            <div class="col-lg-3 col-md-6">
                <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-mustache"></i></span>
                <h4><strong>Question</strong></h4>
                <p class="text-faded mb-0">I mustache you a question...</p>
            </div>
        </div>
    </div>
</section>
<!-- Callout-->
<section class="callout w-100">
    <div class="container text-center text-white">
        <h2 class="mx-auto mb-5">
            Welcome to
            <em>our</em>
            blockchain explorer!
        </h2>
        <a class="btn btn-info btn-xl" href="https://explorer.fid3lize.tk/">View Now!</a>
    </div>
</section>
<!-- Portfolio-->
<section class="content-section w-100" id="portfolio">
    <div class="container">
        <div class="content-section-heading text-center">
            <h3 class="text-secondary mb-0"><?= Yii::t('app','WINE CELLAR AND RESALE') ?></h3>
            <h2 class="mb-5"><?= Yii::t('app','SITES') ?></h2>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-6">
                <a class="portfolio-item" href="#!">
                    <div class="caption">
                        <div class="caption-content">
                            <div class="h2"><?= Yii::t('app','VINEYARDS') ?></div>
                            <p class="mb-0"><?= Yii::t('app','According to most of the experts the grape variety is from Greece.') ?></p>
                        </div>
                    </div>
                    <img class="img-fluid" src="bundles/landing-page/assets/img/IMG_8925.JPG" alt="..." />
                </a>
            </div>
            <div class="col-lg-6">
                <a class="portfolio-item" href="#!">
                    <div class="caption">
                        <div class="caption-content">
                            <div class="h2"><?= Yii::t('app','Land') ?></div>
                            <p class="mb-0"><?= Yii::t('app','Skilful hands that work the land with love and passion.') ?></p>
                        </div>
                    </div>
                    <img class="img-fluid" src="bundles/landing-page/assets/img/WA6P3099.JPG" alt="..." />
                </a>
            </div>
            <div class="col-lg-6">
                <a class="portfolio-item" href="#!">
                    <div class="caption">
                        <div class="caption-content">
                            <div class="h2"><?= Yii::t('app','Our values') ?></div>
                            <p class="mb-0"><?= Yii::t('app','Talking about wine means, above all, talking about the territory and the people who live and value that territory.') ?></p>
                        </div>
                    </div>
                    <img class="img-fluid" src="bundles/landing-page/assets/img/WA6P7788.JPG" alt="campo" />
                </a>
            </div>
            <div class="col-lg-6">
                <a class="portfolio-item" href="#!">
                    <div class="caption">
                        <div class="caption-content">
                            <div class="h2"><?= Yii::t('app','Grape harvest in the cloud') ?></div>
                            <p class="mb-0"><?= Yii::t('app','All data is in the cloud, available to all operators in real time and allows planning of phytosanitary interventions and even of the harvest.') ?></p>
                        </div>
                    </div>
                    <img class="img-fluid" src="bundles/landing-page/assets/img/vendemmia.JPG" alt="campo" />
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Call to Action-->
<!-- <section class="content-section bg-primary text-white w-100">
    <div class="container text-center">
        <h2 class="mb-4">The buttons below are impossible to resist...</h2>
        <a class="btn btn-xl btn-light mr-4" href="#!">Click Me!</a>
        <a class="btn btn-xl btn-dark" href="#!">Look at Me!</a>
    </div>
</section> -->
<!-- Map-->
<div class="map w-100" id="contact">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d114926.31526323155!2d14.27287540350973!3d40.80929295773975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sit!2sit!4v1646910078740!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
