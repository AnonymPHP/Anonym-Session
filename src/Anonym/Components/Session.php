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
    class Session extends SessionFactory implements SessionInterface
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

        /**
         * Girilen şifrelenmiş metnin şifresini çözer
         *
         * @param $value $string
         * @return string
         */
        private function decode($value = '')
        {
            return $this->getCrypter()->decode($value);
        }

        /**
         * Özel adı oluşturur
         *
         * @param string $name
         * @return mixed
         */
        private function createName($name = ''){
            $name = $this->getPrefix().$name;
            return $this->getCrypter()->encode($name);
        }

        /**
         * $name adında bir değer olup olmadığına bakar
         *
         * @param string $name
         * @return bool
         */
        public function has($name)
        {
            if ($this->isValid()) {
                $name = $this->createName($name);
                return isset($_SESSION[$name]);
            }else{
                return false;
            }
        }

        /**
         * $name ile girilen oturum varmı yokmu kontrolunu yapar
         *
         * @param string $name
         * @return mixed
         */
        public function get($name)
        {
            if($this->isValid())
            {
                $name = $this->createName($name);
                if(isset($_SESSION[$name])){
                    return $_SESSION[$name];
                }else{
                    return false;
                }
            }
        }

        /**
         * Session a isim ve değeri atar
         *
         * @param string $name
         * @param string $value
         * @return $this|bool
         */
        public function set($name = '', $value = '')
        {

            if ($this->isValid()) {
                $name = $this->createName($name);
                $value = $this->getCrypter()->encode($value);
                $_SESSION[$name] = $value;
                return $this;
            }else{
                return false;
            }

        }

        /**
         * Girilen oturum verisini siler
         *
         * @param string $name
         * @return $this|bool
         */
        public function delete($name){

            if ($this->isValid()) {
                $name = $this->createName($name);
                unset($_SESSION[$name]);

                return $this;
            }else{
                return false;
            }

        }


        /**
         *  Tüm oturum verilerini temizler
         */
        public function flush(){

            if ($this->isValid()) {

                foreach($_SESSION as $key => $value){
                    $value = null;
                    $_SESSION[$key] = $value;
                }
            }

        }

        /**
         *  Ön tanımlı değerleri ayarlar
         */
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
         * @return CrypterDecodeableInterface
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
