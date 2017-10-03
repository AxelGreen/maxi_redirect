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

            header('Location: '.$link);

        }

    }