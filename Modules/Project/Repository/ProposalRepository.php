<?php


namespace Modules\Project\Repository;


use App\DesignPatterns\Repository;
use Modules\Project\Entities\project;
use Modules\Project\Entities\proposal;

class ProposalRepository extends Repository
{
    /**
     * @var proposal
     */
    public $model;

    public function __construct()
    {
        $this->model = new proposal();
    }

    public function getDesignerProposal($project_id, $user_id)
    {
        return proposal::where('project_id', $project_id)
            ->where('user_id', $user_id)
            ->first();
    }

    public function getAllDesignerProposal ($user_id){
        return proposal::where('user_id',$user_id)
            ->get();
    }

    public function getProposalsOfProject ($project_id){
        return proposal::where('project_id',$project_id)
            ->with('proposal_file')
            ->get();
    }


}
