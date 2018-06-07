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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api/v1'], function () use ($router){
	$router->get('{agent}/ready', ['uses' => 'UssdController@ready']);
	$router->get('{agent}/not_ready', ['uses' => 'UssdController@notReady']);
	$router->get('{agent}/{state}/{reasonid}', ['uses' => 'UssdController@notReadyreason']);
	$router->get('{agent}/logout', ['uses' => 'UssdController@logOUt']);
	$router->get('{agent}/reasoncodes', ['uses' => 'UssdController@ReasonCodes']);
	$router->get('{agent}/reasoncodes', ['uses' => 'UssdController@ReasonCodes']);
	$router->get('{agent}/queues', ['uses' => 'UssdController@agentQueues']);
	$router->get('{agent}/state', ['uses' => 'UssdController@agentStatus']);
	$router->get('{agent}/dialog', ['uses' => 'UssdController@agentDialog']);
	$router->get('/update-details', function () use ($router) {
		$result = getConfiguration();
		if ($result != NULL) {
			$fqdn = $result->fqdn;
			$port = $result->port;
			$user = $result->username;
			$password = $result->password;
		}
		else{
			$fqdn = '';
			$port = '';
			$user = '';
			$password = '';
		}

		return view('details', ['fqdn' => $fqdn, 'port' => $port, 'user' => $user, 'password' => $password]);
	});
});
$router->post('/update', ['uses' => 'UssdController@update']);
