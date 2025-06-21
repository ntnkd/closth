@extends('admin.dashboard')

@section('head')
    <script src="/ckeditor/ckeditor.js"> </script>
@endsection

@section('content')
<form action="" method="POST">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card-body">

      <div class="form-group">
        <label for="category">Category Name</label>
        <input type="text" class="form-control" value="{{ $category->name }}" id="name" name="name" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label >Category Parent</label>
        <select class="form-control" name="parent_id" >
          <option value="0" {{$category->parent_id == 0 ? 'selected' : ''}}></option>
          @foreach ($categories as $categoryParent )
            <option value="{{ $categoryParent->id }}"
                {{ $category->parent_id == $category->parent_id ? 'selected' : ''}}>
                {{ $categoryParent->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label >Decription</label>
        <textarea  class="form-control"  name="description">{{ $category->description }}</textarea>
      </div>

      <div class="form-group">
        <label >Content</label>
        <textarea  class="form-control" id="content" name="content" >{{ $category->content }}</textarea>
      </div>


      <div class="form-group">
        <label >Active</label>
        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{ $category->active == 1 ? 'checked' : ''}}>
            <label for="active" class="custom-control-label">Yes</label>
        </div>

        <div class="custom-control custom-radio">
            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{ $category->active == 0 ? 'checked' : ''}}>
            <label for="no_active" class="custom-control-label">No</label>
        </div>

      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Update Category</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
  <script>
    CKEDITOR.replace( 'content' );
  </script>
@endsection
