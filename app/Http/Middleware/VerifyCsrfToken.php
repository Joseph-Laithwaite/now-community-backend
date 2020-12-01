<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}

$http = new GuzzleHttp\Client;

$response = $http->post('http://nowcommunity.test/oauth/token', ['form_params' => ['grant_type' => 'password','client_id' => '2','client_secret' => 'nYntg7DEmnWwerUDc8PyW8WPTt2sEHQ84us2D7Tz','username' => 'jbarton@example.net','password' => 'secret','scope' => '',],]);

return json_decode((string) $response->getBody(), true);
