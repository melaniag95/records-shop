@extends('layouts.admin_layout.admin_layout')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8 w-100 mx-auto">
            <h1 class="m-3 text-center">{{$record->title}} - {{$record->artist}}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="p-4 mb-4 text-white rounded bg-dark">
          <div class="col-md-10 px-0">
              <p class="text-secondary">Data insert: {{ date('d-m-Y', strtotime($record->created_at)) }}</p>
              
              
              <div class="d-flex">
                <!--Foto articolo-->
                <div class="col-md-6 m-2">
                    @if($record->picture !== '')
                        <img src="{{$record->picture}}" alt="foto-articolo" class="w-100">
                    @endif
                </div>

                <div class="col-md-6 text-light text-light">
                  <h5>Tracklist</h5>
                  {!!$record->tracklist!!}
                </div>
              </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection