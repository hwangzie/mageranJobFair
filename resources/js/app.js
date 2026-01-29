import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import '../css/app.css'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';
