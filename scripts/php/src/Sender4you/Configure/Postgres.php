<?php

    namespace Sender4you\Configure;

    use Common\Connection\PgConnection;

    class Postgres
    {

        public function run()
        {

            $connection = PgConnection::getInstance();

            // TODO: uncomment
            //$this->createTables($connection);

        }

        private function createTables(PgConnection $connection) {

            // TODO: createTables: change query
            // create logs table
            $query = '
                CREATE TABLE IF NOT EXISTS exim_logs (
                    date timestamp with time zone NOT NULL,
                    exim_id varchar(16) NOT NULL PRIMARY KEY,
                    action smallint NOT NULL,
                    message_id varchar NULL,
                    host varchar NULL,
                    error varchar NULL
                )
            ';

            // execute query
            $connection->query($query);

        }

    }