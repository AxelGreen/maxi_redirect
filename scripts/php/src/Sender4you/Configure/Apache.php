<?php
    /**
     * Created by PhpStorm.
     * User: axel
     * Date: 10/1/17
     * Time: 11:51 PM
     */

    namespace Sender4you\Configure;

    class Apache
    {

        public function run()
        {

            $this->moveFiles();

        }

        private function moveFiles() {

            // move index file
            $command = 'mv /etc/sender4you/index.php /var/www/';
            shell_exec($command);

            // move .htaccess file
            $command = 'mv /etc/sender4you/.htaccess /var/www/';
            shell_exec($command);

        }

        public function restart() {
            $command = '/etc/init.d/apache2 restart';
            shell_exec($command);
        }

    }