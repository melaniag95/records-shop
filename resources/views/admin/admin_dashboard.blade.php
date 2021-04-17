@extends('layouts.admin_layout.admin_layout')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

         <!--Messaggio di successo per aggiunta/modifica articolo-->
          @if(Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
          @endif


        <div>
          <table class="table table-bordered table-hover">
              <thead>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Artist</th>
                  <th colspan="2">Price</th>
              </thead>
              <tbody>
                  @foreach ($records as $record)
                      <tr>
                          <td>{{$record->id}}</td>
                          <td>{{$record->title}}</td>
                          <td>{{$record->artist}}</td>
                          <td>{{$record->price}}</td>
                          <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="/admin/record-detail/{{$record->id}}">Detail</a>
                                  <a class="dropdown-item" href="/admin/record-edit/{{$record->id}}">Edit</a>
                                  <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this record?')" href="/admin/delete/{{$record->id}}">Delete</a>
                                </div>
                            </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="mx-auto">
              {{$records->links()}}
          </div>
          
          <div class="container d-flex justify-content-end">
              <a href="/admin/add" class="d-block btn btn-primary">Add record</a>
          </div>
      </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection