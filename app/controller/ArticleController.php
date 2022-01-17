<?php
namespace App\Http\Controllers;

use App\Article;
use App\Like;
use Illuminate\Http\Request;
use App\Services\Validate\validate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $validate;
    private $article;
    public function __construct(Article $article ,validate $validate)
    {
        $this->validate=$validate;
        $this->article=$article;
        $this->middleware('auth:api');
    }
    public function create(Request $request)     /* create Article*/
    {

        if ($this->validate->validateArticleAdd($request)) {
            $article=$this->article->add($request);
            if ($article) {
                return response()->json(['message' => 'success','state' => 200,'article'=>['title'=>$article->title,'description'=>$article->description]]);
            }  return response()->json(['message' => 'error','state' => 500]);
        }return response()->json(['message' => 'erorr', 'state' => 400]);
    }

    public function edit(Request $request,$id)        /*Edit Article information*/
    { 
       
        $firstValidate= $this->validate->validateInputArticle($id);
        if ($firstValidate) {
            $secondValidate= $this->validate->validateEditArticle($request);
             if ($secondValidate) {
              $edit= $this->article->edit($request,$id);
               if ($edit) {
                return response()->json(['message' => 'success', 'state' => 200]);
               }else{
                return response()->json(['message' => 'error', 'state' => 500]);
               }
             }     
        }else{
            return response()->json(['message' => 'erorr', 'state' => 400]);
        }
        
    }

    public function remove($request)             /* delete Article*/
    {
        if ($this->validate->validateInputArticle($request)) {
            if ($this->article->remove($request)) {
                return response()->json(['message' => 'deleted', 'state' => 200]);
            }return response()->json(['message' => 'erorr', 'state' => 500]);
        }return response()->json(['message' => 'erorr', 'state' => 400]);
   
    }
    public function show($request)              /* show  Article*/
    {

        if ($this->validate->validateInputArticle($request)) {
            $article=$this->article->show($request);
            if ($article) {
                return response()->json(['message' => 'sucess', 'state' => 200,['article'=>$article]]);
            }return response()->json(['message' => 'erorr', 'state' => 500]);
        }return response()->json(['message' => 'erorr', 'state' => 400]);
     
    }

    public function like($request,Like $likes)                  /*   like article*/
    {
        if ($this->validate->validateInputArticle($request)) {
            $like = $likes->like($request);
           
            if ($like) {
                $likes->incrementCont_like($request);
                return response()->json(['message' => 'sucess', 'state' => 200,['user'=>auth('api')->user()->id,'article'=>$request]]);
            }return response()->json(['message' => 'erorr duplicated', 'state' => 500]);
        }return response()->json(['message' => 'erorr', 'state' => 400]);

    }

    public function searchArticles(Request $request)                     /*  Show search based on the most likes*/
    {
        $article=$this->article->searchArticles($request);
            if ($article) {
                return response()->json(['message' => 'sucess', 'state' => 200,['article'=>$article]]);
            }return response()->json(['message' => 'erorr', 'state' => 500]);   
    }
       public function searchArticleStore(Request $request)
    {
    
        $article=$this->article->searchArticleStore($request);
        if ($article) {
            return response()->json(['message' => 'sucess', 'state' => 200,['article'=>$article]]);
        }return response()->json(['message' => 'erorr', 'state' => 500]);   
   }

}
