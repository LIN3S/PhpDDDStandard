<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$root = $_SERVER['DOCUMENT_ROOT'];
chdir($root);
$path = '/' . ltrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
set_include_path(get_include_path() . ':' . __DIR__);
if ($path === '/wp-admin/') {
    header('Location: /core/wp-admin/');
    die;
}
if (file_exists($root . $path) && $path !== '/') {
    if (is_dir($root . $path) && substr($path, strlen($path) - 1, 1) !== '/') {
        $path = rtrim($path, '/') . '/core/index.php';
    }
    if (strpos($path, '.php') === false) {
        return false;
    } else {
        chdir(dirname($root . $path));
        require_once $root . $path;
    }
} else {
    include_once $root . '/core/index.php';
}
