<?php

    namespace Sender4you\Request;

    class Click extends Request
    {

        protected $endpoint = 'click';

        public function handle()
        {

            parent::handle();

            $link = $this->api_response;

            if (empty($link)) {
                $this->notFound();
            }

            // use different redirect methods
            // php redirect
            //header('HTTP/1.1 301 Moved Permanently');
            //header('Location: '.$link);
            // html meta
            echo '<html><head><meta http-equiv="refresh" content="0;url='.$link.'" /></head><body></body></html>';

        }

    }