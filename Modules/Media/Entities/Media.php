<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class media extends Model
{
    protected $fillable = [
        'type',
        'owner_id',
        'media_path',
        'alternative_text',
        'title',
        'caption',
    ];
}
