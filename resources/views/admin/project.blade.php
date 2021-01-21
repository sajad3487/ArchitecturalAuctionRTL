@extends('layouts.admin.master')

@section('content')


    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Notice-->

                <!--end::Notice-->

                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Projects
                                <span class="d-block text-muted pt-2 font-size-sm">This page shows Projects info</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="overflow-auto">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Deadline</th>
                                    <th>Project image</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($projects as $project)
                                <tr>
                                    <td>{{$project->id ?? ''}}</td>
                                    <td>{{$project->title ?? ''}}</td>
                                    <td>{{$project->description ?? ''}}</td>
                                    <td>{{$project->category->title ?? ''}}</td>
                                    <td>{{$project->deadline ?? ''}}</td>
                                    <td>
    {{--                                    {{$project->profile_picture}}--}}
                                        @foreach($project->project_image as $key=>$image)
                                        <div class="image-input image-input-outline"  id="kt_image_{{$key}}">
                                            <a href="{{asset($image->media_path)}}" target="_blank"><div class="image-input-wrapper" style="background-image: url({{asset($image->media_path)}}); width: 50px;height: 50px"></div></a>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                        </div>
                                            @endforeach
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>

                            </table>
                            <!--end: Datatable-->
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->


@endsection



