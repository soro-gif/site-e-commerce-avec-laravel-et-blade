<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Page;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Social;
use App\Models\Megacollection;
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
        $mega_menus = Category::where("isMega", 'true')->take(4)->get();
        $mega_collection = Megacollection::all();
        $settings = Setting::first();
        $socials = Social::all();
        $pages = [
            "headPages" => $headPages,
            "footPages" => $footPages,
            "mega_menus" => $mega_menus,
            "mega_collection" => $mega_collection,
            "settings" => $settings,
            "socials" => $socials
        ];
        $session->put('pages', $pages);
        $session->put('mega_menus', $mega_menus);
        $session->put('mega_collection', $mega_collection);
        $session->put('settings', Setting::first());
        $session->put('socials', Social::all());
        return $next($request);
    }
}
