<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
		//Обработка 500 ошибки
		$exceptions->render(function (\Throwable $e, Request $request) {
			if ($request->is('api/*')) {
				//$statusCode = response()->getStatusCode();
				return response()->json([
					'message' => 'Ошибка API',
					'error' => $e->getMessage(),
					'e_type' => get_class($e)
					//'code'=> $e->getStatusCode(),
				], 500);
			}
		});
    })->create();
