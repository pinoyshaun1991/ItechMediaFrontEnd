<?php
namespace iTech\Common\Model;

/**
 * Declaring the methods needed to display the recipe
 *
 * Interface ModelInterface
 * @package Common\Controller
 */
interface ModelInterface
{
    /**
     * Prepares the data endpoints
     *
     * @return mixed
     */
    public function fetchData();

    /**
     * Returns the dataset
     *
     * @return mixed
     */
    public function getData();
}