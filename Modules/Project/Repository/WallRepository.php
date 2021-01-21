<?php


namespace Modules\Project\Repository;


use App\DesignPatterns\Repository;
use Modules\Project\Entities\wall;

class WallRepository extends Repository
{
    /**
     * @var wall
     */
    public $model;

    public function __construct()
    {
        $this->model = new wall();
    }

    public function getWallForProject ($project_id){
        return wall::where('project_id',$project_id)
            ->where('parent_id',0)
            ->with('answer')
            ->with('user')
            ->get();
    }

}
