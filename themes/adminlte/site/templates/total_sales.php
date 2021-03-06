<?php
use app\models\Invoices;
use kartik\icons\Icon;
use yii\helpers\Url;

Icon::map($this);

$completed = Invoices::countComplete($dataProvider);

?>

<!-- small box -->
<div class="small-box bg-info">
    <div class="inner">
        <h3><?= $completed ?></h3>
        <p><?= Yii::t('app','Completed Orders') ?></p>
    </div>
    <div class="icon">
        <?= Icon::show('inbox') ?>
    </div>
    <a href="<?= Url::to(['invoices/index']) ?>" class="small-box-footer"><?= Yii::t('app','More info') ?> <i class="fas fa-arrow-circle-right"></i></a>
</div>
