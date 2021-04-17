@extends('layouts.layout')

@section('metadescription') 
    Home page Records Shop, specializzato nella vendita di dischi nuovi ed usati
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/animations.css')}}">


@endsection

@section('title') Home page @endsection

@section('content')
    <div class="bg-warning cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main class="px-auto container">
            <div class="p-4 mt-4 text-center">
                <h1 class="main-title">Records Shop</h1>
                <p class="lead">Clicca qui sotto per scoprire la nostra collezione di dischi. <br> Più di 500 vinili nuovi e usati</p>
                <p class="lead">
                    <a href="/records" class="btn btn-lg btn-secondary fw-bold border-white bg-white text-dark mb-3 hvr-float-shadow">Scopri di più</a>
                    <br>
                </p>
            </div>
        </main>
    </div>

    <main class="container">

        <div class="recommendations m-4">
            <h3 class="m-3 text-center">I nostri consigli</h3>
            <hr>
            <div class="items-container">

                @foreach($records as $record)
                    <div class="hvr-float-shadow text-center record-container card item m-3">
                        <a href="/dettaglio/{{$record->id}}" class="item-link text-decoration-none text-dark">
                            <img src="{{$record->picture}}" class="card-img-top" alt={{$record->title}}>

                            <div class="card-body">
                                <h5 class="card-title">{{$record->artist}} - {{$record->title}}</h5>
                                <p class="card-text text-secondary">{{$record->description}}, {{$record->year}}</p>
                            </div>
                        </a>
                        <div class="text-danger mb-3">&euro; {{$record->price}}</div>
                    </div>
                @endforeach
            </div>

            <hr>

        </div>

        <div class="m-3 text-center top-artists">
            <h3>Top Artists</h3>
            <hr>
            <div class="top-artists-container">
                <a href="" class="m-3 link-dark">MF DOOM</a>
                <a href="" class="m-3 link-dark">Kendrick Lamar</a>
                <a href="" class="m-3 link-dark">Westside Gunn</a>
                <a href="" class="m-3 link-dark">Bishop Nehru</a>
                <a href="" class="m-3 link-dark">Benny the Butcher</a>
                <a href="" class="m-3 link-dark">Che Noir</a>
                <a href="" class="m-3 link-dark">Estee Neck</a>
                <a href="" class="m-3 link-dark">Masta Ace</a>
                <a href="" class="m-3 link-dark">Method Man</a>
                <a href="" class="m-3 link-dark">Pharoahe Monch</a>
                <a href="" class="m-3 link-dark">Rapsody</a>
                <a href="" class="m-3 link-dark">Rome Streetz</a>
                <a href="" class="m-3 link-dark">The Four Owls</a>
                

            </div>
            <hr>
        </div>



    </main>
    
@endsection