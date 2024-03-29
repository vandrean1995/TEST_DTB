<form enctype="multipart/form-data" action="{{route('author.create.post')}}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Author </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter Author Name" required="required">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of birth</label>
                <input name="date" class="form-control" type="date" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Place of birth</label>
                <input name="place" class="form-control" required="required">
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