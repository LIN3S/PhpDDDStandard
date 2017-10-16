<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use LIN3S\WPFoundation\Configuration\Theme\Theme;

class App extends Theme
{
    public function classes()
    {
    }

    public function context(array $context)
    {
        return $context;
    }

    public function templates($templates)
    {
        return $templates;
    }
}
