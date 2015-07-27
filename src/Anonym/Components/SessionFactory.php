<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Session;


    class SessionFactory
    {

        /**
         * Oturumun sona erip ermediğine bakar
         *
         * @param int $ttl
         * @return bool
         */
        public function isExpired($ttl = 30)
        {
            $activity = isset($_SESSION['_last_activity'])
                ? $_SESSION['_last_activity']
                : false;
            if ($activity !== false && time() - $activity > $ttl * 60) {
                return true;
            }
            $_SESSION['_last_activity'] = time();
            return false;
        }
        /**
         * Kullanıcı parmak izi bırakmışmı kontrol eder
         *
         * @return bool
         */
        public function isFingerprint()
        {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $useragent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $useragent = 'AnonymFrameworkAgent';
            }
            $hash = md5(
                $useragent .
                (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
            );
            if (isset($_SESSION['_fingerprint'])) {
                return $_SESSION['_fingerprint'] === $hash;
            }
            $_SESSION['_fingerprint'] = $hash;
            return true;
        }
        /**
         * Oturumun geçerli bir oturum olup olmadığına bakar
         *
         * @param int $ttl
         * @return bool
         */
        public function isValid($ttl = 30)
        {
            return !$this->isExpired($ttl) && $this->isFingerprint();
        }
    }