<?php
namespace iTech\Model;

use Exception;
use iTech\Common\Model\ModelInterface;
use iTech\Service\ContentRecipeService;

/**
 * Class RecipeModel
 * @package iTech\Model
 */
class RecipeModel implements ModelInterface
{
    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var string
     */
    private $site;

    /**
     * @var ContentRecipeService
     */
    private $contentRecipeService;

    /**
     * @var array
     */
    private $dataSet;

    /**
     * RecipeModel constructor.
     */
    public function __construct()
    {
        $this->from                 = '';
        $this->to                   = '';
        $this->site                 = '';
        $this->contentRecipeService = new ContentRecipeService();
        $this->dataSet              = array();
    }

    /**
     * Set the from variable type
     *
     * @param $from
     * @return string
     * @throws Exception
     */
    public function setFrom($from): string
    {
        if (is_numeric($from) === false) {
            throw new Exception('From field needs to be a numeric value');
        }

        return $this->from = $from;
    }

    /**
     * Retrieve from value
     *
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * Set the to variable type
     *
     * @param $to
     * @return string
     * @throws Exception
     */
    public function setTo($to): string
    {
        if (is_numeric($to) === false) {
            throw new Exception('To field needs to be a numeric value');
        }

        return $this->to = $to;
    }

    /**
     * Retrieve to value
     *
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * Gets Recipes
     *
     * @return string
     * @throws Exception
     */
    public function getData(): string
    {
        $recipes = $this->fetchData();

        return json_encode($recipes, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }

    /**
     * Fetch recipes
     *
     * @return array
     * @throws Exception
     */
    public function fetchData(): array
    {
        $this->site = 'http://18.130.116.85/recipes';

        if (isset($_GET['from']) && isset($_GET['to'])) {
            $this->site .= '?from=' . $_GET['from'] . '&to=' . $_GET['to'];
        }

        if (isset($_GET['from'])) {
            $this->setFrom($_GET['from']);
            $this->site .= '?from=' . $_GET['from'];
        }

        if (isset($_GET['to'])) {
            $this->setTo($_GET['to']);
            $this->site .= '?to=' . $_GET['to'];
        }

        $params = array(
            'from' => $this->getFrom(),
            'to'   => empty($this->getTo()) ? 1 : $this->getTo()
        );

        return $this->getAPIData($params);
    }

    /**
     * Gets recipe data
     *
     * @param $params
     * @return mixed|string|true
     */
    public function getAPIData($params)
    {
        return $this->contentRecipeService->getRawRecipeContent($this->site, $params, 'application/x-www-form-urlencoded');
    }
}