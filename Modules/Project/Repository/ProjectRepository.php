<?php


namespace Modules\Project\Repository;


use App\DesignPatterns\Repository;
use Modules\Product\Entities\product;
use Modules\Project\Entities\Project;

class ProjectRepository extends Repository
{
    /**
     * @var Project
     */
    public $model;

    public function __construct()
    {
        $this->model = new Project();
    }

    public function getProjectById ($id){
        return Project::where('id',$id)
            ->with('owner')
            ->with('designer')
            ->with('category')
            ->first();
    }

    public function changeProjectStatus ($id,$status){
        return Project::where('id',$id)
            ->update(['status'=>$status]);
    }

    public function getallOwenerActiveProject ($owner_id){
        return Project::where ('owner_id',$owner_id)
            ->where('status',2)
            ->with('project_image')
            ->get();
    }

    public function getAllOwnerProject ($owner_id){
        return Project::where ('owner_id',$owner_id)
            ->with('project_image')
            ->get();
    }

    public function getAllActiveProject (){
        return Project::where('status',2)
            ->where('deadline','>',now())
            ->with('project_image')
            ->with('category')
            ->get();
    }

    public function getDesignerWonProject ($designer_id){
        return project::where('designer_id',$designer_id)
            ->with('category')
            ->get();
    }

    public function searchDesignerProject ($data){
        return project::where('title','like',"%{$data}%")
            ->where('status',2)
            ->get();
    }

    public function searchOwnerProject ($data,$user_id){
        return project::where('title','like',"%{$data}%")
            ->where('owner_id',$user_id)
            ->get();
    }

    public function getAllProjectsOfCategory ($category_id){
        return project::where('category_id',$category_id)
            ->where('status',2)
            ->with('category')
            ->get();
    }

    public function getAllOwnerCategoryProject ($category_id,$user_id){
        return project::where('owner_id',$user_id)
            ->where('category_id',$category_id)
            ->with('category')
            ->get();
    }

}
