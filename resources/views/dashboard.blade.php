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
        <span class="caption-subject bold uppercase">Library log</span>
      </div>
    </div>
    <div class="portlet-body">
      <div class="table-toolbar">
        <div class="row">
          <div class="col-md-6">
              <a href="{{ route('user_book.create') }}" class="btn sbold green spawnModal" data-toggle="modal" data-target="#createModal">
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
            <th> Borrower </th>
            <th> Book </th>
            <th> Date of due || Date of return </th>
            <th> Approval rent & return </th>
            <th> Status </th>
            <th> Actions </th>
          </tr>
        </thead>
        <tbody>
        @foreach( $user_book as $data )
          <tr class="odd gradeX">
            <td>
              <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="checkboxes" value="1" />
                <span></span>
              </label>
            </td>
            <td class="sorting_1">{{ $data->user->name }}</td>
            <td>{{ $data->book->name }}</td>
            <td>{{ $data->date_start }} || {{ $data->date_end }} </td>
            <td>{{ $data->giver->name }} @if($data->taker_id != null) || {{ $data->taker->name }} @else || <code>Belum Diterima</code> @endif</td>
            @if($data->status == 'dipinjam')
            <td><span class="label label-sm label-warning">On loan</span></td>
            @elseif($data->status == 'dikembalikan')
            <td><span class="label label-sm label-success">Return</span></td>
            @else
            <td><span class="label label-sm label-danger">Not been restored</span></td>
            @endif
            <td align="center">
              @if( $data->status == 'dikembalikan' )
                <span class="label label-md label-success">No action</span>
              @else
                @if( $role->user_book->u == true )
                <a href="{{ route('user_book.update', \Crypt::encrypt( $data->id )) }}" class="btn btn-primary btn-md spawnModal" data-toggle="modal" data-target="#updateModal">Update Status</a>
                @endif
              @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat2 bordered">
        <div class="display">
          <div class="number">
            <h3 class="font-green-sharp">
              <span data-counter="counterup" data-value="7800">0</span>
              <small class="font-green-sharp">$</small>
            </h3>
            <small>TOTAL PROFIT</small>
          </div>
            <div class="icon">
              <i class="icon-pie-chart"></i>
            </div>
          </div>
          <div class="progress-info">
            <div class="progress">
              <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                <span class="sr-only">76% progress</span>
              </span>
            </div>
            <div class="status">
              <div class="status-title"> progress </div>
              <div class="status-number"> 76% </div>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat2 bordered">
        <div class="display">
          <div class="number">
            <h3 class="font-red-haze">
                <span data-counter="counterup" data-value="1349">0</span>
            </h3>
            <small>NEW FEEDBACKS</small>
          </div>
          <div class="icon">
            <i class="icon-like"></i>
          </div>
        </div>
        <div class="progress-info">
          <div class="progress">
            <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
              <span class="sr-only">85% change</span>
            </span>
          </div>
          <div class="status">
            <div class="status-title"> change </div>
            <div class="status-number"> 85% </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat2 bordered">
        <div class="display">
          <div class="number">
            <h3 class="font-blue-sharp">
                <span data-counter="counterup" data-value="567"></span>
            </h3>
            <small>NEW ORDERS</small>
          </div>
          <div class="icon">
            <i class="icon-basket"></i>
          </div>
        </div>
        <div class="progress-info">
          <div class="progress">
            <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
              <span class="sr-only">45% grow</span>
            </span>
          </div>
          <div class="status">
            <div class="status-title"> grow </div>
            <div class="status-number"> 45% </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="dashboard-stat2 bordered">
        <div class="display">
          <div class="number">
            <h3 class="font-purple-soft">
              <span data-counter="counterup" data-value="276"></span>
            </h3>
            <small>NEW USERS</small>
          </div>
          <div class="icon">
            <i class="icon-user"></i>
          </div>
        </div>
        <div class="progress-info">
          <div class="progress">
            <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
              <span class="sr-only">56% change</span>
            </span>
          </div>
          <div class="status">
            <div class="status-title"> change </div>
            <div class="status-number"> 57% </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
@endsection


    