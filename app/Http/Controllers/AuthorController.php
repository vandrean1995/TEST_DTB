<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Author;
use App\AuthorCategory;
use Auth, Redirect, Input, Validator, Hash, Crypt;

class AuthorController extends Controller
{

    public function getIndex(){
        $data ['me']            = Auth::user();
        $data ['title']         = "Author Management";
        $data ['author']        = Author::where('is_delete', 'N')->with('book')->get();
        $data ['role']          = json_decode(User::where('id',Auth::user()->id)->with('group')->first()->group->privilege);
        // dd($data['author']->toArray());
        return view( 'author.index', $data );
    }

    public function getCreate(){
        $data ['author'] = Author::all();
        $html = view( 'author.modal.create', $data)->render();
        
        return $html;
    }

    public function getUpdate($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['author'] = Author::all();
        $data['author']   = Author::find( $id );


        $html = view( 'author.modal.update', $data)->render();
        
        return $html;
    }

    public function getDelete($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['author']   = Author::find( $id );
        $html = view( 'author.modal.delete', $data)->render();
        
        return $html;
    }

    public function postCreate(Request $request){
        $input = $request->all();
        $rules = [
            'name'  => 'required',
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $author = Author::create( $input );

            return Redirect::back();
        } else {
            $messages = $validator->messages();

            return Redirect::to()
                    ->withInput( $input )
                    ->withErrors( $validator );
        }
    }

    public function postUpdate( $id_encrypted, Request $request){
        $input  = $request->all();
        $id     = Crypt::decrypt( $id_encrypted );

        $rules = [
            'name'  => 'required',
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $author = Author::find( $id );
            $author->name             = $input['name'];
            $author->date             = $input['date'];
            $author->place            = $input['place'];
            $author->save();

            return Redirect::back();
        } else {
            $messages = $validator->messages();

            return Redirect::to()
                    ->withInput( $input )
                    ->withErrors( $validator );
        }
    }

    public function doDelete($id_encrypted){
        $id = Crypt::decrypt($id_encrypted);
        $delete = Author::find($id);
        $delete->is_delete = "Y";
        $delete->save();

        return Redirect::back();
    }
}
