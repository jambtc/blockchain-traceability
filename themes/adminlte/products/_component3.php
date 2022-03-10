<?php
$path = null;
if (isset($model->component3_id)){
    $path = $model->getComponentLink($model->component3->picture_id);
}
if (isset($model->picture)){
    $path = $model->picture;
}
?>

<img id="component_3" src="<?php echo $path ?>" class="img-fluid" alt="">
