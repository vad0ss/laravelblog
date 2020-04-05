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

    /**
     * Get Category list for input in Combo Box
     *
     * @return Collection
     */

    public function getForComboBox(){

        $columns = implode(',',[
           'id',
           'CONCAT (id,". ", title) AS id_title',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Get categories list for paginate input
     *
     * @param int|null $perPage
     */

    public function getAllWithPaginate($perPage = null){
        $columns = ['id','title','parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);
    }

}