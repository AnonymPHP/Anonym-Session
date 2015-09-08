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
 * Interface StrogeInterface
 * @package Anonym\Components\Session
 */
interface StrogeInterface
{

    /**
     * return a registered session, return false on session not found
     *
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * register a new session with handler
     *
     * @param string $name the name of session
     * @param mixed $value the value of session, the value can be string, object, integer ...
     * @param int $time    if your driver support this, you can use it
     * @return $this
     */
    public function set($name = '', $value, $time = 0);

    /**
     * remove a session
     *
     * @param string $name
     * @return $this
     */
    public function delete($name);

    /**
     * clear the all sessions
     *
     * @return $this
     */
    public function flush();
}
