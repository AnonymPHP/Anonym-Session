<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Session;

    /**
     * Interface SessionStarterInterface
     * @package Anonym\Components\Session
     */
    interface SessionStarterInterface
    {

        /**
         * Session oturumunu başlatır
         *
         * @return null
         */
        public function start();

    }
