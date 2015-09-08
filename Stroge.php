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
    public function __construct(array $configs = [], SessionHandlerInterface $handlerInterface = null){

    }

}