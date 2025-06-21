@extends('admin.dashboard')


@section('content')
    <table class="table table-striped table-bordered table-hover table-checkable" id="sample_1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::categories($categories) !!}
        </tbody>
    </table>
@endsection

