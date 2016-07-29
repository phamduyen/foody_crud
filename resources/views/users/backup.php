<table class="table table-responsive" id="table_id">
    <thead>
    <th style="width: 300px">
        <div class="row">
            <div class="col-xs-2">
                Name
            </div>
<!--            <div class="col-xs-5">
                <div class="input-group ">
                    {!! Form::text('name',null, ['class' => 'form-control search-value','placeholder'=>"Search..."]) !!}
                    <input type="text" name="name"   class="form-control search-value" placeholder="Search..."/>
                </div>
            </div>-->

        </div>
    </th>
    <th style="width: 300px">
        <div class="row">
            <div class="col-xs-2">
                Email
            </div>
<!--            <div class="col-xs-5">
                <div class="input-group ">
                    {!! Form::text('email',null, ['class' => 'form-control search-value','placeholder'=>"Search..."]) !!}
                    <input type="text" name="name"   class="form-control search-value" placeholder="Search..."/>
                </div>
            </div>-->

        </div>
    </th>
   
<th style="width: 200px">
    <div class="row">
        <div class="col-xs-3">
            Role
        </div>
<!--        <div class="col-xs-7">
            <div class="input-group ">
                {!! Form::select('role', $roles, null, ['class' => 'form-control search-value' ,'placeholder'=>"All"]) !!}
               <input type="text" name="category" class="form-control" placeholder="Search..."/>
            </div>
        </div>-->
    </div>
</th>
<th >
    <div class="row">
        <div class="col-xs-3">
            Action
        </div>
<!--        <div class="col-xs-4">
            <span class="input-group-btn">
                {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-success','onclick'=>"search('".URL::to('/users')."')"]) !!}    
            </span>
        </div>-->
</th>
</thead>
<!--<tbody>
    @foreach($users as $user)
    <tr>
        <td>{!! $user->name !!}</td>
        <td>{!! $user->email !!}</td>
        
        <td>{!! $user->roles->title !!}</td>
        <td>
            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</tbody>-->
</table>
