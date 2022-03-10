<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Products;
use app\models\LotsHash;
use app\components\Settings;

/* @var $this yii\web\View */
/* @var $model app\models\Lots */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);



$lotsHash = LotsHash::findOne(['lot_id' => $model->id]);
if (null === $lotsHash){
    $btnTx = '';
    $btnPrint = 'disabled';
    $btnUpdate = '';
    $printId = null;
} else {
    $btnTx = 'none;';
    $btnPrint = '';
    $btnUpdate = 'none;';
    $printId = $lotsHash->id;
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2><?= Html::encode($this->title) ?></h2>
                <span class="ml-2 float-right" style="display: <?= $btnUpdate ?>">
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], [
                        'class' => 'btn btn-success ',

                    ]) ?>
                </span>
                <span class="float-right" disabled="<?= $btnPrint ?>">
                    <?= Html::a(Yii::t('app', 'Print QR-Code'), ['print', 'id' => $printId], [
                        'class' => 'btn btn-secondary '. $btnPrint ,
                        'target' => '_blank'

                    ]) ?>
                </span>
                <span class="mr-2 float-right" style="display: <?= $btnTx ?>">
                    <?= Html::a(Yii::t('app', 'Generate Tx'), ['generate-transaction', 'id' => $model->id], [
                        'class' => 'btn btn-warning',
                        'data' => [
                            'confirm' => Yii::t('app', 'You are about to save the lot hash on the blockchain. Are you sure you want to continue?'),
                            // 'method' => 'post',
                        ],
                    ]) ?>
                </span>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        // 'title',
                        [
                            'attribute' => 'product_id',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $product = Products::findOne($data->product_id);
                                return $product->title;
                            },
                        ],
                        'description:ntext',
                        'tags',
                        // 'product_id',

                        'row',
                        'coordinates',
                        'weather',
                        'lot_number',
                        'quantity',
                        'date',
                        [
                            'attribute' => 'hash',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $lotsHash = LotsHash::findOne(['lot_id' => $data->id]);
                                return isset($lotsHash) ? $lotsHash->hash : null;

                            },
                        ],
                        [
                            'attribute' => 'txhash',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $lotsHash = LotsHash::findOne(['lot_id' => $data->id]);
                                $blockchain = Settings::poa(1);
                                return isset($lotsHash) ? Html::a($lotsHash->txhash, $blockchain->url_block_explorer.'/tx/'.$lotsHash->txhash,
                                    [
                                        'class' => 'btn btn-success btn-sm center-block text-break ',
                                        'target' => '_blank'
                                    ]
                                ) : null;
                            },
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
