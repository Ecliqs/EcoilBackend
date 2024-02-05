@extends('layouts.app')
@section('content') 

<div class="content-wrapper">
<!-- Main content -->
    <section class="content">
      @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
          <strong>{{ $message }}</strong>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add News Feed</h3>
                <a class="btn btn-danger float-right" href="{{route('newsfeed.index')}}"><i class='fas fa-angle-left'></i> Cancel</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                    <form action="{{route('newsfeed.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">News Feeds Title</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Title">
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">News Feeds Short Description</label>
                                <input type="text" class="form-control" placeholder="Enter Short Description" name="s_description" value="{{ old('s_description') }}">
                                @error('s_description')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">News Feeds Image</label>
                                <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                @error('image')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="form-group">

                          <textarea id="editor" cols="30" rows="10" name="description" placeholder="Enter Description"> {{ old('description') }}</textarea>
                          @error('description')
                            <div class="text-danger">{{$message}}</div>
                          @enderror
                        </div>
                        <button class="btn btn-success w-100" type="submit" > <i class="fas fa-paper-plane"></i>  Submit </button>
                    </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection