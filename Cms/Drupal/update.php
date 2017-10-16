<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Drupal\Core\Update\UpdateKernel;
use Symfony\Component\HttpFoundation\Request;

$autoloader = require_once __DIR__ . '/../../Drupal/autoload.php';

// Disable garbage collection during test runs. Under certain circumstances the
// update path will create so many objects that garbage collection causes
// segmentation faults.
require_once 'core/includes/bootstrap.inc';
if (drupal_valid_test_ua()) {
  gc_collect_cycles();
  gc_disable();
}

$kernel = new UpdateKernel('prod', $autoloader, FALSE);
$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
