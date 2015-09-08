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
class Stroge implements StrogeInterface
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


    /**
     * return a registered session, return false on session not found
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {

    }

    /**
     * register a new session with handler
     *
     * @param string $name the name of session
     * @param mixed $value the value of session, the value can be string, object, integer ...
     * @param int $time if your driver support this, you can use it
     * @return $this
     */
    public function set($name = '', $value, $time = 0)
    {

    }

    /**
     * remove a session
     *
     * @param string $name
     * @return $this
     */
    public function delete($name)
    {

    }

    /**
     * clear the all sessions
     *
     * @return $this
     */
    public function flush()
    {

    }
}
