@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ URL::to('/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content')
<section class="content-header">
    <h1 class="pull-left">Users</h1>
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}">Add New</a>
    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-responsive" id="table_id">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>role</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::to('/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::to('/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
$(function () {
    $('#table_id').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('getUser') !!}'
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action'}
        ]
    });
});
</script>
@endsection

