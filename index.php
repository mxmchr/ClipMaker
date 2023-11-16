<?php

require './vendor/autoload.php';

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

include './app/templates/header.php';

require_once './app/Router.php';

include './app/templates/footer.php';