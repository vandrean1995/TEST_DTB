<?php
namespace App\Http\Controllers\UACL;

use App\Http\Controllers\Controller;
use App\User;
use App\Usergroup;
use Auth, Redirect, Input, Validator, Hash, Crypt, File;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    function __construct()
    {
        $this->auth = Auth::user();
    }

    public function getIndex()
    {
        $data ['me']            = Auth::user();
        $data ['title']         = "Lorikeet | User Management";
        $data ['user']          = User::all();
        $data ['count_group']   = count($data['user']);
        $data ['role']          = json_decode(User::where('id',Auth::user()->id)->with('group')->first()->group->privilege);

        return view( 'uacl.user.index', $data );
    }

    public function getCreate()
    {
        $data ['usergroup']     = Usergroup::all();
        $data ['count_group']   = count($data['usergroup']);
        $html = view( 'uacl.user.modal.create', $data)->render();
        
        return $html;
    }

    public function getUpdate( $id_encrypted )
    {
        $id = Crypt::decrypt( $id_encrypted );

        $data ['user']          = User::find( $id );
        $data ['usergroup']     = Usergroup::all();
        $data ['count_group']   = count($data['usergroup']);
        $html = view( 'uacl.user.modal.update', $data)->render();
        
        return $html;
    }

    public function getDelete( $id_encrypted )
    {
        $id = Crypt::decrypt( $id_encrypted );

        $data ['user']          = User::find( $id );
        $html = view( 'uacl.user.modal.delete', $data)->render();
        
        return $html;
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        $rules = [
            'usergroup'             => 'required',
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password' 
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            
            $save = new User;
            $save->group_id     = $input['usergroup'];
            $save->name         = $input['name'];
            $save->email        = $input['email'];
            $save->password     = Hash::make($input['password']);
            $save->save();

            return Redirect::to( route( 'uacl.user.index' ) );
        } else {
            $messages = $validator->messages();

            return Redirect::to( route( 'uacl.user.index' ) )
                    ->withInput( $input )
                    ->withErrors( $validator );
        }

    }
    
    public function postUpdate($id_encrypted, Request $request)
    {
        $id = Crypt::decrypt($id_encrypted);
        $input = $request->all();

        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email'
        ];

        $validator = Validator::make( $input, $rules );
        if( $validator->passes() ){
            unset( $input['password_confirmation'] );

            $save = User::find($id);
            $save->group_id = (isset($input['usergroup']))?$input['usergroup']:$save->group_id;
            $save->name     = $input['name'];
            $save->email    = $input['email'];
            $save->password = ( $input['password'] ) ? Hash::make($input['password']) : $save->password;
            $save->save();

            return Redirect::back();

        } else {
            $messages = $validator->messages();

            return Redirect::to( route( 'uacl.user.index' ) )
                    ->withInput( $input )
                    ->withErrors( $validator );
        }

    } 


    public function doDelete($id_encrypted)
    {
        $id   = Crypt::decrypt($id_encrypted);
        $user = User::find($id);
        $user->delete();

        return Redirect::back();
    }
}