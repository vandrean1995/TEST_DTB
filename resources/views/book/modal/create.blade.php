<form enctype="multipart/form-data" action="{{route('book.create.post')}}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Book Info </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter title of book" required="required">
          </div>
          <div class="form-group">
            <label>Code</label>
            <input name="code" class="form-control" placeholder="Enter code of book" required="required">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" required="required">
              <option value=""></option>
              @foreach( $category as $data )
              <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach
            </select>
          </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Author</label>
                <select class="form-control" name="author_id" required="required">
                  <option value="">------</option>
                  @foreach( $author as $data )
                  <option value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <label>Place</label>
              <input name="place" placeholder="Enter the place you're putted" class="form-control" required="">
            </div>
          </div>
          <div class="form-group">
            <label>Synopsis</label>
            <textarea class="form-control" name="description" placeholder="Enter book's synopsis here" required=""></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</form>