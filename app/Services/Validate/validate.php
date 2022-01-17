<?php

namespace App\Services\Validate;

use App\Article;
use App\Comment;
use App\Hashtag;
use App\User;

class validate {

   
    public function validateFormAdd($request)
    {
      $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8'],
          'image' => ['required'],
      ]);
      return true;
    }


    public function validateForm($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ]);
    }
  
    public function validateInputPost($request)
    {
        return  $request->validate([
            'id' => ['required','exists:articles'],
        ]);
    }
    public function validateInputUser($request)
    {
      
        $user=User::where('id','like',$request)->get();

          if (strlen($user)<=2) {
              
              return false;
          } else {
              return true;
          }
       
    }
    public function validateEditInput($request)
    {
        $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'password' => ['required', 'string', 'min:8'],
          'image' => ['required'],
      ]);
      return true;
    }

    public function validateInputFallow($request)
    {
        return  $request->validate([
            'user_following' => ['required','exists:users,id'],
        ]);
    }
    public function validateInputArticle($request)
    {
     
        $article=Article::where('id','like',$request)->get();
       
          if (strlen($article)<=2) {
              
              return false;
          } else {
              return true;
          }
    }
    public function validateInputHashtag($request)
    {
        $hashtag=Hashtag::where('id','like',$request)->get();
       
    
          if (strlen($hashtag)<=2) {
              
              return false;
          } else {
              return true;
          }
    }

    public function validateEditArticle($request)
    {
         $request->validate([
            'title' => ['required'],
             'description'=>['required'],
             'image'=>['required']
        ]);
        return true;
    }
    public function validateComment($request)
    {
 
         $request->validate([
            'body' => ['required'],
        ]);
        return true;
    }

 


    public function validateInputLike($request)
    {
        return  $request->validate([
            'article_id' => ['required','exists:articles,id'],
        ]);
    }

    public function validateArticleAdd($request)
    {
          $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required'],

        ]);
        return true;
    }

    public function validateInputSearch($request)
    {
        
        if (strlen($request)<=589) {
              
            return false;
        } else {
            return true;
        }
  
    }

    public function validateCommentLike($request)
    {
        $comment=Comment::where('id',$request)->get();
        if (strlen($comment)<=2) {
              
            return false;
        } else {
            return true;
        }
  
    }
    public function validateCreateHashtag($request)
    {
        return  $request->validate([
            'hashtag' => ['required']
        ]);
    }
    public function validateString($request)
    {
        return  $request->validate([
            'limit' => ['required']
        ]);
    }
    public function validateSearch($request)
    {
        return  $request->validate([
            'hashtag_id' => ['required','exists:hashtags,id'],
        ]);
    }

}
