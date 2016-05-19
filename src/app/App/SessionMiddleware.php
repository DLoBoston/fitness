<?php
namespace App;

class SessionMiddleware
{
    /**
     * middleware invokable class that starts Session
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        session_start();
        
        $response = $next($request, $response);
        return $response;
    }
}
