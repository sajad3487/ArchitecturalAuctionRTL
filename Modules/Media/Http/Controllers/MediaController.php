<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Http\Service\MediaService;

class MediaController extends Controller
{
    /**
     * @var MediaService
     */
    private $mediaService;

    public function __construct(
        MediaService $mediaService
    )
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        return view('media::index');
    }


    public function create()
    {
        return view('media::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('media::show');
    }

    public function edit($id)
    {
        return view('media::edit');
    }



    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $this->mediaService->deleteMedia ($id);
        return back();
    }

    public function ownerUploadImageProject (Request $request,$project_id){
        if (isset($request->file)){
            $data['media_path'] =$this->mediaService->uploadMedia($request->file);
        }
        $data['type'] = 'project';
        $data['owner_id'] = $project_id;
        $this->mediaService->createMedia($data);
        return back();
    }
}
