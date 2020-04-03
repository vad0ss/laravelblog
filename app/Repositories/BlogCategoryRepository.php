<?php
/**
 * Created by PhpStorm.
 * User: grwes
 * Date: 4/3/2020
 * Time: 7:56 PM
 */

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogCategoryRepository extends CoreRepository
{
    /*
    * @return string
    */

    protected function getModelClass(){
        return Model::class;
    }


    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

}