<!-- Name Field -->
<div class="col-sm-6">
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Category Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('category_id', 'Category Id:') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control','id'=>'category_id']) !!}
    </div>
<!-- Image Field -->
</div>
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    @if(!isset($food))
     <img id="blah" src="{!! URL::to('/img/upload/avatar.jpg') !!}" alt="your image" class="form-control img-thumbnail" style='width:160px;height:150px' />
     @else
     <img id="blah" src='{!! URL::to("/img/food/$food->image") !!}' alt="your image" class="form-control img-thumbnail" style='width:160px;height:150px' />    
    @endif
    {!! Form::file('image', ['onchange'=>"readURL(this)"]) !!}
</div>
<!--<div class="clearfix"></div>-->
<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('foods.index') !!}" class="btn btn-default">Cancel</a>
</div>
