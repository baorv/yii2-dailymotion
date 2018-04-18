<?php

namespace baorv\dailymotion\components;

use Yii;
use yii\base\Component;
use baorv\dailymotion\Dailymotion as DailymotionApi;
use yii\base\InvalidConfigException;

/**
 * Class Dailymotion is just a component integrating from Dailymotion
 *
 * @package baorv\dailymotion\components
 * @version 0.0.1
 */
class Dailymotion extends Component
{

    /**
     * App api key gets from dailymotion developer page
     *
     * @var string $apiKey
     */
    public $apiKey;

    /**
     * App secret key gets from dailymotion developer page
     *
     * @var string $apiSecret
     */
    public $apiSecret;

    /**
     * Scope of application, permissions app want to retrieve
     *
     * @var array $scope
     */
    public $scope = [];

    /**
     * Dailymotion API
     *
     * @var DailymotionApi $api
     */
    protected $api;

    /**
     * Initialize component
     */
    public function init()
    {
        parent::init();
        if (is_null($this->apiKey) || is_null($this->apiSecret) || !is_array($this->scope)) {
            throw new InvalidConfigException(Yii::t('app', 'You need provide $apiKey and $apiSecret'));
        }
        $this->api = new DailymotionApi();
    }

    /**
     * Get api object
     *
     * @return DailymotionApi
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Replace old api object with new
     *
     * @param DailymotionApi $dailymotionApi
     * @return DailymotionApi
     */
    public function setApi(DailymotionApi $dailymotionApi)
    {
        $this->api = $dailymotionApi;
        return $this->api;
    }

    /**
     * Setup dailymotion with given information
     *
     * @param string $type
     * @param array $info
     *
     * @return DailymotionApi
     */
    public function setup($type, array $info = [])
    {
        return $this->api->setGrantType($type, $this->apiKey, $this->apiSecret, $this->scope, $info);
    }

    /**
     * Request to dailymotion with GET method
     *
     * @param string $path
     * @param array $params
     *
     * @return mixed
     */
    public function get($path, $params = [])
    {
        return $this->api->get($path, $params);
    }

    /**
     * Request to dailymotion with POST method
     *
     * @param string $path
     * @param array $params
     *
     * @return mixed
     */
    public function post($path, $params = [])
    {
        return $this->api->post($path, $params);
    }

    /**
     * Request to dailymotion with DELETE method
     *
     * @param string $path
     * @param array $params
     *
     * @return mixed
     */
    public function delete($path, $params = [])
    {
        return $this->api->delete($path, $params);
    }

    /**
     * Call a remote endpoint on the API.
     *
     * @param string $path
     * @param array $params
     *
     * @return mixed
     */
    public function call($path, $params = [])
    {
        return $this->api->call($path, $params);
    }

    /**
     * Upload a file on Dailymotion's servers and generate an URL to be used with API methods.
     *
     * @param $filePath
     * @param null|string $forceHostname
     * @param null|string $progressUrl
     * @param null|string $callbackUrl
     * @return string
     */
    public function uploadFile($filePath, $forceHostname = null, &$progressUrl = null, $callbackUrl = null)
    {
        return $this->api->uploadFile($filePath, $forceHostname, $progressUrl, $callbackUrl);
    }

    /**
     * Remove the right for the current API key to access the current user account.
     *
     * @return DailymotionApi
     */
    public function logout()
    {
        return $this->api->logout();
    }

    /**
     * Get the session if any.
     *
     * @return array
     */
    public function getSession()
    {
        return $this->api->getSession();
    }

    /**
     * Set the session and store it if `$this->storeSession` is true.
     *
     * @param $session array the session to set
     * @return DailymotionApi
     */
    public function setSession(array $session = [])
    {
        return $this->api->setSession($session);
    }

    /**
     * Clear the currently stored session.
     *
     * @return DailymotionApi
     */
    public function clearSession()
    {
        return $this->api->clearSession();
    }
}