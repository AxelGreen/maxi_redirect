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

            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$link);

        }

    }