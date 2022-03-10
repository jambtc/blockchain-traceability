<?php
$path = null;
if (isset($model->component1_id)){
    $path = $model->getComponentLink($model->component1->picture_id);
}
if (isset($model->picture)){
    $path = $model->picture;
}
?>

<img id="component_1" src="<?php echo $path ?>" class="img-fluid" alt="">
