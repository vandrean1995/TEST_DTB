<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Category;
use App\Author;
use Illuminate\Http\Request;
use Auth, Redirect, Input, Validator, Hash, Crypt;

class BookController extends Controller
{
    public function getIndex(){
        $data ['me']            = Auth::user();
        $data ['title']         = "Book Management";
        $data ['book']          = Book::where('is_delete', 'N')->with('author')->get();
        $data ['role']          = json_decode(User::where('id',Auth::user()->id)->with('group')->first()->group->privilege);
        // dd($data);
        return view( 'book.index', $data );
    }

    public function getCreate(){
        $data ['author'] = Author::where('is_delete', 'N')->get();
        $data ['category'] = Category::where('is_delete', 'N')->get();
        $html = view( 'book.modal.create', $data)->render();
        
        return $html;
    }

    public function getUpdate($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['author'] = Author::where('is_delete', 'N')->get();
        $data['category'] = Category::where('is_delete', 'N')->get();
        $data['book']   = Book::find( $id );

        $html = view( 'book.modal.update', $data)->render();
        
        return $html;
    }

    public function getDelete($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['book']   = Book::find( $id );
        $html = view( 'book.modal.delete', $data)->render();
        
        return $html;
    }

    public function postCreate(Request $request){
        $input = $request->all();
        $rules = [
            'name'  => 'required',
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $book = Book::create( $input );
            // dd($input);
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
            $book = Book::find( $id );
            $book->name             = $input['name'];
            $book->author_id        = $input['author_id'];
            $book->category_id      = $input['category_id'];
            $book->code             = $input['code'];
            $book->date             = $input['date'];
            $book->place            = $input['place'];
            $book->description      = $input['description'];
            $book->save();

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
        $delete = Book::find($id);
        $delete->is_delete = "Y";
        $delete->save();

        return Redirect::back();
    }
}
