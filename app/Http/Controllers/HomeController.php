<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\News;

class HomeController extends Controller
{
    private $country;
    private $lang;
    private $sources;
    private $response;

    public function __construct()
    {
        $this->country = ["ae","ar","at","au","be","bg","br","ca","ch","cn","co","cu","cz","de","eg","fr","gb","gr","hk","hu","id","ie","il","in","it","jp","kr","lt","lv","ma","mx","my","ng","nl","no","nz","ph","pl","pt","ro","rs","ru","sa","se","sg","si","sk","th","tr","tw","ua","us","ve","za"];
        $this->lang = ["ar","de","en","es","fr","he","it","nl","no","pt","ru","se","ud","zh"];
        $this->sources = ["business","entertainment","general","health","science","sports","technology"];
        // 1acff5f1e6c84fa8a97f4b5f8a960eae
    }

    public function index(Request $request){
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=us&apiKey=1acff5f1e6c84fa8a97f4b5f8a960eae');
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            // 'newsdata' => $response->object()->articles,
            'newsdata' => [],
            'country' => $this->country,
            'lang' => $this->lang,
            'sources' => $this->sources
        ]);
    }

    public function newslist(Request $request){
        $uriParam = "";
        if($request->source != ""){
            $uriParam .= "category=".$request->source;
        }
        if($request->country != ""){
            if($uriParam != ""){
                $uriParam .= "&";
            }
            $uriParam .= "country=".$request->country;
        }
        if($request->lang != ""){
            if($uriParam != ""){
                $uriParam .= "&";
            }
            $uriParam .= "language=".$request->lang;
        }
        if(strlen($uriParam) > 3 && substr($uriParam, -1) != "&" ){
            $uriParam .= "&";
        }else{
            $uriParam .= "country=us&";
        }
        $completeURL = "https://newsapi.org/v2/top-headlines?".$uriParam."apiKey=1acff5f1e6c84fa8a97f4b5f8a960eae";
        $response = Http::get($completeURL);
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            // 'newsdata' => $response->object()->articles,
            'newsdata' => [],
            'country' => $this->country,
            'lang' => $this->lang,
            'sources' => $this->sources
        ]);
    }

    public function newsDetail(Request $request){
        $totalLikes = $totalDislike = 0;
        if(!empty($request->details) && $request->details['url'] != ""){
            ///Get news details
            $getNews = News::where("news_unique_url",$request->details['url'])->first();
            if(!empty($getNews)){
                $totalLikes = $getNews->likes->where("is_liked",1)->count();
                $totalDislike = $getNews->likes->where("is_liked",0)->count();
            }
        }

        return Inertia::render('Details', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'country' => $this->country,
            'lang' => $this->lang,
            'sources' => $this->sources,
            'details' => $request->details,
            'totalLike' => $totalLikes,
            'totalDislike' => $totalDislike
        ]);
    }
}
