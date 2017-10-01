<?php

    namespace Config;

    use Common\Singleton;

    class SenderConfig extends Singleton
    {

        /**
         * @var array - log files location
         */
        public $logs
            = array(
                'info'  => '/var/log/sender4you/sender_info.log',
                'error' => '/var/log/sender4you/sender_error.log'
            );

    }