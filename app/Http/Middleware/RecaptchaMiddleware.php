<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RecaptchaMiddleware
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_DEBUG')) {
            return $next($request);
        }

        $results = $this->getCaptcha($request->input('g-recaptcha-response'), $request->ip());

        if ($results->success && $results->score > 0.5) {
            return $next($request);
        }

        return back()->with('error', 'error');
    }

    private function getCaptcha(?string $recaptchaResponse = '', ?string $ip = '')
    {
        $results = $this->client->post(env('RECAPTCHA_URL'), [
            'form_params' => [
                'secret' => env('SECRET_KEY'),
                'response' => $recaptchaResponse,
                'remoteip' => $ip,
            ],
            'verify' => ! env('APP_DEBUG'),
        ]);

        return json_decode($results->getBody());
    }
}
