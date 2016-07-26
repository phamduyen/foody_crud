<?php

namespace App\Http\Middleware;

//use \Illuminate\Support\Facades\Auth;

use \Illuminate\Contracts\Auth\Guard;
//use App\Http\Controllers\Auth;
use \App\Models\User;
use Closure;

class IsAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    
    public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
    
    public function handle($request, Closure $next) {
       
        if ($this->auth->check()) {
            if ($this->auth->user()->role === 1) {
                return $next($request);
            }
        }
        return  redirect(url('/home'));
        //(url('/'));
    }

}
