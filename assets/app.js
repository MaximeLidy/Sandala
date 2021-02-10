import './bootstrap';
import './styles/global.scss';
import './styles/app.css';
import './styles/atom-one-dark.css';
const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/popover');

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');