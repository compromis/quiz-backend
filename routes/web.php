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

$router->get('/', function() {
    return 'Quiz Api 1.0';
});
$router->get('api/quiz/{quiz}/scores', 'QuizController@get_scores');
$router->post('api/quiz/{quiz}/score', 'QuizController@post_score');
$router->post('api/quiz/{quiz}/stat', 'QuizController@post_stat');
