<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Project\Http\Service\WallService;

class WallController extends Controller
{
    /**
     * @var WallService
     */
    private $wallService;

    public function __construct(
        WallService $wallService
    )
    {
        $this->wallService = $wallService;
    }

    public function designer_store_question (Request $request){
        $data = $request->all();
        $data['user_id']=auth()->id();
        $this->wallService->createWallQuestion ($data);
        return back();
    }
}
