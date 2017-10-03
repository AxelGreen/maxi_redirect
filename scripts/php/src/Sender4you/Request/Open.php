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

        private $image_file = '/etc/sender4you/assets/empty.gif';

        protected $input
            = array(
                'task_id'  => 0,
                'email_id' => 0
            );

        protected $endpoint = 'open';

        public function handle()
        {

            parent::handle();

            $this->genImage();
            exit(0);

        }

        private function genImage()
        {

            // open file
            $handle = fopen($this->image_file, 'r');
            // read content
            $contents = fread($handle, filesize($this->image_file));
            // close file
            fclose($handle);

            // change response content type to gif
            header('Content-Type: image/gif');
            // print file content
            echo($contents);
        }

    }