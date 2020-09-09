<?php

namespace iTech\Controller;

use iTech\Common\Controller\RecipeInterface;
use Exception;
use iTech\Model\RecipeModel;
use iTech\Controller\PageController;

/**
 * Implements the recipe interface
 *
 * Class RecipeController
 * @package iTech\Controller
 */
class RecipeController implements RecipeInterface
{
    /**
     * @var RecipeModel
     */
    private $recipeModel;

    /**
     * @var \iTech\Controller\PageController
     */
    private $pageController;

    /**
     * RecipeController constructor.
     */
    public function __construct()
    {
        $this->recipeModel    = new RecipeModel();
        $this->pageController = new PageController();
    }

    /**
     * Fetches Recipes
     *
     * @return array|mixed
     * @throws Exception
     */
    public function getRecipes()
    {
        $recipes = array();

        try {
            $recipes = $this->recipeModel->getData();
        } catch (Exception $e) {
            print $e->getMessage();
        }

        $this->pageController->set('index', $recipes);
    }
}