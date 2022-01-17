<?php
namespace App\Http\Controllers;



use App\Fallow;
use App\User;
use Illuminate\Http\Request;
use App\Services\Validate\validate;

class UserController extends Controller
{
    protected $user;
    protected $validate;
    protected $request;
 
    public function __construct(Request $request, User $user, Validate $validate)
    {
        $this->user=$user;
        $this->validate=$validate;
        $this->request=$request;
    
        $this->middleware('auth:api', ['except' => ['login','create']]);
    }
    public function create()     /* create user*/
    {
        if ($this->validate->validateFormAdd($this->request)) {
            if ($user=$this->user->add($this->request)) {
                return response()->json(['message' => 'success', 
                                         'state' => 200,
                                          'user'=>[
                                            'name'=>$user->name,
                                            'email'=>$user->email
                                            
                
                                        ]
                                        ]);
            }
           
        } return response()->json(['message' => 'erorr', 'state' => 500]);
    }

    public function remove( $request)
    {
      
        if ($this->validate->validateInputUser($request)) {
            if ($this->user->remove($request)) {
                return response()->json(['message' => 'deleted', 'state' => 200]);
            }return response()->json(['message' => 'erorr', 'state' => 500]);
        }return response()->json(['message' => 'erorr', 'state' => 400]);
            
        
    }

    public function edit(Request $request,$id)        /*Edit user information*/
     {
     
         if (auth('api')->user()->id==$id) {
            $secondValidate=$this->validate->validateEditInput($request);
             if ($secondValidate) {
              $edit=$this->user->edit($request,$id);
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
     public function searchUser(Request $request)          /*  search user to name user*/
         {

            if ($this->validate->validateInputSearch($request)) {
                $user=$this->user->searchUser($request);
                if ($user) {
                    return response()->json(['message' => 'ok', 'state' => 200,['user'=>$user]]);
                }return response()->json(['message' => 'erorr', 'state' => 500]);
            }return response()->json(['message' => 'erorr', 'state' => 400]);
        
         }
    public function showPost($request)    /*  show posts of user */
             {

                if ($this->validate->validateInputUser($request)) {
                    $user= $this->user->index($request);
                    if ($user) {
                        return response()->json(['message' => 'ok', 'state' => 200,['user'=>$user]]);
                    }return response()->json(['message' => 'erorr', 'state' => 500]);
                }return response()->json(['message' => 'erorr', 'state' => 400]);
           }
           public function fallow( $request,Fallow $fallow)         /*Fallow User*/
               {
                 
                 if ($this->validate->validateInputUser($request)) {
                    $user= $fallow->fallow($request);
                    if ($user) {
                        $fallow->incrementCont_fallowing($request);
                        return response()->json(['message' => 'ok', 'state' => 200,['user'=>auth('api')->user()->id,'user_following'=>$request]]);
                    }return response()->json(['message' => 'erorr', 'state' => 400]);
                }return response()->json(['message' => 'erorr', 'state' => 400]);
          
              }
     
}     