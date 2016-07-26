<table class="table table-responsive" id="example1">
    <thead>
    <th>
        <div class="row">
            <div class="col-md-2">
                <p>Name</p>
            </div>
            <div class="col-md-5">
                {!! Form::open(['route' => ['categories.index'], 'method' => 'get','style'=>'width: 200px']) !!}
                <div class="input-group ">
                    <input type="text" name="search" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </th>
    <th>Image</th>
    <th colspan="3">Action</th>
</thead>
<tbody>
    @foreach($categories as $category)
    <tr>
        <td>{!! $category->name !!}
        </td>
        <td>{!! $category->image !!}</td>
        <td>
            {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('categories.show', [$category->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('categories.edit', [$category->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</tbody>
</table>

<script>
$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
