<?php

    namespace Sender4you\Request;

    use Common\Converter;

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