<form enctype="multipart/form-data" action="{{route('user_book.create.post')}}" method="post">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Borrowing book applicant</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Applicant</label>
          <select class="form-control" name="user_id">
            <option value="">-------</option>
            @foreach($user as $data)
            <option value="{{$data->id}}">{{$data->name}} ( {{$data->email}} ) </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Book</label>
          <select class="form-control" name="book_id">
            <option>--</option>
            @foreach($book as $data)
            <option value="{{$data->id}}">{{$data->name}} ( {{$data->author->name}} ) </option>
            @endforeach
          </select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Date borrowing</label>
            <input class="form-control" type="date" name="date_start">
          </div>
          <div class="col-md-6">
            <label>Date of return</label>
            <input class="form-control" type="date" name="date_end">
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