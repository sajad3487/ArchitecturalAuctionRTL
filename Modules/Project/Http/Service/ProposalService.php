<?php


namespace Modules\Project\Http\Service;


use Modules\Project\Repository\ProposalRepository;

class ProposalService
{
    /**
     * @var ProposalRepository
     */
    private $proposalRepository;

    public function __construct(
        ProposalRepository $proposalRepository
    )
    {
        $this->proposalRepository = $proposalRepository;
    }

    public function createProposal($data)
    {
        return $this->proposalRepository->create($data);
    }

    public function getProposalForDesigner($project_id, $user_id)
    {
        return $this->proposalRepository->getDesignerProposal($project_id, $user_id);
    }

    public function getAllProposalOfDesigner ($user_id){
        return $this->proposalRepository->getAllDesignerProposal ($user_id);
    }

    public function getAllProposalsOfProject ($project_id){
        return $this->proposalRepository->getProposalsOfProject ($project_id);
    }

}
