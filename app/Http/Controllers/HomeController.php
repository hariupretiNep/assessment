<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    
    public function index(Request $request){
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=us&apiKey=3bfb167fdc8348ff9f4b3b6104bc9d3d');
        $country = ["ae","ar","at","au","be","bg","br","ca","ch","cn","co","cu","cz","de","eg","fr","gb","gr","hk","hu","id","ie","il","in","it","jp","kr","lt","lv","ma","mx","my","ng","nl","no","nz","ph","pl","pt","ro","rs","ru","sa","se","sg","si","sk","th","tr","tw","ua","us","ve","za"];
        $lang = ["ar","de","en","es","fr","he","it","nl","no","pt","ru","se","ud","zh"];
        $sources = ["business","entertainment","general","health","science","sports","technology"];
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'newsdata' => $response->object()->articles,
            // 'newsdata' => [],
            'country' => $country,
            'lang' => $lang,
            'sources' => $sources
        ]);
    }
}
