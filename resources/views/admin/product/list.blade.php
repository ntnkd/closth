@extends('admin.dashboard')


@section('content')
    <table class="table table-striped table-bordered table-hover table-checkable" id="sample_1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)

            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                <td>{{ number_format($product->price_sale, 0, ',', '.') }} đ</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/product/edit/{{ $product->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $product->id }}, '{{ url('/admin/product/destroy') }}')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {!! $products->links() !!}
@endsection

