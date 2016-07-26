@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Category
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <!--{!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'patch','files'=>true]) !!}-->
                {!! Form::open( ['route' => ['categories.update', $category->id],'method' => 'patch' ,'files'=>true]) !!}
                
                <!-- Name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
                </div>

                <!-- Image Field -->
                <div class="form-group col-sm-6">  
                    {!! Form::label('image', 'Image:') !!}
                    <img id="blah" src='{!! URL::to("/img/upload/$category->image") !!}' alt="your image" class="form-control img-thumbnail" style='width:160px;height:150px' />
                    {!! Form::file('image', ['onchange'=>"readURL(this)"]) !!}
                </div>
                <div class="clearfix"></div>

                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('categories.index') !!}" class="btn btn-default">Cancel</a>
                </div>
                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#blah')
                                        .attr('src', e.target.result)
                                        .width(300)
                                        .height(300);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection