@extends('layouts.layout')

@section('metadescription') 
    Carrello 
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/animations.css')}}">
@endsection

@section('title') Shopping Cart @endsection

@section('content')
<div class="p-4">
	<div class="d-flex flex-column">
	    <h3 class="text-center border p-4">SHOPPING CART</h3>
        <a href="{{url('/records')}}" class="hvr-icon-back btn btn-success pull-right col-md-2"><svg class="hvr-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg> Continue Shopping 
        </a>
	</div>	
	<hr class="soft"/>

        <!--Messaggio di successo per aggiunta articolo nel carrello-->
        @if(Session::has('success_message'))
          <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

	        <div id="AppendCartItems">
	          @include('records_shop.cart_items')
	        </div>
	
</div>
@endsection