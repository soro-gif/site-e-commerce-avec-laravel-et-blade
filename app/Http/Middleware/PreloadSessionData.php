<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Page;
use Illuminate\Support\Facades\Session;
class PreloadSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session();
        $headPages = Page::where("isHead", 'true')->get();
        $footPages = Page::where("isFoot", 'true')->get();
        $pages = [
            "headPages" => $headPages,
            "footPages" => $footPages
        ];
        $session->put('pages', $pages);
        return $next($request);
    }
}
