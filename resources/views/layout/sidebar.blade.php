<?php 
  $user = App\User::find(\Auth::user()->id)->with('group')->first();
  $role = json_decode($user->group->privilege);
  $alias  = \Route::currentRouteName();
?>

<div class="page-sidebar navbar-collapse collapse">
  <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item start active open">
      <a href="{{route('home')}}" class="nav-link ">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
      </a>
    </li>
    <li class="heading">
      <h3 class="uppercase">Menu</h3>
    </li>
    @if( \Auth::user()->group_id == 1 )
    <li @if( $alias == 'uacl.group.index' || $alias == 'uacl.user.index' ) class="active nav-item" @else class="nav-item" @endif>
      <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-users"></i>
        <span class="title">UACL</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
        @if( $role->group->r == true )
        <li @if( $alias == 'uacl.group.index' ) class="active nav-item" @endif>
          <a href="{{ route( 'uacl.group.index' ) }}" class="nav-link ">
            <i class="icon-users"></i>
            <span class="title">Group Management</span>
          </a>
        </li>
        @endif
        @if( $role->user->r == true)
        <li @if( $alias == 'uacl.user.index') class="nav-item active" @endif>
          <a href="{{ route( 'uacl.user.index' ) }}" class="nav-link ">
            <i class="icon-user"></i>
            <span class="title">User Management</span>
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif
    @if( $role->author->r == true )
    <li @if( $alias == 'author.home' ) class="nav-item active" @endif>
      <a href="{{ route( 'author.home' ) }}" class="nav-link ">
        <i class="icon-pencil"></i>
        <span class="title">Author Management</span>
      </a>
    </li>
    @endif
    @if( $role->book->r == true )
    <li @if( $alias == 'book.home') class="nav-item active" @endif>
      <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-folder-open"></i>
        <span class="title">Bookshelf</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
        @if( $role->category->r == true )
        <li @if( $alias == 'category.home') class="nav-item active" @endif>
          <a href="{{ route('category.home') }}" class="nav-link ">
            <i class="icon-cog"></i>
            <span class="title">Category</span>
          </a>
        </li>
        @endif
        @if( $role->book->r == true )
        <li @if ( $alias =='book.home' )class="nav-item active" @endif>
          <a href="{{ route('book.home') }}" class="nav-link ">
            <i class="icon-books"></i>
            <span class="title">Book Management</span>
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif
  </ul>
</div>