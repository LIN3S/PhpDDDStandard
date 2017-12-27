/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */

import FastClick from 'fastclick';
import {onDomReady, LifeTimeEventPublisher} from 'lin3s-event-bus';
import * as Validatory from 'validatory';
import FormValidationStateChangedEvent from './../event-bus/FormValidationStateChangedEvent';
import FormElementValidationStateChangedEvent from './../event-bus/FormElementValidationStateChangedEvent';

const onReady = () => {
  new FastClick(document.body);

  Validatory.init({
    formSelector: 'form',
    formElementSelector: 'input, select, textarea',
    onFormValidationStateChanged: formValidatorInstance =>
      LifeTimeEventPublisher.publish(new FormValidationStateChangedEvent(formValidatorInstance)),
    onFormElementValidationStateChanged: formElementValidatorInstance =>
      LifeTimeEventPublisher.publish(new FormElementValidationStateChangedEvent(formElementValidatorInstance))
  });
};

onDomReady(onReady);
