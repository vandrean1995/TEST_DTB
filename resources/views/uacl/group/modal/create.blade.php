<form enctype="multipart/form-data" action="{{route('uacl.group.create.post')}}" method="post">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Usergroup create</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required="required">
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
                <td><input name="user_book-c" type="checkbox"></td>
                <td><input name="user_book-r" type="checkbox"></td>
                <td><input name="user_book-u" type="checkbox"></td>
              </tr>
              <tr>
                <td>Group</td>
                <td><input name="group-c" type="checkbox"></td>
                <td><input name="group-r" type="checkbox"></td>
                <td><input name="group-u" type="checkbox"></td>
                <td><input name="group-d" type="checkbox"></td>
              </tr>
              <tr>
                <td>User</td>
                <td><input name="user-c" type="checkbox"></td>
                <td><input name="user-r" type="checkbox"></td>
                <td><input name="user-u" type="checkbox"></td>
                <td><input name="user-d" type="checkbox"></td>
              </tr>
              <tr>
                <td>Author</td>
                <td><input name="author-c" type="checkbox"></td>
                <td><input name="author-r" type="checkbox"></td>
                <td><input name="author-u" type="checkbox"></td>
                <td><input name="author-d" type="checkbox"></td>
              </tr>
              <tr>
                <td>Category</td>
                <td><input name="category-c" type="checkbox"></td>
                <td><input name="category-r" type="checkbox"></td>
                <td><input name="category-u" type="checkbox"></td>
                <td><input name="category-d" type="checkbox"></td>
              </tr>
              <tr>
                <td>Book</td>
                <td><input name="book-c" type="checkbox"></td>
                <td><input name="book-r" type="checkbox"></td>
                <td><input name="book-u" type="checkbox"></td>
                <td><input name="book-d" type="checkbox"></td>
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