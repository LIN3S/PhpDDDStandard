<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$url = parse_url($_SERVER['REQUEST_URI']);
if (file_exists('.' . $url['path'])) {
    // Serve the requested resource as-is.
    return FALSE;
}

// The use of a router-script means that a number of $_SERVER variables has to
// be updated to point to the index-file.
$index_file_absolute = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'index.php';
$index_file_relative = DIRECTORY_SEPARATOR . 'index.php';

// SCRIPT_FILENAME will point to the router-script itself, it should point to
// the full path to index.php.
$_SERVER['SCRIPT_FILENAME'] = $index_file_absolute;

// SCRIPT_NAME and PHP_SELF will either point to /index.php or contain the full
// virtual path being requested depending on the url being requested. They
// should always point to index.php relative to document root.
$_SERVER['SCRIPT_NAME'] = $index_file_relative;
$_SERVER['PHP_SELF'] = $index_file_relative;

// Require the main index-file and let core take over.
require $index_file_absolute;
