@extends('admin.dashboard')


@section('content')
    <table class="table table-striped table-bordered table-hover table-checkable" id="sample_1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Link</th>
                <th>Thumb</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliderList as $key => $slider)

            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url}}</td>
                <td><a href="{{ $slider->thumb}}" target="_blank"><img src="{{ $slider->thumb}}" height="100px"></a></td>
                <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{ $slider->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/slider/edit/{{ $slider->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $slider->id }}, '{{ url('/admin/slider/destroy') }}')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{-- <pre>{{ get_class($sliders) }}</pre> --}}
    {!! $sliderList->links() !!}
@endsection

