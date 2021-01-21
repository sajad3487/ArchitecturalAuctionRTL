<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\Category\Http\Service\CategoryService;
use Modules\Media\Http\Service\MediaService;
use Modules\Project\Http\Service\ProjectService;
use Modules\Project\Http\Service\ProposalService;
use Modules\Project\Http\Service\WallService;

class ProjectController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var ProjectService
     */
    private $projectService;
    /**
     * @var MediaService
     */
    private $mediaService;
    /**
     * @var ProposalService
     */
    private $proposalService;
    /**
     * @var WallService
     */
    private $wallService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        ProjectService $projectService,
        MediaService $mediaService,
        ProposalService $proposalService,
        WallService $wallService
    )
    {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->projectService = $projectService;
        $this->mediaService = $mediaService;
        $this->proposalService = $proposalService;
        $this->wallService = $wallService;
    }

    public function designer_won_project()
    {
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->designerWonProject($user->id);
        $active = 3;
        return view('customer.you_won', compact('active', 'user','projects'));
    }

    public function designer_view_project($project_id)
    {
        $project = $this->projectService->getProject($project_id);
        $user = $this->userService->getUserById(auth()->id());
        $active = 1;
        $images = $this->mediaService->getImagesOfProject($project->id);
        $proposal = $this->proposalService->getProposalForDesigner($project_id, auth()->id());
        $walls = $this->wallService->getWallOfProject($project_id);
        return view('customer.designer_project', compact('user', 'active', 'project', 'images', 'proposal','walls'));
    }

    public function all_owner_project()
    {
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->getOwnerProject($user->id);
        $active = 4;
        return view('owner.all_project', compact('active', 'user', 'projects'));
    }

    public function owner_new_project()
    {
        $user = $this->userService->getUserById(auth()->id());
        $active = 2;
        $categories = $this->categoryService->getAllCategory();
        return view('owner.new_project', compact('active', 'user', 'categories'));
    }

    public function owner_store_project(Request $request)
    {
        $data = $request->all();
        unset($data['file']);
        $data['owner_id'] = auth()->id();
        $date = Carbon::parse($request->deadline)->timestamp;
        $data['deadline'] = date('Y-m-d H:i:s', $date);
        $data['net_price'] = $this->calculate_net_price($data['category_id'], $data['size']);
        $data['total_price'] = (int)$this->calculate_total_price($data['category_id'], $data['net_price']);
        $project = $this->projectService->createProject($data);
        if (isset($request->file)) {
            $image['media_path'] = $this->mediaService->uploadMedia($request->file);
            $image['type'] = 'project';
            $image['owner_id'] = $project->id;
            $this->mediaService->createMedia($image);
        }

        return redirect("owner/project/" . $project->id . "/invoice");
    }

    public function owner_active_project()
    {
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->getOwnerActiveProject($user->id);
        $active = 3;
        return view('owner.active_project', compact('active', 'user', 'projects'));
    }

    public function view_project_proposal()
    {
        $user = $this->userService->getUserById(auth()->id());
        return view('owner.project_proposal', compact('user'));
    }

    public function view_project_invoice($id)
    {
        $project = $this->projectService->getProject($id);
        $user = $this->userService->getUserById(auth()->id());
        return view('owner.invoice', compact('project', 'user'));
    }

    public function calculate_net_price($category_id, $size)
    {
        $category = $this->categoryService->getCategoryById($category_id);
        $q = (int)round($size / ($category->size));
        return $q * $category->price;
    }

    public function calculate_total_price($category_id, $net_price)
    {
        $category = $this->categoryService->getCategoryById($category_id);
        return $net_price * (1 + ($category->commission / 100));
    }

    public function owner_pay_project($project_id)
    {
        $this->projectService->changeStatus($project_id, 2);
        return redirect('owner/project/' . $project_id . '/view');
    }

    public function owner_view_project($id)
    {
        $user = $this->userService->getUserById(auth()->id());
        $project = $this->projectService->getProject($id);
        $active = 4;
        $images = $this->mediaService->getImagesOfProject($project->id);
        $proposals = $this->proposalService->getAllProposalsOfProject($project->id);
        $walls = $this->wallService->getWallOfProject($id);
        return view('owner.owner_project', compact('active', 'user', 'project', 'images','proposals','walls'));
    }

    public function owner_edit_project($id)
    {
        $project = $this->projectService->getProject($id);
        $user = $this->userService->getUserById(auth()->id());
        $active = 3;
        $categories = $this->categoryService->getAllCategory();
        return view('owner.new_project', compact('active', 'user', 'categories', 'project'));
    }

    public function owner_update_project(Request $request, $id)
    {
        if (isset($request->file)) {
            $image['media_path'] = $this->mediaService->uploadMedia($request->file);
            $image['type'] = 'project';
            $image['owner_id'] = $id;
            $this->mediaService->createMedia($image);
        }
        $data = $request->all();
        unset($data['file']);
        $date = Carbon::parse($request->deadline)->timestamp;
        $data['deadline'] = date('Y-m-d H:i:s', $date);
        if (isset($data['country']) && $data['country'] == null) {
            unset($data['country']);
        }
        $this->projectService->updateOwnerProject($data, $id);
        return redirect("owner/project/" . $id . "/view");
    }

    public function owner_make_winner (Request $request,$project_id){
        $data=$request->all();
        $this->projectService->updateOwnerProject($data,$project_id);
        return back();
    }

    public function searchDesignerProject (Request $request) {
        $data = $request->search;
        $projects = $this->projectService->searchDesigner($data);
        $user = $this->userService->getUserById(auth()->id());
        $active = 1;
        return view('customer.index',compact('active','user','projects'));
    }

    public function searchOwnerProject (Request $request){
        $data = $request->search;
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->searchOwner($data,$user->id);
        $active = 1;
        return view('owner.index',compact('active','user','projects'));
    }

    public function designer_category ($category_id){
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->getProjectOfCategory($category_id);
        $categories = $this->categoryService->getAllCategory();
        $active = 1;
        return view('customer.index',compact('user','projects','categories','active'));
    }

    public function owner_category ($category_id){
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->getOwnerCategoryProject($category_id,$user->id);
        $categories = $this->categoryService->getAllCategory();
        $active = 1;
        return view('owner.index',compact('user','projects','categories','active'));
    }
}
