<?php

    //use Sender4you\Configure\Postgres;

    use Sender4you\Configure\Apache;
    use Sender4you\Configure\Postgres;

    require_once __DIR__.'/vendor/autoload.php';

    try {

        // postgresql
        $postgres = new Postgres();
        // create table
        $postgres->run();

        // apache
        $apache = new Apache();
        // move files
        $apache->run();
        // restart to apply changes
        $apache->restart();

    } catch (Exception $exception) {

        // generate log entry
        $error = array(
            'date'    => date('Y-m-d H:i:s'),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
            'message' => '"'.$exception->getMessage().'"'
        );
        $error_message = implode(' ', $error).PHP_EOL;

        echo _('Installation error').': '.$error_message;

    }
