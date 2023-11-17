<?php

require './vendor/autoload.php';

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

if (!defined('NAMESPACE_CONTROLLER')) {
    define('NAMESPACE_CONTROLLER', 'Clipmaker\\Controllers\\');
}

include './app/templates/header.php';

require_once './app/Router.php';

include './app/templates/footer.php';