<?php


namespace Modules\Project\Http\Service;


use Modules\Project\Repository\WallRepository;

class WallService
{
    /**
     * @var WallRepository
     */
    private $wallRepository;

    public function __construct(
        WallRepository $wallRepository
    )
    {
        $this->wallRepository = $wallRepository;
    }

    public function createWallQuestion ($data){
        return $this->wallRepository->create($data);
    }

    public function getWallOfProject ($project_id){
        return $this->wallRepository->getWallForProject($project_id);
    }

}
