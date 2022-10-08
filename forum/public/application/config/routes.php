<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['default_controller'] = 'pages/index';
// $route['(:any)'] = 'pages/index/$1';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'pages/index';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['register']['GET'] = 'Register/index';
$route['register']['POST'] = 'Register/register';

// $route['post']['POST'] = 'Post/register';



