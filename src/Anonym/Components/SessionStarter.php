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
     * Class SessionStarter
     * @package Anonym\Components\Session
     */
    class SessionStarter implements SessionStarterInterface
    {

        /**
         * Session oturumunu başlatır
         *
         * @return null
         */
        public function start(){
            $session_name = session_name();
            if (session_start()) {
                setcookie($session_name, session_id(), null, '/', null, null, true);
            }
            return null;
        }
    }
