<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Http\Service\MediaService;
use Modules\Project\Http\Service\ProjectService;
use Modules\Project\Http\Service\ProposalService;

class ProposalController extends Controller
{
    /**
     * @var ProjectService
     */
    private $projectService;
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var MediaService
     */
    private $mediaService;
    /**
     * @var ProposalService
     */
    private $proposalService;

    public function __construct(
        ProjectService $projectService,
        UserService $userService,
        MediaService $mediaService,
        ProposalService $proposalService
    )
    {
        $this->projectService = $projectService;
        $this->userService = $userService;
        $this->mediaService = $mediaService;
        $this->proposalService = $proposalService;
    }

    public function designer_create_proposal($project_id)
    {
        $project = $this->projectService->getProject($project_id);
        $user = $this->userService->getUserById(auth()->id());
        $active = 2;
        $proposal = $this->proposalService->getProposalForDesigner($project_id, $user->id);
        if ($proposal != null) {
            $files = $this->mediaService->getFilesOfProposalForDesigner($proposal->id);
            return view('customer.proposal', compact('project', 'user', 'active', 'proposal', 'files'));
        }
        return view('customer.proposal', compact('project', 'user', 'active'));
    }

    public function designer_store_proposal(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        unset($data['file']);
        $proposal = $this->proposalService->createProposal($data);
        foreach ($request->file as $key => $result) {
            $image['media_path'] = $this->mediaService->uploadMedia($result);
            $image['type'] = 'proposal';
            $image['owner_id'] = $proposal->id;
            $this->mediaService->createMedia($image);
        }
        return back();
    }

    public function designer_add_file_proposal(Request $request, $proposal_id)
    {
        $image['media_path'] = $this->mediaService->uploadMedia($request->file);
        $image['type'] = 'proposal';
        $image['owner_id'] = $proposal_id;
        $this->mediaService->createMedia($image);
        return back();
    }

    public function designer_proposal (){
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->designerSentProposalProject($user->id);
        $active = 2;
//        dd($user,$projects);
        return view('customer.sent_proposal',compact('active','user','projects'));
    }
}
