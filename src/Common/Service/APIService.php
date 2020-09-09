<?php

namespace iTech\Common\Service;

/**
 * A generic class to handle all API requests
 *
 * Class APIService
 * @package iTech\Common\Service
 */
abstract class APIService
{
    /**
     * APIService constructor.
     */
    public function __construct(){}

    /**
     * Requests contents from the API request then returns raw data
     *
     * @param $url
     * @param array $params
     * @param string $method
     * @param string $contentType
     * @return bool|string
     */
    public function getContents($url, $params = array(), $method = '', $contentType = 'application/json')
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        if ($method === 'post') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $contentType === 'text/plain' ? $params :
                ($contentType === 'application/x-www-form-urlencoded' ? http_build_query($params) : json_encode($params))
            );
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: '.$contentType,
                'Content-Length: '.$method === 'post' ? strlen(json_encode($params)) : 0,
                'Authorization: '.md5($url)
            )
        );

        return curl_exec($ch);
    }
}