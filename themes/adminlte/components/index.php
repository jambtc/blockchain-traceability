<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ComponentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Components');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary px-3">
            <div class="card-header border-transparent ">
                <h3 class="card-title "><?= $this->title ?></h3>
                <?= Html::a('<button type="button" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i> '. Yii::t('app', 'Add Component').'
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

                            // 'id',
                            [
                                'attribute' => 'title',
                                'content' => function($model) {
                                    return $this->render('_picture_item',['model'=>$model]);
                                }

                            ],
                            [
                                'attribute' => 'status',
                                'content' => function($model){
                                    return $model->getStatusLabels()[$model->status];
                                }
                            ],
                            // 'title',
                            // 'description:ntext',
                            // 'file_name',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'buttons' => [
                                    'delete' => function ($url) {
                                        return Html::a(Yii::t('app','Delete'), $url,
                                            [
                                                'data-method' => 'post',
                                                'data-confirm' => Yii::t('app','Are you sure you want to delete this component?'),
                                            ]
                                        );
                                    }
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
