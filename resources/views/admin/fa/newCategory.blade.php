@extends('layouts.admin.fa.master')
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
                                    دسته بندی جدید
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
                                            <label class="col-lg-2 col-form-label text-right">عنوان دسته بندی:</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="title" class="form-control" placeholder="عنوان دسته یندی خود را وارد نمایید" value="{{old('title') ?? $category->title  ?? ''}}" required/>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right">توضیحات:</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="description" class="form-control" placeholder="توضیح دسته بندی خود را وارد نمایید" value="{{old('description') ?? $category->description  ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">تصویر :</label>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <input type="file" name="file" class="custom-file-input" id="customFile"/>
                                                    <label class="custom-file-label" for="customFile">انتخاب کنید</label>
                                                </div>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right">وضعیت :</label>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <select name="status" required class="form-control">
                                                        <option value="">انتخاب کنید :</option>
                                                        <option value="1" selected>فعال</option>
                                                        <option value="0">غیر فعال</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">ابعاد پروژه (مترمربع):</label>
                                            <div class="col-lg-3">
                                                <input type="number" name="size" class="form-control" placeholder="ابعاد پیشفرض را وارد نمایید" value="{{old('size') ?? $category->size  ?? ''}}" required/>
                                            </div>
                                            <label class="col-lg-2 col-form-label text-right">قیمت:</label>
                                            <div class="col-lg-3">
                                                <input type="number" name="price" class="form-control" placeholder="قیمت بر اساس ابعاد پروژه" value="{{old('price') ?? $category->price  ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right">کمیسیون شرکت:</label>
                                            <div class="col-lg-3">
                                                <input type="number" name="commission" class="form-control" placeholder="کمیسیون شرکت را وارد نمایید" value="{{old('size') ?? $category->size  ?? ''}}" required/>
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
                                            <a href="{{url('/admin/categories')}}" type="reset" class="btn btn-secondary mr-2">لغو</a>
                                            <button type="submit" class="btn btn-success ">ذخیره</button>
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
