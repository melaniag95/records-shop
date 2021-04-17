@extends('layouts.admin_layout.admin_layout')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8 w-100 mx-auto">
            <h1 class="m-3 text-center">Edit Record</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        @if(count($errors->all()) > 0)
            <div class="alert alert-danger">
                <h4>Attenzione:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="?" method='post' enctype="multipart/form-data" class="m-4 bg-light text-secondary rounded col-md-8 mx-auto pt-4">
            <div class="col-md-10 d-flex flex-column align-items-center mx-auto">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <div class="col-md-12 mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $record->title }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="artist">Artist</label>
                        <input type="text" class="form-control" id="artist" name="artist" value="{{ $record->artist }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" name="year" value="{{ $record->year }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="genre_id">Genre</label>
                        <select class="form-control" name="genre_id" id="genre_id">
                            @foreach($genres as $genre)
                                @if($genre->id == $record->genre_id)
                                    <option selected value="{{$genre->id}}">{{$genre->name}}</option>
                                @else
                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @endif
                        @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $record->price }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description">Condition</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $record->description }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="descrizione">Tracklist</label>
                        <textarea class="form-control" name="tracklist" id="tracklist" rows="5">{{ $record->tracklist }}</textarea>
                    </div>
           

                    <div class="col-md-12 mb-3">
                        <label for="data_insert">Updated at</label>
                        <input type="date" class="form-control" id="updated_at" name="updated_at" value="{{ $record->updated_at }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="picture"></label>
                        <input type="file" class="form-control" name="picture" id="picture" value="{{ $record->picture }}">

                        @if(!empty($record->picture))
                            <div class="mt-2"><a target="_blank" href="{{url($record->picture)}}">View current picture</a></div>
                        @endif
                    </div>

                <div class="d-grid gap-2 col-4 mx-auto mb-4">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </form>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection