@extends('layouts.admin.master')
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">
                                    New Product
                                </h3>
                            </div>
                            <!--begin::Form-->
                            <form class="form" action="
                                @if(isset($category))
                                    {{url("/admin/categories/$category->id/update")}}
                                    @else
                                    {{url('/admin/categories/store')}}
                                @endif
                                " method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($category))
                                    @method('put')
                                @endif
                                <div class="card-body row">
                                    <div class=" {{isset($category) ? "col-lg-10" : 'col-lg-12'}}">
                                        @include('fragment.error')
                                        <input type="number" name="parent_id" value="{{isset($category) ? $category->parent_id : $parent_id}}" class="d-none">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">Category Title :</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="title" class="form-control" placeholder="Enter category title" value="{{old('title') ?? $category->title  ?? ''}}" required/>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right">Description :</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="description" class="form-control" placeholder="Enter category description" value="{{old('description') ?? $category->description  ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">Picture :</label>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <input type="file" name="file" class="custom-file-input" id="customFile"/>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right">Status :</label>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <select name="status" required class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">Size (m2) :</label>
                                            <div class="col-lg-3">
                                                <input type="number" name="size" class="form-control" placeholder="Enter default size" value="{{old('size') ?? $category->size  ?? ''}}" required/>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right">Price :</label>
                                            <div class="col-lg-3">
                                                <input type="number" name="price" class="form-control" placeholder="Enter price per size" value="{{old('price') ?? $category->price  ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">Commission (%) :</label>
                                            <div class="col-lg-3">
                                                <input type="number" name="commission" class="form-control" placeholder="Enter percentage of commission" value="{{old('size') ?? $category->size  ?? ''}}" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" {{isset($category) ? "col-lg-2" : 'col-lg-0'}}">
                                        <img src="{{$category->image_path ?? ''}}" alt="" class=" w-100">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <a href="{{url('/admin/categories')}}" type="reset" class="btn btn-secondary mr-2">Cancel</a>
                                            <button type="submit" class="btn btn-success ">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card-->

                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

    @endsection
