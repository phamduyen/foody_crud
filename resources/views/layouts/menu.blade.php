<!-- Sidebar Menu -->
<ul class="sidebar-menu">
    <li class="header">Management</li>
    <!-- Optionally, you can add icons to the links -->
    <!--User-->
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>User</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{!! url('/users') !!}">See all</a></li>
            <li><a href="{!! route('users.create') !!}">Add new</a></li>
        </ul>
    </li>
    <!--category-->
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Category</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{!! url('/categories') !!}">See all </a></li>
            <li><a href="{!! route('categories.create') !!}">Add new</a></li>
        </ul>
    </li>
    <!--food-->
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Food</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{!! url('/foods') !!}">See all </a></li>
            <li><a href="{!! route('foods.create') !!}">Add new</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Page</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{!! url('/pages') !!}">See all </a></li>
            <li><a href="{!! route('pages.create') !!}">Add new</a></li>
        </ul>
    </li>
</ul>
<!-- /.sidebar-menu -->