<?php

namespace iTech\Controller;

use Exception;

/**
 * Sets up view pages
 *
 * Class PageController
 * @package iTech\Controller
 */
class PageController
{
    public function __construct() {}

    public function set($page, $params)
    {
        $_SESSION['params'] = json_decode($params);

        try {
            if (!empty($page)) {
                require_once(__DIR__ . '/../Views/' . $page . '.php');
            }
        } catch(Exception $e) {
            print($e->getMessage());
        }
    }

}