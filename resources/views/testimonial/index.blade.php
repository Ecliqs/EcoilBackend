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
                <h3 class="card-title">Testimonial</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Image</th>
                    <th>Review</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($testimonial as $show)
                  <tr>
                    <th>{{ $loop->index+1 }}</th>
                    <th>{{ $show->name }}</th>
                    <th>{{ $show->company }}</th>
                    <th class="text-center">
                      <img src="{{asset($show->image)}}" class="rounded-circle" width="100" height="100"> 
                    </th>
                    <th>{{ $show->review }}</th>
                    <th class="text-center">
                      @if($show->approved)
                      <a class="btn btn-danger btn-a" data-id="{{$show->id}}" data-a="0">  Decline</a>
                      @else
                      <a class="btn btn-success btn-a" data-id="{{$show->id}}" data-a="1">  Approve</a>
                      @endif
                    </th>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Name</th>
                    <th>Company</th>
                    <th>Image</th>
                    <th>Review</th>
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

@push("js")
<script>
  $(document).ready(function(){
    $(".btn-a").click(function(){
      var id = $(this).attr("data-id");
      var a = $(this).attr("data-a");
      var that = $(this)
      $.ajax({
        url:"{{route('testimonial.approve' )}}",
        method:"POST",
        data:{
          id:id,
          data: a,
          _token:"{{csrf_token()}}"
        },
        success:function(data){
          if(data.status == 1){
            
            that.html("updated")
            if(a == "1")
            {
              that.html("Decline")
              that.removeClass("btn-success");
              that.addClass("btn-danger");
              that.attr("data-a", 0)
            }
            else
            {
              that.html("Approve")
              that.removeClass("btn-danger");
              that.addClass("btn-success");
              that.attr("data-a", 1)
            }
            
          }else{
            console.log("Error",data.message,"error");
          }
        }
      })
    })
  })
</script>
@endpush