@extends( 'layout.layout' )
@section( 'content' )
<div class="page-content">
  <div class="page-head">
    <div class="page-title">
      <h1>Admin Dashboard
      </h1>
    </div>
  </div>
  <ul class="page-breadcrumb breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span class="active">Dashboard</span>
    </li>
  </ul>
  <div class="portlet light bordered">
    <div class="portlet-title">
      <div class="caption font-dark">
        <i class="icon-settings font-dark"></i>
        <span class="caption-subject bold uppercase">Book list</span>
      </div>
    </div>
    <div class="portlet-body">
      <div class="table-toolbar">
        <div class="row">
          <div class="col-md-6">
              <a href="{{ route('book.create') }}" class="btn sbold green spawnModal" data-toggle="modal" data-target="#createModal">
                Add New
                <i class="fa fa-plus"></i>
              </a>
          </div>
        </div>
      </div>
      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
          <tr>
            <th>
              <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
              </label>
            </th>
            <th> Name </th>
            <th> Author </th>
            <th> Synopsist </th>
            <th> Stock </th>
            <th> Actions </th>
          </tr>
        </thead>
        <tbody>
        @foreach( $book as $data )
          <tr class="odd gradeX">
            <td>
              <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="checkboxes" value="1" />
                <span></span>
              </label>
            </td>
            <td class="sorting_1">{{ $data->name }}</td>
            <td>{{$data->author->name}}</td>
            <td></td>
            <td>{{$data->stock}}</td>
            <td align="center">
            @if( $role->book->u == true )
              <a href="{{ route('book.update', \Crypt::encrypt( $data->id )) }}" class="btn btn-warning btn-md spawnModal" data-toggle="modal" data-target="#updateModal">Update</a>
            @endif
            @if( $role->book->d == true )
              <a href="{{ route('book.delete', \Crypt::encrypt( $data->id )) }}" class="btn btn-danger btn-md spawnModal" data-toggle="modal" data-target="#deleteModal">Delete</a>
            @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
@endsection


    