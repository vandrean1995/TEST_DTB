<?php

namespace App\Http\Controllers\UACL;

use App\Http\Controllers\Controller;
use Auth, Redirect, Input, Validator, Hash, Crypt;
use App\User;
use App\Usergroup;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    
    function __construct()
    {
        $this->auth = Auth::user();
    }

    public function access( $input ){
        $access = array(
            'author'   => array(
                'c' => ( isset($input['author-c']) ) ? true : false,
                'r' => ( isset($input['author-r']) ) ? true : false,
                'u' => ( isset($input['author-u']) ) ? true : false,
                'd' => ( isset($input['author-d']) ) ? true : false
            ),
            'book'   => array(
                'c' => ( isset($input['book-c']) ) ? true : false,
                'r' => ( isset($input['book-r']) ) ? true : false,
                'u' => ( isset($input['book-u']) ) ? true : false,
                'd' => ( isset($input['book-d']) ) ? true : false
            ),
            'user_book'   => array(
                'c' => ( isset($input['user_book-c']) ) ? true : false,
                'r' => ( isset($input['user_book-r']) ) ? true : false,
                'u' => ( isset($input['user_book-u']) ) ? true : false,
                'd' => ( isset($input['user_book-d']) ) ? true : false
            ),
            'group' => array(
                'c' => ( isset($input['group-c']) ) ? true : false,
                'r' => ( isset($input['group-r']) ) ? true : false,
                'u' => ( isset($input['group-u']) ) ? true : false,
                'd' => ( isset($input['group-d']) ) ? true : false
            ),
            'user'  => array(
                'c' => ( isset($input['user-c']) ) ? true : false,
                'r' => ( isset($input['user-r']) ) ? true : false,
                'u' => ( isset($input['user-u']) ) ? true : false,
                'd' => ( isset($input['user-d']) ) ? true : false
            )
        );

        return json_encode( $access );
    }

    public function getIndex(){
        $data ['me']            = Auth::user();
        $data ['title']         = "Group Management";
        $data ['usergroup']     = Usergroup::all();
        $data ['role']          = json_decode(User::where('id',Auth::user()->id)->with('group')->first()->group->privilege);
        
        return view( 'uacl.group.index', $data );
    }

    public function getCreate(){
        $html = view( 'uacl.group.modal.create')->render();
        
        return $html;
    }

    public function getUpdate($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['group'] = Usergroup::find( $id );
        $data['group']->privilege = json_decode( $data['group']['privilege'] );

        $html = view( 'uacl.group.modal.update', $data)->render();
        
        return $html;
    }

    public function getDelete($id_encrypted){
        $id = Crypt::decrypt( $id_encrypted );
        $data['group'] = Usergroup::find( $id );

        $html = view( 'uacl.group.modal.delete', $data)->render();
        
        return $html;
    }

    public function postCreate(Request $request){
        $input = $request->all();

        $rules = [
            'name'  => 'required',
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            $input['privilege'] = $this->access( $input );
            $group = Usergroup::create( $input );

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
            $group = Usergroup::find( $id );
            $group->name         = $input['name'];
            $group->privilege = $this->access( $input );
            $group->save();

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
        $delete = Usergroup::find($id);
        $delete->delete();

        return Redirect::back();
    }
}
