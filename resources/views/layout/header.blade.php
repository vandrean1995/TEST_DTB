<div class="page-header-inner ">
  <div class="page-logo">
      <div class="menu-toggler sidebar-toggler">
      </div>
  </div>
  <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
  <div class="page-top">
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user dropdown-dark">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="username username-hide-on-mobile"> {{ \Auth::user()->name }} </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="{{ route('logout') }}">
                <i class="icon-logout"></i>Log Out 
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>