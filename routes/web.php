<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('{quiz}/scores', 'QuizController@get_scores');
$router->post('{quiz}/score', 'QuizController@post_score');
$router->post('{quiz}/stat', 'QuizController@post_stat');
