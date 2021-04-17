<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Genre;
use Hash;
use Auth;
use Session;
use App\Models\Admin;
use Image;

class AdminController extends Controller
{
    public function dashboard(){
        $records = Record::orderBy('id')->paginate(5);
        return view('admin.admin_dashboard', compact('records'));
    }

    public function login(Request $request){
        /*
        echo $password = Hash::make('123456');
        die;
        */
        if($request->isMethod('post')){
            $data = $request->all();
            /*
            print_r($data);
            die;
            */

            $validatedData = $request->validate([
                'email' => ['required', 'email:rfc,dns', 'max:255'],
                'password' => ['required'],
            ]);


            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                return redirect('admin/dashboard');
            } else{
                Session::flash('error_message', 'Email e/o password non validi');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function settings(){
        //echo "<pre>"; print_r(Auth::guard('admin')->user());die;
        
        return view('admin.admin_settings');
    }

    public function checkCurrentPassword(Request $request){
        //controllo che le password coincidano
        $data = $request->all();
        /* echo "<pre>";print_r($data);
        echo "<pre>";print_r(Auth::guard('admin')->user()->password); die; */
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            echo "true";
        } else{
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;

            //Controllo se la password attuale è corretta
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                //controllo se la nuova password e la conferma coincidono
                if($data['new_password'] == $data['confirmed_password']){
                    //controllo se l'id coincide; se coincide, faccio l'update:
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    Session::flash("success_message", "Password has been succefully updated");
                    return redirect()->back();

                }else{
                    Session::flash("error_message", "New Password doesn't match");
                    return redirect()->back();
                }
            } else{
                Session::flash('error_message', 'Your current password is incorrect!');
                return redirect()->back();
            }
        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //print_r($data);die;
            $rules = [
                'admin_name'=> ['required', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
                'admin_mobile'=> ['required', 'numeric'],
                'admin_image'=> ['mimes:jpg,jpeg,png,bmp']
            ];
            $customMessage = [
                'admin_name.required' => 'Name is required',
                'admin_name.max' => 'Name is too long (max 255 charachters)',
                'admin_name.regex' => 'Name is invalid',
                'admin_mobile.numeric' => 'Mobile number is incorrect',
                'admin_mobile.required'=> 'Mobile number is required',
                'admin_image.mimes'=> 'Invalid image format'
            ];
            $this->validate($request, $rules, $customMessage);

            //Uplad image:
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    //get extension of the image: 
                    $ext = $image_tmp->getClientOriginalExtension();

                    //generate an image name: 
                    $imageName = rand(111,99999).'.'.$ext;
                    $imagePath = 'pictures/admin_images/admin_pictures/'.$imageName;

                    //upload image: 
                    Image::make($image_tmp)->resize(300,400)->save($imagePath);
                } else if(!empty($data['current_admin_image'])){
                    $imageName = $data['current_admin_image'];
                } else{
                    $imageName = "";
                }
            }

            //Update Admin details:
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile'], 'image'=>$imageName]);
            Session::flash('success_message', 'Admin details successfully updated!');
            return redirect()->back();
        }
    


