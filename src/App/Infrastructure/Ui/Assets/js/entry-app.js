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

import './../scss/app/app.scss';

import {listenDomReady, listenDomLoaded} from 'lin3s-event-bus';

import './app/app';

listenDomReady();
listenDomLoaded();