@extends('layouts.layout')

@section('metadescription') 
    {{$record->title}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('title') {{$record->title}} @endsection

@section('content')

    <div class="page-container d-flex flex-column align-items-center p-2">
            <div class="bg-light shadow-sm d-flex justify-content-center w-90 p-3">
                <div class="col-md-4 d-flex flex-column">
                    <img src="{{$record->picture}}" class="card-img-right" alt="foto-personale" width="70%">
                    <span><strong>{{$record->artist}}</strong></span>
                    <span>{{$record->title}}</span>
                    <span class="text-muted">{{$record->genre->name}}</span>
                    <span class="text-muted">{{$record->year}}</span>
                </div>

                <div class="col-md-8 fs-6">
                    <p><strong>Tracklist: </strong>{!!$record->tracklist!!}</p>
                    <br>
                    <p class="fs-6"><strong>Conditions: </strong><em>{{$record->description}}</em></p>
                    <p class="fs-5 text-danger"><strong>{{$record->price}} &euro;</strong></p>
                </div>

            </div>
        
        <!--Messaggio di successo per aggiunta articolo nel carrello-->
        @if(Session::has('success_message'))
            <div class="alert alert-success">{{ Session::get('success_message') }}</div>
        @endif

        <!--Messaggio di errore-->
        @if(Session::has('error_message'))
            <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
        @endif

        <!--Aggiungi al carrello-->
        <div class="m-4 col-md-4">
            <form action="{{url('add-to-cart')}}" method="post" class="d-flex justify-content-center">
                <input type="hidden" name="record_id" value="{{$record->id}}">
                <div class="col-md-2">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input type="number" name="quantity" value="1" min="1" step="1" class="form-control qty" id="cart-quantity" required>
                </div>
                <div>
                    <input type="submit" class="btn btn-warning" value="Aggiungi al carrello">
                </div>
              </form>
        </div>

           
    </div>
@endsection

