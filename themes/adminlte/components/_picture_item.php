<?php
/**
* @var $model \app\models\Components
*
*/
use \yii\helpers\StringHelper;
use \yii\helpers\Url;
?>
<a href="<?php echo Url::to(['components/update', 'id'=>$model->picture_id]) ?>">
    <div class="media">
        <div class="embed-responsive mr-3" style="width: 120px;">
            <img src="<?= $model->getPictureLink() ?>" class="img-fluid" alt="<?= $model->file_name ?>">
        </div>
      <div class="media-body">
        <h5 class="mt-0"><?= $model->title ?></h5>
        <?php echo StringHelper::truncateWords($model->description, 10) ?>
      </div>
    </div>
</a>
