<?php

/*
 * This file is part of the WordPress Standard project.
 *
 * Copyright (c) 2015-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */

define('WP_MEMORY_LIMIT',     '64M');

define('DB_NAME',             'database_name_here');
define('DB_USER',             'username_here');
define('DB_PASSWORD',         'password_here');
define('DB_HOST',             'localhost');
define('DB_CHARSET',          'utf8');
define('DB_COLLATE',          '');

define('WP_DEBUG',                   true);
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISALLOW_FILE_EDIT',         true);
define('DISALLOW_FILE_MODS',         true);

// See: https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',           'Put your unique phrase here');
define('SECURE_AUTH_KEY',    'Put your unique phrase here');
define('LOGGED_IN_KEY',      'Put your unique phrase here');
define('NONCE_KEY',          'Put your unique phrase here');
define('AUTH_SALT',          'Put your unique phrase here');
define('SECURE_AUTH_SALT',   'Put your unique phrase here');
define('LOGGED_IN_SALT',     'Put your unique phrase here');
define('NONCE_SALT',         'Put your unique phrase here');

define('MAILER_SMTP',        false);
define('MAILER_HOST',        'localhost'); // ex: smtp.sparkpostmail.com
define('MAILER_PORT',        25); // ex: 587
define('MAILER_USERNAME',    ''); // ex: SMTP_Injection
define('MAILER_PASSWORD',    '');
define('MAILER_TRANSPORT',   ''); // ex. tls

define('TRANSLATION_DOMAIN', 'Put your translation domain');
define('XMLRPC_ENABLED',     false);

define('WP_CACHE',           false);
define('WPML_FORCE_UPDATES', true);
