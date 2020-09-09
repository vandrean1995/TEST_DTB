<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\User;
use App\Category;
use App\Author;
use App\UserBook;

use Auth, Redirect, Input, Validator, Hash, Crypt;

class DashboardController extends Controller
{
    public function getIndex(){
        $data ['me']            = Auth::user();
        $data ['title']         = "Dashboard";
        $data ['user_book']     = UserBook::with('user', 'book')->get();
        $data ['role']          = json_decode(User::where('id',Auth::user()->id)->with('group')->first()->group->privilege);
        // dd($data['user_book']);
        return view( 'dashboard', $data );
    }

    public function getCreate(){
        $data ['book']      = Book::where('is_delete', 'N')->with('author')->get();
        $data ['user']      = User::where('group_id', '!=', '1')->get();
        $html = view( 'modal.create', $data)->render();
        
        return $html;
    }

    public function getUpdate($id_encrypted){
        $id                 = Crypt::decrypt( $id_encrypted );
        $data['user_book']  = UserBook::where( 'id', $id )
                                    ->with('user', 'taker', 'book', 'giver')
                                    ->first();

        $html = view( 'modal.update', $data)->render();
        
        return $html;
    }

    public function postCreate(Request $request){
        $input = $request->all();
        $rules = [];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $input['giver_id']  = Auth::user()->id;
            
            $book = Book::find( $input['book_id'] );
            $book->save();

            $user_book = UserBook::create( $input );

            return Redirect::back();
        } else {
            $messages = $validator->messages();

            return Redirect::back()
                    ->withInput( $input )
                    ->withErrors( $validator );
        }
    }

    public function postUpdate( $id_encrypted, Request $request){
        $input  = $request->all();
        $id     = Crypt::decrypt( $id_encrypted );
        $rules  = [];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $user_book  = UserBook::find( $id );
            $user_book->status    = $input['status'];
            if ($input['status'] == 'dikembalikan') {
                $book = Book::find( $user_book->book_id );
                $book->stock += 1;
            }
            $user_book->taker_id  = Auth::user()->id;
            $user_book->save();

            return Redirect::back();
        } else {
            $messages = $validator->messages();

            return Redirect::back()
                    ->withInput( $input )
                    ->withErrors( $validator );
        }
    }
}
