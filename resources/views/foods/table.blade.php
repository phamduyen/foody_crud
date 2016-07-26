<table class="table table-responsive" id="table_id">
    <thead>
    <th  style="width: 300px">
        <div class="row">
            <div class="col-xs-2">
               Name
            </div>
            <div class="col-xs-5">
                <div class="input-group ">
                    {!! Form::text('name',null, ['class' => 'form-control search-value','placeholder'=>"Search..."]) !!}
                    <!--<input type="text" name="name"   class="form-control search-value" placeholder="Search..."/>-->
                </div>
            </div>

        </div>
    </th>
    <th >
        <p class="tile_table">Image</p></th>
    <th style="width: 300px">
        <div class="row">
            <div class="col-xs-3">
                Category
            </div>
            <div class="col-xs-5">
                <div class="input-group ">
                     {!! Form::select('category_id', $categories, null, ['class' => 'form-control search-value' , 'id'=>'category_id','placeholder'=>"All"]) !!}
                    <!--<input type="text" name="category" class="form-control" placeholder="Search..."/>-->
                </div>
            </div>
        </div>
    </th>
    <th><p class="tile_table">Content</p></th>
    <th colspan="3">
        <div class="row">
            <div class="col-xs-4">
                Action
            </div>
            <div class="col-xs-5">
                <span class="input-group-btn">
                    {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-success','onclick'=>"search('".URL::to('/foods')."')"]) !!}    
                </span>
            </div>
    </th>

</thead>
<tbody>
    @foreach($foods as $food)
    <tr>
        <td>{!! $food->name !!}</td>
        <td>
            <img id="blah" src='{!! URL::to("/img/food/$food->image") !!}' alt="your image"  style='width:50px;height:50px' />
        </td>
        <td>{!! $food->category->name !!}</td>
        <td>{!! $food->content !!}</td>
        <td>
            {!! Form::open(['route' => ['foods.destroy', $food->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('foods.show', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('foods.edit', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</tbody>
</table>
