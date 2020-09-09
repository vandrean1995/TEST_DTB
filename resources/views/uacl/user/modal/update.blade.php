<form enctype="multipart/form-data" action="{{route('uacl.user.update', \Crypt::encrypt($user->id))}}" method="post">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">User update</h4>
      </div>
      <div class="modal-body">
        <div class="portlet-body">
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#profile" data-toggle="tab" aria-expanded="true"> Profile </a>
            </li>
            <li class="">
              <a href="#password" data-toggle="tab" aria-expanded="false"> Password </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="profile">
              <div class="form-group">
                <label>Group</label>
                <select class="form-control" name="usergroup">
                  <option></option>
                  @for( $ug = 0; $ug < $count_group; $ug++ )
                    <option value="{{$usergroup[$ug]->id}}" @if($usergroup[$ug]->id == $user->group_id) selected="selected" @endif>{{$usergroup[$ug]->name}}</option>
                    @endfor
                </select>
              </div>
              <div class="form-group">
                <label>Name</label>
                <input name="name" class="form-control" placeholder="Enter User Name" required="required" value="{{$user->name}}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter User Email" required="required" value="{{$user->email}}">
              </div>
            </div>
            <div class="tab-pane fade" id="password">
              <div class="form-group">
                <label>Password</label>
                <input name="password" id="password" type="password" class="form-control" placeholder="Enter password" required="required">
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" required="required">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
        <button type="submit" class="btn green">Save changes</button>
      </div>
    </div>
  </div>
</form>