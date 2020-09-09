<form enctype="multipart/form-data" action="{{route('uacl.group.update.post', \Crypt::encrypt( $group->id ))}}" method="post">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Update usergroup</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{$group->name}}">
        </div>
        <div class="form-group">
          <label>Access Rights</label><br>
            <table class="table table-striped dataTable" role="grid">
                <th>Module Name</th>
                <th>Create</th>
                <th>Read</th>
                <th>Update</th>
                <th>Delete</th>
              <tr>
                <td>Dashboard</td>
                <td><input name="dashboard-c" type="checkbox" @if( isset($group->privilege->dashboard->c) && $group->privilege->dashboard->c == true ) checked="checked" @endif></td>
                <td><input name="dashboard-r" type="checkbox" @if( isset($group->privilege->dashboard->r) && $group->privilege->dashboard->r == true ) checked="checked" @endif></td>
                <td><input name="dashboard-u" type="checkbox" @if( isset($group->privilege->dashboard->u) && $group->privilege->dashboard->u == true ) checked="checked" @endif></td>
              </tr>
              <tr>
                <td>Group</td>
                <td><input name="group-c" type="checkbox" @if( isset($group->privilege->group->c) && $group->privilege->group->c == true ) checked="checked" @endif></td>
                <td><input name="group-r" type="checkbox" @if( isset($group->privilege->group->r) && $group->privilege->group->r == true ) checked="checked" @endif></td>
                <td><input name="group-u" type="checkbox" @if( isset($group->privilege->group->u) && $group->privilege->group->u == true ) checked="checked" @endif></td>
                <td><input name="group-d" type="checkbox" @if( isset($group->privilege->group->d) && $group->privilege->group->d == true ) checked="checked" @endif></td>
              </tr>
              <tr>
                <td>User</td>
                <td><input name="user-c" type="checkbox" @if( isset($group->privilege->user->c) && $group->privilege->user->c == true ) checked="checked" @endif></td>
                <td><input name="user-r" type="checkbox" @if( isset($group->privilege->user->r) && $group->privilege->user->r == true ) checked="checked" @endif></td>
                <td><input name="user-u" type="checkbox" @if( isset($group->privilege->user->u) && $group->privilege->user->u == true ) checked="checked" @endif></td>
                <td><input name="user-d" type="checkbox" @if( isset($group->privilege->user->d) && $group->privilege->user->d == true ) checked="checked" @endif></td>
              </tr>
              <tr>
                <td>Author</td>
                <td><input name="author-c" type="checkbox" @if( isset($group->privilege->author->c) && $group->privilege->author->c == true ) checked="checked" @endif></td>
                <td><input name="author-r" type="checkbox" @if( isset($group->privilege->author->r) && $group->privilege->author->r == true ) checked="checked" @endif></td>
                <td><input name="author-u" type="checkbox" @if( isset($group->privilege->author->u) && $group->privilege->author->u == true ) checked="checked" @endif></td>
                <td><input name="author-d" type="checkbox" @if( isset($group->privilege->author->d) && $group->privilege->author->d == true ) checked="checked" @endif></td>
              </tr>
              <tr>
                <td>Category</td>
                <td><input name="category-c" type="checkbox" @if( isset($group->privilege->category->c) && $group->privilege->category->c == true ) checked="checked" @endif></td>
                <td><input name="category-r" type="checkbox" @if( isset($group->privilege->category->r) && $group->privilege->category->r == true ) checked="checked" @endif></td>
                <td><input name="category-u" type="checkbox" @if( isset($group->privilege->category->u) && $group->privilege->category->u == true ) checked="checked" @endif></td>
                <td><input name="category-d" type="checkbox" @if( isset($group->privilege->category->d) && $group->privilege->category->d == true ) checked="checked" @endif></td>
              </tr>
              <tr>
                <td>Book</td>
                <td><input name="book-c" type="checkbox" @if( isset($group->privilege->book->c) && $group->privilege->book->c == true ) checked="checked" @endif></td>
                <td><input name="book-r" type="checkbox" @if( isset($group->privilege->book->r) && $group->privilege->book->r == true ) checked="checked" @endif></td>
                <td><input name="book-u" type="checkbox" @if( isset($group->privilege->book->u) && $group->privilege->book->u == true ) checked="checked" @endif></td>
                <td><input name="book-d" type="checkbox" @if( isset($group->privilege->book->d) && $group->privilege->book->d == true ) checked="checked" @endif></td>
              </tr>
            </table>
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