<?php

    use Sender4you\Request\Click;
    use Sender4you\Request\Open;

    require_once '/etc/sender4you/vendor/autoload.php';

    $actions = array('open', 'click');

    $action = $_GET['action'];
    if ( !in_array($action, $actions)) {
        notFound();
    }

    $handler = null;
    switch ($action) {
        case 'open': {
            $handler = new Open();
        } break;
        case 'click': {
            $handler = new Click();
        } break;
    }

    $handler->handle();

    function notFound()
    {

        http_response_code(404);
        echo "Not found";
        die();
    }