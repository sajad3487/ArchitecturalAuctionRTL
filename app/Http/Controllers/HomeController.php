<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Modules\Category\Http\Service\CategoryService;
use Modules\Media\Http\Service\MediaService;
use Modules\Project\Http\Service\ProjectService;

class HomeController extends Controller
{
    /**
     * @var ProjectService
     */
    private $projectService;
    /**
     * @var ProjectService
     */
    private $userService;
    /**
     * @var MediaService
     */
    private $mediaService;
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(
        ProjectService $projectService,
        UserService $userService,
        MediaService $mediaService,
        CategoryService $categoryService
    )
    {
        $this->middleware('auth');
        $this->projectService = $projectService;
        $this->userService = $userService;
        $this->mediaService = $mediaService;
        $this->categoryService = $categoryService;
    }

    public function index(){
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function designer_index()
    {
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->allActiveProject();
        $active = 1;
        $categories = $this->categoryService->getAllCategory();
        return view('customer.index',compact('active','user','projects','categories'));
    }

    public function designer_profile (){
        $user = auth()->user();
        $active = 4;
        return view('customer.profile',compact('user','active'));
    }

    public function owner_index (){
        $user = $this->userService->getUserById(auth()->id());
        $projects = $this->projectService->getOwnerActiveProject ($user->id);
        $active = 1;
        $categories = $this->categoryService->getAllCategory();
        return view('owner.index',compact('active','user','projects','categories'));
    }

    public function owner_profile (){
        $user = auth()->user();
        $active = 5;
        return view('owner.profile',compact('user','active'));
    }

    public function updateProfile (Request $request){
        $data = $request->all();
        $user_id = auth()->id();
        unset($data['file']);
        if (isset($request->file)){
            $data['profile_picture'] = $this->mediaService->uploadMedia($request->file);
        }
        $this->userService->updateUser($data,$user_id);
        return back();
    }


}
