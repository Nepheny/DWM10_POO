<?php
    class SaveHelperClass
    {
        protected $remoteType = "session";

        public function saveData($key, $value)
        {
            session_start();
            $_SESSION[$key] = $value;
            return $_SESSION[$key];
        }
    }