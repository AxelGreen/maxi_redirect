<?php

    namespace Config;

    use Common\Singleton;

    class ConnectionConfig extends Singleton
    {

        public $sender4you_api
            = array(
                'host'           => 'http://api.sender4you.com/',
                'version_prefix' => 'redirect/',
                'endpoints'      => array(
                    'open' => 'open',
                    'click' => 'click'
                )
            );

    }