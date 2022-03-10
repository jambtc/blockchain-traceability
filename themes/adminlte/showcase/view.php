<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

// use app\components\WebApp;
// use app\components\Rows;
use app\components\Settings;

// use app\assets\TagsInputAsset;
use app\assets\ValidateHashAsset;

// use yii\widgets\Pjax;

$options = [
    'spinner' => '<div class="button-spinner spinner-border text-primary" style="width:1.3rem; height:1.3rem;" role="status"><span class="sr-only">Loading...</span></div>',
    'validate' => Url::to(['/showcase/validate', 'id' => $model->id]),
];

$this->registerJs(
    "var yiiShowcaseOptions = ".Json::htmlEncode($options).";",
    yii\web\View::POS_HEAD,
    'yiiOptions'
);

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */

// $id = WebApp::encrypt($model->id);

// $this->title = $id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
ValidateHashAsset::register($this);

$blockchain = Settings::poa(1);

$lot = $model->lot;
$product = $model->lot->product;

?>
<!-- Masthead-->
<section class="content-section text-dark w-100 pb-0" id="home">
    <div class="container  my-auto">
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <div class="embed-responsive mb-3">
                        <img src="<?= $product->getPictureLink() ?>" class="img-fluid" alt="<?= $product->file_name ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <h3 class="mb-1"><?= $product->title ?></h3>
                <div class="mb-3"><?= $lot->description ?></div>
                <div class="mb-3">
                    <b><?= Yii::t('app','Tags') ?>: </b><span><?= $lot->tags?></span>
                </div>
                <div class="mb-3">
                    <b><?= Yii::t('app','Row') ?>: </b><span><?= $lot->row?></span>
                </div>
                <div class="mb-3">
                    <b><?= Yii::t('app','Lot number') ?>: </b><span><?= $lot->lot_number?></span>
                </div>
                <div class="mb-3">
                    <b><?= Yii::t('app','Quantity') ?>: </b><span><?= $lot->quantity?></span>
                </div>
                <div class="mb-3">
                    <b><?= Yii::t('app','Date') ?>: </b><span><?= $lot->date?></span>
                </div>

                <input id="lot-id" type="hidden" value="<?= $model->id ?>">
                <p>
                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <?= Yii::t('app','View components') ?>
                  </button>
                </p>

            </div>

        </div>
        <div class="row">
            <div class="m-2 collapse" id="collapseExample">
              <div class="card card-body">
                  <div class="row">
                  <div class="col-sm-4">
                      <div class="mb-3">
                          <div class="text-muted">Component 1</div>
                          <div class="embed-responsive mb-3">
                              <?= $this->render('_component1', [
                                  'model' => $product
                              ]) ?>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="mb-3">
                          <div class="text-muted">Component 2</div>
                          <div class="embed-responsive mb-3">
                              <?= $this->render('_component2', [
                                  'model' => $product
                              ]) ?>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="mb-3">
                          <div class="text-muted">Component 3</div>
                          <div class="embed-responsive mb-3">
                              <?= $this->render('_component3', [
                                  'model' => $product
                              ]) ?>
                          </div>
                      </div>
                  </div>
              </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-3">
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#blockchain">Find out Blockchain data</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="mb-3" id="gmap-container">
                    <?php
                    $lat = 41;
                    $lng = 8.5;
                    if (!empty($lot->coordinates)){
                        $coords = Json::decode($lot->coordinates);
                        $lat = $coords[0]['lat'];
                        $lng = $coords[0]['lng'];
                    }
                    echo $this->render('_gmaps', [
                        'lat' => $lat,
                        'lng' => $lng,
                        'model' => $lot,
                    ]);
                    ?>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- Services-->
<section class="callout content-section text-center w-100" id="blockchain">
    <div class="container mb-3 card">
        <div class="card-header content-section-heading">
            <h3 class="text-secondary mb-0">Services</h3>
            <h2 class="mb-5">Blockchain</h2>
        </div>
        <div class="row card-body">
            <div class="bg-info border col-lg-6 col-md-12 mb-5 mb-lg-1 py-2">
                <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-lock"></i></span>
                <h4><strong>This is the Hash of the Lot content</strong></h4>
                <small class="text-faded mb-0 text-break">0x<?= $model->hash ?></small>
            </div>
            <div class="bg-info border col-lg-6 col-md-12 mb-5 mb-lg-1 py-2">
                <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-link"></i></span>
                <h4><strong>This is the Transaction hash on the blockchain</strong></h4>
                <small class="text-faded mb-0">
                    <?= Html::a($model->txhash, $blockchain->url_block_explorer.'/tx/'.$model->txhash,
                        [
                            'class' => 'btn btn-success btn-sm center-block text-break ',
                            'target' => '_blank'
                        ]
                    ); ?>
                </small>
            </div>
        </div>
        <div class="card-footer">
            <a class="mt-3 btn btn-info btn-xl js-scroll-trigger" href="#verify">Verify data</a>
        </div>

    </div>
</section>

<!-- Services-->
<section class="content-section bg-info text-dark text-center w-100" id="verify">
    <div class="container mb-3">
        <div class="content-section-heading ">
            <h3 class="text-secondary mb-0">Blockchain</h3>
            <h2 class="mb-5">Verify data</h2>
        </div>

        <div class="card verify">
            <div class="card-body">
                <div class="row">
                    <div class="text-white col-lg-6 col-md-12 mb-5 mb-lg-0">
                        <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-target"></i></span>
                        <h4><strong>Connect to blockchain</strong></h4>
                        <button id="validate-hash" class="btn btn-light">
                            <i class="fas fa-thumbs-up"></i> <span id="btn-validate-text"><?= Yii::t('app','Validate hash') ?></span>
                        </button>
                        <div class="validate-error text-danger" style="display: none;"></div>
                    </div>
                    <div class="text-white col-lg-6 col-md-12" id="validate-container">
                        <?= $this->render('_validate',['validate'=>0]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
