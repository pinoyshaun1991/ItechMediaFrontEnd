<?php

use iTech\Controller\RecipeController;

require_once __DIR__ . '/../../vendor/autoload.php';

$recipes = new RecipeController();

try {
    $recipes->getRecipes();
} catch (Exception $e) {
    print($e->getMessage());
}
