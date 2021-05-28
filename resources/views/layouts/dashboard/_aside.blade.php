<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth()->guard('admin')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">


        

            <!-- users Page  !-->
            <li class="{{ active('dashboard.users') }}"><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('users')</span></a></li>


        </ul>

    </section>

</aside>

