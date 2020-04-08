<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * Category post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function category(){
       // Post belongs to category
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Post Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
       // Post belongs to author
        return $this->belongsTo(User::class);
    }
}
