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
     * Interface SessionInterface
     * @package Anonym\Components\Session
     */
    interface SessionInterface
    {

        /**
         * $name ile girilen oturum varmı yokmu kontrolunu yapar
         *
         * @param string $name
         * @return mixed
         */
        public function get($name);

        /**
         * Session a isim ve değeri atar
         *
         * @param string $name
         * @param string $value
         * @return $this|bool
         */
        public function set($name = '', $value = '');


        /**
         * Girilen oturum verisini siler
         *
         * @param string $name
         * @return $this|bool
         */
        public function delete($name);

        /**
         *  Tüm oturum verilerini temizler
         */
        public function flush();
    }
