<?php
/**
 * Created by PhpStorm.
 * User: grwes
 * Date: 4/3/2020
 * Time: 8:07 PM
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;


abstract class CoreRepository
{

    /*
     *  @var Model
     */

    protected $model;

    public function __construct() {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions(){
        return clone $this->model;
    }

}