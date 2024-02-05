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
                <h3 class="card-title">News Feeds</h3>
                <a class="btn btn-success float-right" href="{{route('newsfeed.create')}}"><i class="fas fa-plus"></i> ADD</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th> Id </th>
                    <th> Title </th>
                    <th> Image </th>
                    <th> Short Description </th>
                    <th> Description </th>
                    <th> Action </th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($newsfeed as $show)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $show->name }}</td>
                    <td class="text-center">
                      <img src="{{ asset($show->image) }}" class="img img-responsive" widtd="100" height="100"> 
                    </td>
                    <td>{{ $show->short_description }}</td>
                    <td>{{ $show->description }}</td>

                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('newsfeed.edit', $show->id)}}"> <i class="fas fa-pen"></i> Edit</a>
                        &nbsp;&nbsp;
                        <a class="btn btn-danger" href="{{route('newsfeed.delete', $show->id)}}"> <i class="fas fa-trash"></i> Remove</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                

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