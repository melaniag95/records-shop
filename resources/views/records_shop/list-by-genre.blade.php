@extends('layouts.layout')

@section('metadescription') 
    Catalogo completo di Records Shop
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('title') Genre @endsection

@section('content')
    <main class="page-container">
        <div class="container">
            <div class="row d-flex justify-content-center">
                @foreach ($genre_records as $record)
                <div class="col-md-6 mt-4">
                    <div class="record-card-container bg-light row g-0 border border-secondary rounded flex-md-row mb-4 shadow-sm position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-warning">{{$record->genre->name}}</strong>
                            <h4 class="mb-0">{{$record->title}}</h4>
                            <h5 class="text-secondary">{{$record->artist}}</h5>
                            <div class="mb-1 text-muted">{{$record->year}}</div>
                            <p class="text-dark fst-italic">{{$record->price}} &euro;</p>
                            <a href="/dettaglio/{{$record->id}}" class="hvr-ripple-out btn btn-warning mt-4">Dettaglio</a>
                        </div>

                        <div class="col-auto d-none d-lg-block">
                            <img class="bd-placeholder-img" width="250" height="250" src="{{$record->picture}}">
                        </div>

                        <!--Add Cart & Favourites-->
                        <!-- <div class="cart-container mb-3">
                            <a href="#" class="text-decoration-none text-danger" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                </svg>
                            </a>
                            
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </div> -->

                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection