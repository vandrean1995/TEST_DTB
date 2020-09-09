<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Author;
use App\Book;
use App\Category;
use Auth, Redirect, Input, Validator, Hash, Crypt;

class CategoryController extends Controller
{

    public function getIndex(){
        $data ['me']            	= Auth::user();
        $data ['title']         	= "Category Management";
        $data ['category']        	= Category::where('is_delete', 'N')->with('book')->get();
        $data ['role']          	= json_decode(User::where('id',Auth::user()->id)->with('group')->first()->group->privilege);
        // dd($data['role']);

        return view( 'category.index', $data );
    }

    public function getCreate(){
        $data ['category'] = Category::all();
        $html = view( 'category.modal.create', $data)->render();
        
        return $html;
    }

    public function getUpdate($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['category'] 	= Category::all();
        $data['category']   = Category::find( $id );

        $html = view( 'category.modal.update', $data)->render();
        
        return $html;
    }

    public function getDelete($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['category']   = Category::find( $id );
        $html = view( 'category.modal.delete', $data)->render();
        
        return $html;
    }

    public function postCreate(Request $request){
        $input = $request->all();
        $rules = [
            'name'  => 'required',
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $category = Category::create( $input );

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
            $category = Category::find( $id );
            $category->name = $input['name'];
            $category->save();

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
        $delete = Category::find($id);
        $delete->is_delete = "Y";
        $delete->save();

        return Redirect::back();
    }
}