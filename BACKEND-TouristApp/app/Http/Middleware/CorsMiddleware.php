<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
  public function handle($request, Closure $next)
  {
      $response = $next($request);

      $response->header('Access-Control-Allow-Origin', '*');
      $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS');
      $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));

      if ($request->isMethod('OPTIONS')) {
          $response->setStatusCode(200);
          $response->setContent(null);
      }

      return $response;
  }
}
