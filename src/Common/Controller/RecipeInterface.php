<?php
namespace iTech\Common\Controller;

/**
 * Declaring the methods needed to display recipes
 *
 * Interface RecipeInterface
 * @package Common\Controller
 */
interface RecipeInterface
{
    /**
     * Get Recipes
     *
     * @return mixed
     */
    public function getRecipes();
}