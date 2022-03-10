<?php
/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;
use app\models\Components;
use app\assets\ChangeComponentPictureAsset;
use app\assets\TagsInputAsset;

$options = [
    'spinner' => '<div class="button-spinner spinner-border text-primary" style="width:1.3rem; height:1.3rem;" role="status"><span class="sr-only">Loading...</span></div>',
    'getImage' => Url::to(['/products/add-image']),
];

$this->registerJs(
    "var yiiOptions = ".Json::htmlEncode($options).";",
    View::POS_HEAD,
    'yiiOptions'
);

ChangeComponentPictureAsset::register($this);
TagsInputAsset::register($this);

$components = ArrayHelper::map(Components::find()->all(), 'id', 'title');
$components[null] = '';
asort($components);

?>

<div class="products-form">

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

    <div class="card card-secondary">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <?= $form->field($model, 'component1_id')->dropDownList($components) ?>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <div class="text-muted">Picture</div>
                        <div class="embed-responsive mb-3">
                            <?= $this->render('_component1', [
                                'model' => $model
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <?= $form->field($model, 'component2_id')->dropDownList($components) ?>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <div class="text-muted">Picture</div>
                        <div class="embed-responsive mb-3">
                            <?= $this->render('_component2', [
                                'model' => $model
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <?= $form->field($model, 'component3_id')->dropDownList($components) ?>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <div class="text-muted">Picture</div>
                        <div class="embed-responsive mb-3">
                            <?= $this->render('_component3', [
                                'model' => $model
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
