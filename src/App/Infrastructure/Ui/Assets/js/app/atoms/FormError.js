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

import {onDomReady} from 'lin3s-event-bus';
import $ from 'jquery';
import Parsley from 'parsleyjs';
import 'parsleyjs/dist/i18n/en';
import 'parsleyjs/dist/i18n/es';

const initParsley = (lang) => {
  const splittedLang = lang.split('_');

  let locale = lang;
  if (splittedLang.length > 0) {
    locale = splittedLang[0];
  }

  Parsley.setLocale(locale);
};

const onReady = () => {
  const lang = $('html').attr('lang');

  initParsley(lang);
};

onDomReady(onReady);
