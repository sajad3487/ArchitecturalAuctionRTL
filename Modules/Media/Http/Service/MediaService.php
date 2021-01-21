<?php


namespace Modules\Media\Http\Service;


use Modules\Media\Repository\MediaRepository;

class MediaService
{
    /**
     * @var MediaRepository
     */
    private $mediaRepository;

    public function __construct(
        MediaRepository $mediaRepository
    )
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function uploadMedia ($file) {
        $destination = base_path() . '/public/image/';
        $filename = rand(1111111, 99999999);
        $newFileName = $filename . $file->getClientOriginalName();
        $file->move($destination, $newFileName);
        return '/image/' . $newFileName;
    }

    public function createMedia ($data){
        return $this->mediaRepository->create($data);
    }

    public function getImagesOfProject ($project_id){
        return $this->mediaRepository->getMediaOfProject ($project_id);
    }

    public function deleteMedia ($id){
        return $this->mediaRepository->delete($id);
    }

    public function getFilesOfProposalForDesigner ($proposal_id){
        return $this->mediaRepository->getDesignerProposalFile ($proposal_id);
    }

}
