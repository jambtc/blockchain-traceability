<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Components */

$this->title = Yii::t('app', 'Create Component');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

app\assets\SubmitPictureFileAsset::register($this);

?>
<div class="components-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="d-flex flex-column justify-content-center align-items-center">

        <div class="row">
            <div class="col-sm-12">
                <?php echo $form->errorSummary($model) ?>
            </div>
        </div>

        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        </br>
        <p class="m-0">Drag and drop a file you want to upload</p>
        <p class="text-muted"> </p>


        <button class="btn btn-primary btn-file">
            Select file
            <input type="file" id="pictureFile" name="picture">
        </button>

    </div>
    <?php ActiveForm::end(); ?>

</div>
