<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__) . '/wp-config-custom.php');

$table_prefix = 'wp_';

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/core/');
}

define('WP_CONTENT_DIR', realpath(ABSPATH . '../'));
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/core');
define('WP_CONTENT_URL', WP_HOME);

require_once(ABSPATH . 'wp-settings.php');
