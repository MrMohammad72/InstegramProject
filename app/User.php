<?php


namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable ;
   /*  use Commentable;*/
    const NAME_MIN_LENGTH = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*  protected $hidden = [
          'password', 'remember_token',
      ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userState()
    {

       return $this->hasOne(UserState::class);
    }

    public function CountComment()
    {
        $this->userState->count_comment++;
        $this->userState->save();
    }

    public function incrementArticle()
    {

        $this->userState->count_article++;
        $this->userState->save();
    }

    public function add($request)
    {
       
        return $this->create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'image'=>$request->image
                
            ]);
    }

    public function edit($request,$id)
    {
        $user = $this::find($id);
      
       $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'image'=>$request->image
        ]);
        return true; 

    }

    public function remove($request)
    {
           $this::findOrFail($request)->delete();
           return true;
    }

    public function searchUser($request)
    {
        $data = $request->query('search');
        return  User::where('name', 'like', "%{$data}%")->get();
    }
    public function index($request)
    {
       
        return User::with('posts')->find($request);
    }

 
    public function posts()
    {
        return $this->hasMany(Article::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function fallows()
    {
        return $this->hasMany(Fallow::class);
    }
}
