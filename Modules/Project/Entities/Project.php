<?php

namespace Modules\Project\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\category;
use Modules\Media\Entities\media;

class project extends Model
{
    protected $fillable = [
        'owner_id',
        'designer_id',
        'category_id',
        'title',
        'subtitle',
        'description',
        'tags',
        'vote',
        'country',
        'address',
        'location_lat',
        'location_long',
        'deadline',
        'objective',
        'size',
        'net_price',
        'total_price',
        'total_price',
        'status',
    ];

    public function owner (){
        return $this->hasOne(User::class,'id','owner_id');
    }

    public function designer (){
        return $this->hasOne(User::class,'id','designer_id');
    }

    public function category (){
        return $this->hasOne(category::class,'id','category_id');
    }

    public function image (){
        return $this->hasMany(media::class,'owner_id','id');
    }

    public function project_image (){
        return $this->image()->where('type','project');
    }

}
