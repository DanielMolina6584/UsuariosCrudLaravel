<?php

namespace App\Http\Middleware;

use App\Services\SvcRequest;
use Closure;
use Illuminate\Http\Request;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    private $svcRequest;
    public function __construct(SvcRequest $svcRequest){
        $this->svcRequest = $svcRequest;
    }
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header("token");
        $tokenDataBase =  $this->svcRequest->validarToken($token);

        if(!$tokenDataBase){
            session()->forget("token");

            $errors = 'Token Invalido';
            $errorMessages = [];
            $errorMessages[] = $errors;
            
           return response()->json([
                
                "error"  => false,
                "errors" => $errorMessages,                    
            ]);
        } 
        return $next($request);
    }
}
