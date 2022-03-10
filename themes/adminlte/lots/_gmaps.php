<?php
use yii\helpers\Url;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

$coord = new LatLng(
    [
        'lat' => $lat,
        'lng' => $lng,
    ]
);
$map = new Map([
    'center' => $coord,
    'zoom' => 15,
    'width' => 319,
    'height' => 319,
]);
// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => $model->title,
]);

?>
<div id="d-flex w-100">
    <?php
    // Display the map -finally :)
    echo $map->display();
    ?>
</div>
