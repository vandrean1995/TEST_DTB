<form enctype="multipart/form-data" action="{{route('user_book.update.post', \Crypt::encrypt($user_book->id))}}" method="post">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Borrowing book applicant</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Applicant</label>
          <select class="form-control" disabled="">
            <option>{{ $user_book->user->name }}</option>
          </select>
        </div>
        <div class="form-group">
          <label>Book</label>
          <select class="form-control" disabled="">
            <option>{{ $user_book->book->name }}</option>
          </select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Borrower date</label>
            <input readonly="" value="{{$user_book->date_start}}" class="form-control" type="date" name="date_start">
          </div>
          <div class="col-md-6">
            <label>Date of return</label>
            <input readonly="" value="{{$user_book->date_end}}" class="form-control" type="date" name="date_end">
          </div>
        </div>
        <div>
          <label>Status</label>
          <select class="form-control" name="status">
            <option>--</option>
            <option @if($user_book->status == 'dipinjam') selected="" @endif value="dipinjam">On loan</option>
            <option @if($user_book->status == 'dikembalikan') selected="" @endif value="dikembalikan">Return</option>
            <option @if($user_book->status == 'tidak dikembalikan') selected="" @endif value="tidak dikembalikan">Not been restored</option>
          </select>
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