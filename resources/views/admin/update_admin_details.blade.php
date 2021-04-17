@extends('layouts.admin_layout.admin_layout')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!--Main content-->
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Admin Details</h3>
            </div>
            <!-- /.card-header -->

            @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                  {{Session::get('error_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif

            @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                  {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show mt-3">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif

            <!-- form start -->
            <form method="post" action="{{url('/admin/update-admin-details')}}" name="updatePassword" id="updatePasswordForm" enctype="multipart/form-data"> @csrf
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly="">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Type</label>
                  <input class="form-control" value="{{Auth::guard('admin')->user()->type}}" readonly="">
                </div>

                <div class="form-group">
                  <label for="admin_name">Name</label>
                  <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Enter your name..." value="{{Auth::guard('admin')->user()->name}}">
                </div>


                <div class="form-group">
                  <label for="admin_name">Mobile number</label>
                  <input type="text" class="form-control" name="admin_mobile" id="admin_mobile" placeholder="Enter your mobile number..." value="{{Auth::guard('admin')->user()->mobile}}">
                </div>

                <div class="form-group">
                  <label for="admin_name">Picture</label>
                  <input type="file" class="form-control" name="admin_image" id="admin_image">
                  @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{url('pictures/admin_images/admin_pictures/'.Auth::guard('admin')->user()->image)}}">View current picture</a>
                    <input type="hidden" name="current_admin_image" id="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                  @endif
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /.content-wrapper -->
@endsection