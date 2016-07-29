<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    @if(!isset($page))
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @else
    {!! Form::text('name', null, ['class' => 'form-control', 'readOnly'=>true]) !!}
    @endif
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pages.index') !!}" class="btn btn-default">Cancel</a>
</div>
