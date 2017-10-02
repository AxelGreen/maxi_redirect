<?php
    /**
     * Created by PhpStorm.
     * User: axel
     * Date: 10/2/17
     * Time: 12:00 PM
     */

    namespace Sender4you\Request;

    use Common\Converter;

    class Open extends Request
    {

        protected $input = array(
            'task_id' => 0,
            'email_id' => 0
        );

        protected $endpoint = 'open';

        public function handle()
        {

            parent::handle();


        }

    }