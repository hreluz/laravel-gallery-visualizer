<?php

$kb_unit = 1024;
$size_unit = env('IMAGE_SIZE_UNIT', 5);

return [
    'kb_unit'   => $kb_unit,
    'size_unit' => $size_unit,
    'image_size_max_kb' => $kb_unit * $size_unit,
];
