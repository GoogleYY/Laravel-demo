@extends('admin.common')

@section('title', '添加文章')

@section('content')
<div class="col-md-12">
        <div class="card">
    <div class="header clearfix">
        @if(count($errors)>0)
            <h4 class="title pull-left" style="color:#FF4201">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        {{$error}},
                    @endforeach
                @else
                    {{$errors}}
                @endif
            </h4>
        @else
            <h4 class="title pull-left">文章创建</h4>
        @endif
    </div>
    <div class="content">
        <form action="" method="POST" class="row">
            {{ csrf_field() }}
            <div class="form-group col-md-6">
                <label>标题</label>
                <input type="text" name="article_title" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label>作者</label>
                <input type="text" name="article_author" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>分类</label>
                <select class="form-control" name="category_id">
                    @foreach($categorys as $category)
                        <option value="{{ $category->category_id }}">
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label>省</label>
                <select class="form-control" name="province_id">
                    <option value="1">广东省</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>市</label>
                <select class="form-control" name="city_id">
                    <option value="1">深圳市</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>区</label>
                <select class="form-control" name="area_id">
                    <option value="1">南山区</option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label>封面</label>
                <input type="file" id="file_upload" class="form-control">
            </div>
            <div class="form-group col-md-10">
                <label>封面url</label>
                <input type="text" id="image_url" name="article_cover_url" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <img id="image_view" src="" style="max-height: 300px">
            </div>

            <div class="form-group col-md-12">
                <label>内容</label>
                <textarea rows="10" name="article_content" class="form-control"></textarea>
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-info pull-right">提交</button>
            </div>

        </form>
    </div>
</div>
</div>
@endsection