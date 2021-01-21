<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Http\Service\CategoryService;
use Modules\Media\Http\Service\MediaService;


class AdminCategoryController extends Controller
{
    /**
     * @var UserService
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
        UserService $userService,
        MediaService $mediaService,
        CategoryService $categoryService

    )
    {
        $this->userService = $userService;
        $this->mediaService = $mediaService;
        $this->categoryService =$categoryService;
    }

    public function index()
    {
        $categories =$this->categoryService->getAllCategory();
        $user = $this->userService->getUserById(auth()->id());
        $active = 3;

        return view('admin.categories',compact('active','user','categories'));
    }

    public function create()
    {
        $parent_id = 0;
        $user = $this->userService->getUserById(auth()->id());
        $active = 3;
        return view('admin.newCategory',compact('active','user','parent_id'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['file']);
        if (isset($request->file)){
            $data['image_path'] =$this->mediaService->uploadMedia($request->file);
        }
        $this->categoryService->createCategory($data);
        return redirect('/admin/categories');
    }


    public function show($id)
    {
        return view('admin::show');
    }


    public function edit($id)
    {
        $user = $this->userService->getUserById(auth()->id());
        $category = $this->categoryService->getCategoryById($id);
        $active = 3;
        return view('admin.newCategory',compact('user','category','active'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['file']);
        if (isset($request->file)){
            $data['image_path'] =$this->mediaService->uploadMedia($request->file);
        }
        $this->categoryService->updateCategory($data,$id);
        return redirect('/admin/categories');
    }


    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return back();
    }

    public function subCategory ($id){
        $parent_id = $id;
        $user = $this->userService->getUserById(auth()->id());
        $active = 3;
        return view('admin.newCategory',compact('active','user','parent_id'));
    }
}
