<?php


namespace Modules\Media\Repository;


use App\DesignPatterns\Repository;
use Modules\Media\Entities\media;

class MediaRepository extends Repository
{
    /**
     * @var media
     */
    public $model;

    public function __construct()
    {
        $this->model = new media();
    }

    public function getMediaOfProject ($project_id){
        return media::where ('type','project')
            ->where ('owner_id',$project_id)
            ->get();
    }

    public function getDesignerProposalFile ($proposal_id){
        return media::where ('type','proposal')
            ->where('owner_id',$proposal_id)
            ->get();

    }

}
