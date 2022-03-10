<?php
$path = null;
if (isset($model->component2_id)){
    $path = $model->getComponentLink($model->component2->picture_id);
}
if (isset($model->picture)){
    $path = $model->picture;
}
?>

<img id="component_2" src="<?php echo $path ?>" class="img-fluid" alt="">
