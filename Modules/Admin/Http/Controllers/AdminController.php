<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Services\UserService;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\AdminRequest;
use Modules\Category\Http\Services\CategoryService;
use Modules\Order\Http\Services\InvoiceService;
use Modules\Order\Http\Services\OrderService;
use Modules\Project\Http\Service\ProjectService;

class AdminController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ProjectService
     */
    private $projectService;

    public function __construct(
        UserService $userService,
        ProjectService $projectService
    )
    {
        $this->userService = $userService;
        $this->projectService = $projectService;
    }

    public function index()
    {
        $active = 1;
        $user = $this->userService->getUserById(auth()->id());
        return view('admin.fa.dashboard', compact('active','user'));
    }

    public function customer()
    {
        $active = 2;
        $customers = $this->userService->getAllCustomer();
        $user = $this->userService->getUserById(auth()->id());
        return view('admin.fa.users', compact('customers','user','active'));
    }

    public function project()
    {
        $active = 4;
        $projects = $this->projectService->allActiveProject();
        $user = $this->userService->getUserById(auth()->id());
        return view('admin.fa.project', compact('projects','active','user'));
    }

}
