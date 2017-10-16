/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */

'use strict';

import FastClick from 'fastclick';
import {onDomReady} from 'lin3s-event-bus';
import 'picturefill';
import svg4everybody from 'svg4everybody';

import './atoms/FormError';

import './components/Cookies';

const onReady = () => {
  svg4everybody();
  new FastClick(document.body);
};

onDomReady(onReady);
