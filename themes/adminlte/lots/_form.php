<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Json;

use yii\bootstrap4\ActiveForm;
use app\assets\TagsInputAsset;
use app\assets\GeoLocationAsset;
use app\models\Products;


use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Lots */
/* @var $form yii\widgets\ActiveForm */

TagsInputAsset::register($this);
GeoLocationAsset::register($this);

$products = ArrayHelper::map(Products::find()->all(), 'id', 'title');
$products[null] = '';
asort($products);

?>

<div class="lots-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?php echo $form->errorSummary($model) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">

            <?= $form->field($model, 'lot_number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'quantity')->textInput() ?>

            <?php
                $globallanguage = Yii::$app->language;
                $language = explode('-',$globallanguage);
            ?>

            <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
                'language' => $language[0],
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'row')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'coordinates')->textInput()->label(false) ?>


        </div>

        <div class="col-sm-4">

            <div class="mb-3">
                <div class="text-muted"><?= Yii::t('app','Select product') ?></div>
                <?= $form->field($model, 'product_id')->dropDownList($products) ?>
            </div>
            <div class="mb-3">
                <?= $form->field($model, 'tags', [
                    'inputOptions' => ['data-role' => 'tagsinput']
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="mb-3" id="gmap-container">
                <?php
                $lat = 41;
                $lng = 8.5;

                if (!empty($model->coordinates)){
                    $coords = Json::decode($model->coordinates);
                    $lat = $coords[0]['lat'];
                    $lng = $coords[0]['lng'];
                }
                echo $this->render('_gmaps', [
                    'lat' => $lat,
                    'lng' => $lng,
                    'model' => $model,
                ]);
                ?>
            </div>
            <div class="mb-3" id="weather-container">
            </div>
            <button class="mt-3 btn btn-sm btn-outline-primary" id="askGeoLocation">
                <?= Yii::t('app','Get location') ?>
            </button>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
