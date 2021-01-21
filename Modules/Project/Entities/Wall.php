<?php

namespace Modules\Project\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class wall extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'parent_id',
        'text',
    ];

    public function answer (){
        return $this->hasMany(wall::class,'parent_id','id');
    }

    public function user (){
        return $this->hasOne(User::class,'id','user_id');
    }
}
