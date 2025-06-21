
@extends('admin.dashboard')



@section('content')
    <form action="" method="POST">
        <div class="card-body">

                    <div class="form-group">
                        <label for="menu">Title</label>
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control"  >
                    </div>



                    <div class="form-group">
                        <label for="menu">Link</label>
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control"  >
                    </div>






                <div class="form-group">
                    <label for="menu">Sort by</label>
                    <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control"  >
                </div>


            <div class="form-group">
                <label for="menu">Slider Photo</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $slider->thumb }}" target="_blank">
                        <img src="{{ $slider->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" id="thumb" value="{{ $slider->thumb }}">
            </div>

            <div class="form-group">
                <label>Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                           {{ $slider->active ==1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                    {{ $slider->active ==0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Slider</button>
        </div>
        @csrf
    </form>
@endsection



