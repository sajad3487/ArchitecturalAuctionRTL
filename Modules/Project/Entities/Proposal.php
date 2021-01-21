<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Media\Entities\media;

class proposal extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'description',
    ];

    public function get_file (){
        return $this->hasMany(media::class,'owner_id','id');
    }

    public function proposal_file (){
        return $this->get_file()->where('type','proposal');
    }
}
