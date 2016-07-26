<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    @if(!isset($user))
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    @else
        {!! Form::email('email', null, ['class' => 'form-control','readOnly'=>true]) !!}
    @endif
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
     @if(!isset($user))
     <img id="blah" src="{!! URL::to('/img/avatar/avatar.jpg') !!}" alt="your image" class="form-control img-thumbnail" style='width:160px;height:150px' />
     @else
     <img id="blah" src='{!! URL::to("/img/avatar/$user->image") !!}' alt="your image" class="form-control img-thumbnail" style='width:160px;height:150px' />    
    @endif
    {!! Form::file('image',['onchange'=>"readURL(this)"]) !!}
</div>
<div class="clearfix"></div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
    <!--{!! Form::number('role', null, ['class' => 'form-control']) !!}-->
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
