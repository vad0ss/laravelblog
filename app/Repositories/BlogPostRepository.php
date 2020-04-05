<?php
/**
 * Created by PhpStorm.
 * User: grwes
 * Date: 4/3/2020
 * Time: 7:56 PM
 */

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogPostRepository extends CoreRepository
{
    /*
    * @return string
    */

    protected function getModelClass(){
        return Model::class;
    }

}