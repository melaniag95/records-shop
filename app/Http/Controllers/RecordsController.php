<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Record;
use App\Models\Cart;
use Session;
use Auth;

class RecordsController extends Controller
{
    public function home(){
        $records = Record::with('genre')->where('price', '<', 21)->get();
        return view('records_shop.home', compact('records'));
    }

    public function allRecords(){
        $records = Record::orderBy('artist')->paginate(5);
        return view('records_shop.records', compact('records'));
    }

    public function dettaglioRecord($id){
        $record = Record::with('genre')->find($id);
        if($record){
            return view('records_shop.dettaglio', compact('record'));
        } else{
            return redirect('records_shop.records');
        }

    }

    public function addToCart(Request $request){
        if($request->isMethod('post')){
            $data =  $request->all();
            /*
            echo '<pre>';
            print_r($data);
            die;
            */
        }

        //Generare la session id se non esiste
        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }

        //Controllo se il prodotto esiste già nel carrello
        if(Auth::check()){
            $countProducts = Cart::where(['record_id'=>$data['record_id'], 'quantity'=>$data['quantity'], 'user_id'=>Auth::user()->id])->count();
        } else{
            $countProducts = Cart::where(['record_id'=>$data['record_id'], 'quantity'=>$data['quantity'], 'session_id'=>Session::get('session_id')])->count();
        }
    
        if($countProducts>0){
            $message = 'Il prodotto è già stato inserito nel carrello!';
            Session::flash('error_message', $message);
            return redirect()->back();
        }

        //Salvataggio del prodotto nel carrello
        /*Primo metodo:
        Cart::insert(['session_id'=>$session_id, 'record_id'=>$data['record_id'], 'quantity'=>$data['quantity']]);
        */

        //Secondo metodo:
        $cart = new Cart;
        $cart->session_id = $session_id;
        $cart->record_id = $data['record_id'];
        $cart->quantity = $data['quantity'];
        $cart->save();
        $message = 'Il prodotto è stato aggiunto al carrello';
        Session::flash('success_message', $message);
        return redirect('cart');
    }


    public function shoppingCart(){
        $userCartItems = Cart::userCartItems();
        //echo "<pre>"; print_r($userCartItems);die;
        return view('records_shop.cart', compact('userCartItems'));
    }

    public function updateCartItemQuantity(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            Cart::where('id', $data['cartid'])->update(['quantity'=>$data['quantity']]);
            $userCartItems = Cart::userCartItems();
            return response()->json([
                'status'=>true,
                'view'=>(String)View::make('records_shop.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }

    public function deleteCartItem(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            Cart::where('id', $data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            return response()->json([
                'view'=>(String)View::make('records_shop.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }

    public function viewCategory($id){
        $genre_records = Record::where('genre_id', $id)->get();
        $id_= $id;
        return view('records_shop.list-by-genre', compact('genre_records'));
    }
    

}
