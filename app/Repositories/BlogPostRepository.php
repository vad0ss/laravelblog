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
use Illuminate\Pagination\LengthAwarePaginator;


class BlogPostRepository extends CoreRepository
{
    /*
    * @return string
    */

    protected function getModelClass(){
        return Model::class;
    }

    /**
     * Get posts list for input list (Admin)
     *
     * @return LengthAwarePaginator
     */

    public function getAllWithPaginate(){

        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            ->with([
                'category' => function($query) {
                   $query->select(['id','title']);
                },
                'user:id,name',
            ])
            ->paginate(25);

        return $result;
    }

}