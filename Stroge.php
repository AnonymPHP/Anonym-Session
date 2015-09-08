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

use SessionHandlerInterface;

/**
 * Class Stroge
 * @package Anonym\Components\Session
 */
class Stroge
{

    /**
     * the instance of handler
     *
     * @var SessionHandlerInterface
     */
    private $handler;

    /**
     * all configs of the handlers
     *
     * @var array
     */
    private $configs;

    /**
     * create a new instance and save handler settings
     *
     * @param array $configs all settings of the handler
     * @param SessionHandlerInterface|null $handlerInterface the instance of  the handler
     */
    public function __construct(array $configs = [], SessionHandlerInterface $handlerInterface = null)
    {
        $this->setConfigs($configs);
        $this->setHandler($handlerInterface);
    }

    /**
     * @return SessionHandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param SessionHandlerInterface $handler
     * @return Stroge
     */
    public function setHandler(SessionHandlerInterface $handler = null)
    {
        $this->handler = $handler;

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
     * @return Stroge
     */
    public function setConfigs($configs)
    {
        $this->configs = $configs;

        return $this;
    }
}
