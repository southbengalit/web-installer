<?php

namespace Sbit\WebInstaller\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerifyInstallMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $installedLogFile = storage_path('installed');

        if (!file_exists($installedLogFile) && !app()->runningInConsole()) {
            if (!in_array(url()->current(), [
                url('/install'),
                url('/install/validation/configuartion'),
                url('/install/configuration'),
                url('/install/database'),
                url('/install/final'),
            ])) {
                return redirect('/install');
            }
        }
        return $next($request);
    }
}