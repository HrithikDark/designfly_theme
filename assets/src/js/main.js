/**
 * Main scripts, loaded on all pages.
 *
 * @package Designfly
 */

import '../sass/main.scss';
import './components/navigation';
import './components/carousel';
import * as components from './components';

window.$ = window.$ || jQuery;

// Initialize common scripts.
components.WebFont.init();
components.common.init();

// Images.
import '../img/features-repeatable-bg.png';
