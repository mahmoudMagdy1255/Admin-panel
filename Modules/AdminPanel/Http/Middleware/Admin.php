<?php

namespace Modules\AdminPanel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next) {
		if (Auth('admin')->check()) {

			return $next($request);
		}

		return redirect()->route('admin.login');
	}
}
