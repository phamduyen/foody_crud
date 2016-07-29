<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $food->name !!}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <img id="blah" src='{!! URL::to("/img/food/$food->image") !!}' alt="your image"  style='width:150px;height:150px' class="form-control img-thumbnail" />
    
</div>

<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category', 'Category :') !!}
    <p>{!! $food->category->name !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $food->content !!}</p>
</div>

