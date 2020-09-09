<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel">Are you sure want to delete this data?</h4>
    </div>
    <div class="modal-body">
      <code>{{ $author->name }} will be delete!!</code>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <a href="{{ route( 'author.delete.post', \Crypt::encrypt( $author->id ) ) }}" class="btn btn-danger">Delete</a> 
    </div>
  </div>
</div>