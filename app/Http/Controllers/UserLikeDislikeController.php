<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\UserLikeDislike;
use Illuminate\Http\Request;
use App\Models\News;

class UserLikeDislikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        ///Create news record before recording like
        $reference = self::createIfNotExist($request->url);
        $news_id = $reference->id;
        $user_id = $request->user()->id;
        $status = UserLikeDislike::updateOrInsert(
            ['news_id' => $news_id, 'user_id' => $user_id],
            ['is_liked'=>1]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dislike(Request $request)
    {
        ///Create news record before recording like
        $reference = self::createIfNotExist($request->url);
        $news_id = $reference->id;
        $user_id = $request->user()->id;
        $status = UserLikeDislike::updateOrInsert(
            ['news_id' => $news_id, 'user_id' => $user_id],
            ['is_liked'=>0]
        );
    }

    private function createIfNotExist($url){
        $news = News::where("news_unique_url",$url)->first();
        if(empty($news)){
            $news = new News;
            $news->news_unique_url = $url;
            $news->save();
        }
        return $news;
    }
}