        return view('admin.update_admin_details');
    }

    public function getRecordById($id){
        $record = Record::find($id);
        if($record){
            return view('admin.record-detail', compact('record'));
        } else{
            return redirect()->back();
        }
    }

    public function editRecord($id){
        $genres = Genre::orderBy('name')->get();
        $record = Record::find($id);
        return view('admin.record-edit', compact('genres', 'record'));
    }

    public function saveRecord(Request $request, $id){
        $this->validate($request, [
            'title'=> 'required|string|min:3|regex:^[a-zA-Z0-9!@#$&()-`.+,/\"]*$^',
            'artist'=> 'required|string|min:3|regex:^[a-zA-Z0-9!@#$&()-`.+,/\"]*$^',
            'year'=> 'required',
            'price' => 'required',
            'description'=> 'required|min:2',
            'updated_at'=> 'required|min:1',
        ], [
            //titolo
            'title.required' => 'Title is mandatory',
            'title.min' => 'Title must contain at least 3 characters',
            'title.regex' => 'Accepted characters: a-z, A-Z, 0-9',

            //autore
            'artist.required' => 'Artist is mandatory',
            'artist.min' => 'Artist must contain at least 3 characters',
            'artist.regex' => 'Accepted characters: a-z, A-Z, 0-9',

            //year
            'year.required' => 'Year is mandatory',

            //price
            'price.required' => 'Price is mandatory',

            //condition
            'description.required' => 'Condition is mandatory',
            'description.min' => 'Condition must contain at least 2 characters',

            //data di inserimento
            'updated_at.required' => 'Added at is mandatory'
        ]);

        $record = Record::find($id);
        $record->title = $request->input('title');
        $record->artist = $request->input('artist');
        $record->year = $request->input('year');
        $record->price = $request->input('price');
        $record->description = $request->input('description');
        $record->tracklist = $request->input('tracklist');
        $record->updated_at = $request->input('updated_at');
        $record->genre_id = $request->input('genre_id');
        $picture = $request->file('picture');
        if($picture){
            $filename = $picture->getClientOriginalName(); 
            $filename = preg_replace("/[^a-z0-9\.]/","", strtolower($filename));
            $destinationPath = 'pictures/';
            $picture->move($destinationPath, $filename);
            $record->picture = '/'.$destinationPath.'/'.$filename;
        }

        $record->save();
        return redirect('admin/dashboard')->with('success_message', 'Record has been successfully edited');
    }


    public function deleteRecord($id){
        Record::find($id)->delete();
        return redirect('admin/dashboard')->with('success_message', 'Record has been successfully deleted');
    }

    public function add(){
        $genres = Genre::orderBy('name')->get();
        return view('admin.record-add', compact('genres'));
    }

    public function addRecord(Request $request){
        /*Validation*/
        $this->validate($request, [
            'title'=> 'required|string|min:3|regex:^[a-zA-Z0-9!@#$&()-`.+,/\"]*$^',
            'artist'=> 'required|string|min:3|regex:^[a-zA-Z0-9!@#$&()-`.+,/\"]*$^',
            'year'=> 'required',
            'price' => 'required',
            'description'=> 'required|min:2',
            'created_at'=> 'required|min:1',
        ], [
            //titolo
            'title.required' => 'Title is mandatory',
            'title.min' => 'Title must contain at least 3 characters',
            'title.regex' => 'Accepted characters: a-z, A-Z, 0-9',

            //autore
            'artist.required' => 'Artist is mandatory',
            'artist.min' => 'Artist must contain at least 3 characters',
            'artist.regex' => 'Accepted characters: a-z, A-Z, 0-9',

            //year
            'year.required' => 'Year is mandatory',

            //price
            'price.required' => 'Price is mandatory',

            //condition
            'description.required' => 'Condition is mandatory',
            'description.min' => 'Condition must contain at least 2 characters',

            //data di inserimento
            'created_at.required' => 'Added at is mandatory'
        ]);


        /*Save record*/
        $record = new Record;
        $record->title = $request->input('title');
        $record->artist = $request->input('artist');
        $record->year = $request->input('year');
        $record->price = $request->input('price');
        $record->description = $request->input('description');
        $record->tracklist = $request->input('tracklist');
        $record->created_at = $request->input('created_at');
        $record->genre_id = $request->input('genre_id');
        $picture = $request->file('picture');
        if($picture){
            $filename = $picture->getClientOriginalName(); 
            $filename = preg_replace("/[^a-z0-9\.]/","", strtolower($filename));
            $destinationPath = 'pictures/';
            $picture->move($destinationPath, $filename);
            $record->picture = '/'.$destinationPath.'/'.$filename;
        }
        $record->save();

        return redirect('admin/dashboard')->with('success_message', 'Record has been successfully added!');
    }
}
