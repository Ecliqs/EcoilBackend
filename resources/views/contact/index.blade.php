@extends('layouts.app')
@section('content') 

<div class="content-wrapper">
<!-- Main content -->
    <section class="content">
    @if( count($contacts) <= 0)
        <div class="alert alert-success" role="alert">
          <strong> No Contact Form Submitted Yet. </strong>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Contacts Form Submitted </h3>
                {{-- <a class="btn btn-success float-right" href="{{route('newsfeed.create')}}"><i class="fas fa-plus"></i> ADD</a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th> Id </th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Phone </th>
                    <th> Service </th>
                    <th> Message </th>
                    <th> Address </th>
                    <th> City </th>
                    <th> State </th>
                    <th> Date </th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->service }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->address }}</td>
                            <td>{{ $contact->city }}</td>
                            <td>{{ $contact->state }}</td>
                            <td>{{ Carbon::parse($contact->created_at)->format("d-M-Y") }}</td>
                        </tr>
                        
                    @endforeach
                   
                  <tfoot>
                  <tr>
                    <th> Id </th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Phone </th>
                    <th> Service </th>
                    <th> Message </th>
                    <th> Address </th>
                    <th> City </th>
                    <th> State </th>
                    <th> Date </th>
                  </tr>
                  </tfoot>
                </table>

                <div>
                    {!! $contacts->links()  !!}
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

@endsection