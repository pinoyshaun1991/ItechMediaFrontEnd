<?php

if (!empty($_POST)) {
    $servings        = $_POST['formData'][0]['value'];
    $currentServings = $_POST['formData'][1]['value'];

    echo round($servings/$currentServings);
    return;
}