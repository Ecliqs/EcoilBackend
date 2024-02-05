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
                <h3 class="card-title">Edit News Feed</h3>
                <a class="btn btn-danger float-right" href="{{route('newsfeed.index')}}"><i class='fas fa-angle-left'></i> Cancel</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                
                <div class="row justify-content-around">
                  <div class="col-lg-7">
                      <form action="{{route('newsfeed.update', $newsfeed->id)}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                              <label class="form-label">News Feeds Title</label>
                                  <input type="text" class="form-control" name="name" value="{{ old('name', $newsfeed->name) }}" placeholder="Enter Title">
                                  @error('name')
                                  <div class="text-danger">{{$message}}</div>
                                  @enderror
                          </div>
                          <div class="form-group">
                              <label class="form-label">News Feeds Short Description</label>
                                  <input type="text" class="form-control" placeholder="Enter Short Description" name="s_description" value="{{ old('s_description', $newsfeed->s_description) }}">
                                  @error('s_description')
                                  <div class="text-danger">{{$message}}</div>
                                  @enderror
                          </div>
                          <!-- <div class="form-group">
                              <label class="form-label">News Feeds Image</label>
                                  <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                  @error('image')
                                  <div class="text-danger">{{$message}}</div>
                                  @enderror
                          </div> -->
                          <div class="form-group">

                            <textarea id="editor" cols="30" rows="10" name="description" placeholder="Enter Description"> {{ old('description', $newsfeed->description) }}</textarea>
                            @error('description')
                              <div class="text-danger">{{$message}}</div>
                            @enderror
                          </div>
                          <button class="btn btn-success w-100" type="submit" > <i class="fas fa-paper-plane"></i>  Submit </button>
                      </form>
                  </div>
                  <div class="col-lg-4">

                    <form class="form-horizontal" action="" method="post" id="logo_upload_form" enctype="multipart/form-data">
                      <img src="{{ url($newsfeed->image) }}" class="p-3" id="preview_image" width="100%" height="auto">
                      
                      <input type="file" class="form-control" name="logo" id="logo">

                      <button class="btn btn-success mt-5 w-100" type="submit" ><i class="fas fa-file-upload"></i> Update</button>
                      
                      <div id="image_upload_success" class="alert alert-success mt-3" style="display: none" role="alert">
                        Image Uploaded successfully.
                      </div>

                      <div id="image_upload_unsuccessfull" class="alert alert-danger mt-3" style="display: none" role="alert">
                        Image cloud not be uploaded.
                      </div>
                    </form>

                  </div>
                </div>
                    
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
  <script>
     {/* Show Selected Image Function */} 

     $(document).ready(function() {
            // When the file input changes
            $('#logo').change(function(e) {
                var file = e.target.files[0];

                // Check if the selected file is an image
                if (file && file.type.match('image.*')) {
                    var reader = new FileReader();

                    // Set up the reader to load the image
                    reader.onload = function(e) {
                        $('#preview_image').attr('src', e.target.result);
                    }

                    // Read the image file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        });

     {/* Show Selected Image Function */}

     $(document).ready(function() {
            // Intercept the form submission
            $('#logo_upload_form').submit(function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                var formData = new FormData();
                var fileInput = $('#logo')[0].files[0]; // Get the selected file
                var csrfToken = "{{ csrf_token() }}";
                var id = "{{$newsfeed->id}}"

                formData.append('logo', fileInput); // Add the file to the form data
                formData.append('id', id); //

                $.ajax({
                    url: "{{ route('newsfeed.imgupdate') }}", // Replace 'upload.php' with the URL to your server-side script
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    },
                    success: function(response) {
                        $("#image_upload_success").show()
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        $("#image_upload_unsuccess").show()
                        console.log(error);
                    }
                });
            });
        });
       
  </script>

@endsection