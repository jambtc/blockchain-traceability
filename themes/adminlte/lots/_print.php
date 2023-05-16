<?php
use yii\helpers\Url;
use yii\helpers\Html;
use Da\QrCode\QrCode;
use yii\widgets\DetailView;
use app\models\Products;
use app\models\LotsHash;
use app\components\Settings;


// nel qr-code c'è l'id del lot-hash non del singolo lotto

$qrCodeMessage = Url::to(['showcase/index','id'=>$model->id],true);
$qrCode = (new QrCode($qrCodeMessage))
    ->setSize(300)
    ->setMargin(25)
    ->useForegroundColor(51, 153, 255);
    //->useForegroundColor(11, 11, 11);
?>
<div class="text-center">
  <?php echo '<img class="rounded mx-auto d-block" src="' . $qrCode->writeDataUri() . '">'; ?>
</div>

<p class="text-center"><?= $qrCodeMessage ?></p>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2><?= Html::encode($model->lot->title) ?></h2>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model->lot,
                    'attributes' => [
                        // 'id',
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
                        // 'weather',
                        [
                            'attribute' => 'weather',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $text = str_replace(',',', ',$data->weather);
                                return $text;
                            },
                        ],
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
