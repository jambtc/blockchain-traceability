<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LotsHash */

$this->title = Yii::t('app', 'Create Lots Hash');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lots Hashes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lots-hash-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
