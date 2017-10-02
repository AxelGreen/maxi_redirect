<?php
    namespace Sender4you\Request;

    class Click extends Request
    {

        protected $endpoint = 'open';

        public function handle()
        {

            parent::handle();

            echo 'click';

            // TODO: complete handle
        }

    }