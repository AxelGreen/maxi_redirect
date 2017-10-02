<?php
    /**
     * Created by PhpStorm.
     * User: axel
     * Date: 10/2/17
     * Time: 12:00 PM
     */

    namespace Sender4you\Request;

    class Open extends Request
    {

        protected $input = array(
            'task_id' => 0,
            'email_id' => 0
        );

        public function handle()
        {

            parent::handle();

            echo 'open';

            // TODO: complete handle
        }

    }