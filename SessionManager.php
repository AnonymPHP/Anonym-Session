<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Session;

/**
 * Class SessionManager
 * @package Anonym\Components\Session
 */
class SessionManager
{

    /**
     * the list of session drivers
     *
     * @var array
     */
    protected $drivers = [
        'file' => FileSessionHandler::class,
        'database' => DatabaseSessionHandler::class,
        CookieSessionHandler::class,
    ];

    /**
     * the list of session callbacks
     *
     * @var array
     */
    protected $extends;
    /**
     * the list of driver creator
     *
     * @var array
     */
    protected $creators;

    /**
     * the all configs
     *
     * @var array
     */
    protected $configs;

    /**
     * create a new instance
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
    }

    /**
     * @param string $driver
     */
    public function driver($driver = '')
    {
        if (isset($this->drivers[$driver])) {

            $dClass = $this->drivers[$driver];
            $driver = $this->buildDriver($driver, $dClass);
        }

    }


    private function buildDriver($name, $class)
    {
        $instanceCallback = $this->createCallbackName($name);

        if (method_exists($this, $instanceCallback)) {
            return $this->$instanceCallback();
        } elseif (isset($this->extends[$name])) {
            $callback = $this->extends[$name];

        }
    }

    private function createCallbackName($name)
    {
        return "create".ucfirst($name)."Driver";
    }

    /**
     * @return array
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * @param array $drivers
     * @return SessionManager
     */
    public function setDrivers($drivers)
    {
        $this->drivers = $drivers;

        return $this;
    }

    /**
     * @return array
     */
    public function getCreators()
    {
        return $this->creators;
    }

    /**
     * @param array $creators
     * @return SessionManager
     */
    public function setCreators($creators)
    {
        $this->creators = $creators;

        return $this;
    }


    /**
     * @return array
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * @param array $configs
     * @return SessionManager
     */
    public function setConfigs($configs)
    {
        $this->configs = $configs;

        return $this;
    }
}
