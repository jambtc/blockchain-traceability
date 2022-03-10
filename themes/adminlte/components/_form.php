<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Components */
/* @var $form yii\bootstrap4\ActiveForm */


app\assets\TagsInputAsset::register($this);

?>

<div class="components-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-8">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags', [
                'inputOptions' => ['data-role' => 'tagsinput']
            ])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="text-muted">Picture</div>
                <div class="embed-responsive mb-3">
                    <img src="<?= $model->getPictureLink() ?>" class="img-fluid" alt="<?= $model->file_name ?>">
                </div>
            </div>



            <div class="mb-3">
                <div class="text-muted"><?= Yii::t('app','Status') ?></div>
                <?= $form->field($model, 'status')->dropDownList(
                        $model->getStatusLabels()
                    )->label(false) ?>

            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
