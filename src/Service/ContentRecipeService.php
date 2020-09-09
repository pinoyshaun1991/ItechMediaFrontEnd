<?php
 namespace iTech\Service;

 use iTech\Common\Service\APIService;

 /**
  * Service returning specifically recipe content
  *
  * Class ContentRecipeService
  * @package iTech\Service
  */
class ContentRecipeService extends APIService
{
    /**
     * Get the contents of the API response
     *
     * @param $site
     * @param $params
     * @param $contentType
     * @return string|true
     */
    public function getRawRecipeContent($site, $params, $contentType)
    {
        $results = $this->getContents($site, $params, 'post', $contentType);
        $data    = '';

        if (!empty($results)) {
            $data = $results;
        }

        return json_decode($data, true);
    }
}