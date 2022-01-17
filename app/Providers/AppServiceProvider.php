<?php

namespace App\Providers;

use App\Article;
use App\Comment;
use App\Hashtag;
use App\HashtagState;
use App\Observers\articleObsesrver;
use App\Observers\commentObsesrver;
use App\Observers\countHashtagObsesrver;
use App\Observers\hashtagStateObsesrver;
use App\Observers\userObsesrver;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * a@return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       User::observe(userObsesrver::class);
      Article::observe(articleObsesrver::class);
      Comment::observe(commentObsesrver::class);
      Hashtag::observe(hashtagStateObsesrver::class);
      HashtagState::observe(countHashtagObsesrver::class);
      
      
       

    }
}
