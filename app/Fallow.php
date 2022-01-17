<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fallow extends Model
{
    protected $fillable=[
        'user_following','user_follower'
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function incrementCont_fallowing($request)
    {
        $userState = UserState::where('user_id', $request)->first();
        $userState ->count_follower++;
        $userState ->save();
         $userState = UserState::where('user_id',auth('api')->user()->id)->first();
        $userState ->count_following++;
        $userState ->save();

    }
    public function fallow($user_following)
    {
        
        $array = [
            ['user_following' => $user_following, 'user_id' =>auth('api')->user()->id],
        ];

        if (  DB::table('fallows')->insertOrIgnore($array)){
            return true;
        }return false;
    }
}
