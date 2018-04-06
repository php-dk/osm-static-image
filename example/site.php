<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

use pdk\osmStaticMap\ImageBuilder;
use pdk\osmStaticMap\Marker;
use phpdk\awt\Point;

include __DIR__ . '/../vendor/autoload.php';

$b = new ImageBuilder();

$b->setCenter(new Point(57.775473, 40.939452));
$b->addMarker(new Marker(new Point(57.775473, 40.939452), Marker::TYPE_LIGHT_BLUE, 8));

$b->setZoom(18);

?>

<img src="<?= (string)$b->build()->toString() ?>" alt="">
</body>
</html>
