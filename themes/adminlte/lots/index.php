<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lots');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
                <?= Html::a('<button type="button" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> '. Yii::t('app', 'Add Lot').'
                </button>', ['create']) ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{summary}\n{items}\n{pager}",
                        'tableOptions' => ['class' => 'table m-0 table-striped'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'lot_number',
                            'title',
                            'product.title',
                            // //'description:ntext',
                            // //'tags',
                            //'lot.product_id',
                            // 'lots.row',
                            // //'coordinates',
                            // //'weather',
                            //
                            'quantity',
                            'date:date',

                            [
                                'class' => 'yii\grid\ActionColumn',

                                'template'=>'{view}',
                                'buttons'=>[

                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
