<?php

namespace App\Http\Controllers;


use App\Hashtag;
use App\Services\Validate\validate;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
 

   private $hashtag;
   private $validate;
    public function __construct(Hashtag $hashtag, validate $validate)
    {

      $this->hashtag=$hashtag;
      $this->validate=$validate;
    
    }

    public function create(Request $request)
    {

      if ($this->validate->validateComment($request)) {
         $hashtag=$this->hashtag->store($request->body);
         if ($hashtag) {
             return response()->json(['message' => 'success','state' => 200,'article'=>['user_id'=>auth('api')->user()->name,'hastag'=>$request->body]]);
         }  return response()->json(['message' => 'error','state' => 500]);
     }return response()->json(['message' => 'erorr', 'state' => 400]);
    }
    public function add($article,$hashtag)
    {
      
       $firstValidate= $this->validate->validateInputArticle($article);
       if ($firstValidate) {
           $secondValidate= $this->validate->validateInputHashtag($hashtag);
            if ($secondValidate) {
             $result=  $this->hashtag->add($article,$hashtag);
              if ($result) {
               return response()->json(['message' => 'success', 'state' => 200]);
              }else{
               return response()->json(['message' => 'error', 'state' => 500]);
              }
            }return response()->json(['message' => 'erorr', 'state' => 400]);     
       }else{
           return response()->json(['message' => 'erorr', 'state' => 400]);
       }
       

    }

    public function index($request)
    {
       
       if ($this->validate->validateInputArticle($request)) {
          $hashtag= $this->hashtag->index($request);
          if ($hashtag) {
             return response()->json(['message' => 'sucess', 'state' => 200,['result'=>$hashtag]]);
         }return response()->json(['message' => 'erorr', 'state' => 500]);
     }return response()->json(['message' => 'erorr', 'state' => 400]);

    }

    public function search($request)
    {
       
       if ($this->validate->validateInputHashtag($request)) {
       
         $result=$this->hashtag->search($request);
         if ($result) {
             return response()->json(['message' => 'ok', 'state' => 200,['result'=>$result]]);
         }return response()->json(['message' => 'erorr', 'state' => 500]);
     }return response()->json(['message' => 'erorr', 'state' => 400]);
    
    }
    public function remove( $request)
    {
      if ($this->validate->validateInputHashtag($request)) {
       
         $result=$this->hashtag->remove($request);
         if ($result) {
             return response()->json(['message' => 'ok', 'state' => 200]);
         }return response()->json(['message' => 'erorr', 'state' => 500]);
     }return response()->json(['message' => 'erorr', 'state' => 400]);
     
    }

    public function show(Request $request)
    {

      if ($request) {
       
         $result=$this->hashtag->show($request);
         if ($result) {
             return response()->json(['message' => 'ok', 'state' => 200,['result'=>$result]]);
         }return response()->json(['message' => 'erorr', 'state' => 500]);
     }return response()->json(['message' => 'erorr', 'state' => 400]);
     
    }
}
