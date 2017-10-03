<?php

    namespace Sender4you\Request;

    use Common\Connection\RedirectApi;
    use Common\Converter;
    use Mobile_Detect;

    class Request
    {

        protected $input
            = array(
                'task_id'  => 0,
                'email_id' => 0,
                'link_id'  => 0
            );

        protected $request
            = array(
                'c' => 'O1',
                't' => '',
                'd' => 0
            );

        protected $endpoint = '';

        protected $api_response = '';

        public function __construct()
        {

            $this->readInput();
            $this->validateInput();
            $this->requestDetails();

        }

        private function readInput()
        {

            // get subdomain - it contains input params
            $domain_parts = explode('.', $_SERVER['HTTP_HOST']);

            // explode input do different params
            $input = explode('u', $domain_parts[0]);

            // decode params
            $input = array_map(function ($value) {

                return Converter::stringToNumber($value);
            },
                $input);

            $this->input = array_combine(array_keys($this->input), $input);

        }

        private function validateInput()
        {

            foreach ($this->input as $value) {
                if ($value <= 0) {
                    $this->exit();
                }
            }

        }

        private function requestDetails()
        {

            $ip = $this->getIp();
            $location_data = $this->getLocationByIp($ip);
            if ( !empty($location_data['country_code'])) {
                $this->request['c'] = $location_data['country_code'];
            }
            if ( !empty($location_data['city'])) {
                $this->request['t'] = $location_data['city'];
            }

            $detector = new Mobile_Detect;
            $this->request['d'] = $this->getDeviceType($detector);

        }

        protected function exit()
        {

            echo 'exit';
            die();
        }

        public function handle()
        {

            $this->api_response = $this->callApi();

        }

        /**
         * Try to get client IP address for this request using server data.
         *
         * @return string - IP address. If can't determine return 0.0.0.0
         */
        private function getIp() : string
        {

            // get from environment
            /** @noinspection SpellCheckingInspection */
            $ip = getenv('HTTP_CLIENT_IP')
                ? :
                getenv('HTTP_X_FORWARDED_FOR')
                    ? :
                    getenv('HTTP_X_FORWARDED')
                        ? :
                        getenv('HTTP_FORWARDED_FOR')
                            ? :
                            getenv('HTTP_FORWARDED')
                                ? :
                                getenv('REMOTE_ADDR');

            // check if it is matches IP format
            preg_match('%(?:\d{1,3}\.){3}\d{1,3}%i', $ip, $rez);
            if (empty($rez[0])) { // if not - exit
                return '0.0.0.0';
            }

            // get the last one IP in row
            $ip = explode(',', $ip);
            $ip = trim(end($ip));

            // if it is localhost - exit
            if ($ip == '127.0.0.1') {
                return '0.0.0.0';
            }

            return $ip;

        }

        /**
         * Try to get geo location for provided IP using stored GeoIP db.
         *
         * @param string $ip - IP address
         *
         * @return array - location for provided IP
         */
        private function getLocationByIp(string $ip) : array
        {

            $location_data = array();

            // exit if IP not provided
            if (empty($ip)) {
                return $location_data;
            }

            // get location data from stored db
            $location = geoip_record_by_name($ip);
            if (empty($location)) { // no data found
                return $location_data;
            }

            return $location;

        }

        /**
         * Try to get device type
         *
         * @param Mobile_Detect $detector - instance of Mobile_Detect class, used for device detection
         *
         * @return int - type of device: 0 - pc or not detected, 1 - mobile, 2 - tablet. Prepended with 3 random digits to hide in encoding process
         */
        private function getDeviceType(Mobile_Detect $detector) : int
        {

            $device_type = 0; // pc or not detected

            // check for mobile device
            if ($detector->isMobile()) {
                if ($detector->isTablet()) { // check tablet
                    $device_type = 2; // tablet
                } else {
                    $device_type = 1; // mobile
                }
            }

            return $device_type;

        }

        private function callApi()
        {

            $api = RedirectApi::getInstance();

            $this->input['request'] = json_encode($this->request, JSON_HEX_QUOT);
            $response = $api->makeRequest($this->endpoint, $this->input);

            return $response;

        }

        protected function notFound()
        {

            http_response_code(404);
            echo "Not found";
            die();
        }

    }