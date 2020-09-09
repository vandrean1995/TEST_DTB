<form enctype="multipart/form-data" action="{{route('author.update.post', \Crypt::encrypt($author->id))}}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Author Update </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter Author Name" required="required" value="{{$author->name}}">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of birth</label>
                <input name="date" class="form-control" type="date" required="required" value="{{$author->date}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Place of birth</label>
                <input name="place" class="form-control" required="required" value="{{$author->place}}">
              </div>
            </div>
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