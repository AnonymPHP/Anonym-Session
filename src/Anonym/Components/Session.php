<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Session;

    use Anonym\Components\Crypt\AnonymCrypt;
    use Anonym\Components\Crypt\CrypterDecodeableInterface;

    /**
     * Class Session
     * @package Anonym\Components\Session
     */
    class Session
    {

        /**
         * Session ön ekini tutar
         *
         * @var string
         */
        private $prefix;

        /**
         * Şfreleyici tutar
         *
         * @var CrypterDecodeableInterface
         */
        private $crypter;

        public function __construct(){
            $this->setDefaultValues();
        }

        private function setDefaultValues(){
            $this->setPrefix('AnonymFrameworkSessionComponent');
            $this->setCrypter( new AnonymCrypt());
        }

        /**
         * @return string
         */
        public function getPrefix()
        {
            return $this->prefix;
        }

        /**
         * @param string $prefix
         * @return Session
         */
        public function setPrefix($prefix)
        {
            $this->prefix = $prefix;

            return $this;
        }

        /**
         * @return Crypter
         */
        public function getCrypter()
        {
            return $this->crypter;
        }

        /**
         * @param CrypterDecodeableInterface $crypter
         * @return Session
         */
        public function setCrypter(CrypterDecodeableInterface $crypter)
        {
            $this->crypter = $crypter;

            return $this;
        }



    }