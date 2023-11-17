      <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li class="">
                                <a href="{{route('home')}}" class="waves-effect {{ request()->is('home') || request()->is('/home/*') ? 'mm active' : '' }}">
                                    <i class="ti-home"></i><span> <?php echo translate('dashboard') ?> </span>
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('rents.index')}}" class="waves-effect {{ request()->is('home') || request()->is('/home/*') ? 'mm active' : '' }}">
                                    <i class="fas fa-barcode"></i><span> <?php echo translate('rent_book') ?> </span>
                                </a>
                            </li>

                            <!-- <li class="menu-title">Categories</li> -->

                            <li class="">
                                <a href="{{route('category.index')}}" class="waves-effect {{ request()->is('category') || request()->is('category/*') ? 'mm active':'' }}">
                                    <i class="fas fa-shapes"></i> <span>  <?php echo translate('categories') ?>  </span>
                                </a>
                            </li>

                            <li class="">
                                <a href="{{route('books.index')}}" class="waves-effect {{ request()->is('books') || request()->is('books/*') ? 'mm active':'' }}">
                                    <i class="dripicons-view-apps"></i> <span>  <?php echo translate('books') ?>  </span>
                                </a>
                            </li>


                            <li class="">
                                <a href="{{route('members.index')}}" class="waves-effect {{ request()->is('members') || request()->is('members/*') ? 'mm active':'' }}">
                                    <i class="fa fa-users"></i> <span>  <?php echo translate('member') ?>  </span>
                                </a>
                            </li>

                            <li class="">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span> <?php echo translate('admin_setting'); ?> <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li class="">
                                        <a href="{{route('users.index')}}" class="waves-effect {{ request()->is('users') || request()->is('users/*') ? 'mm active' : '' }}"><i class="fa fa-users"></i> <span><?php echo translate('admin_users') ?></span></a>
                                    </li>

                                    <li class="">
                                        <a href="{{route('roles.index')}}" class="waves-effect {{ request()->is('roles') || request()->is('roles/*') ? 'mm active' : '' }}"><i class="fas fa-shield-alt"></i> <span><?php echo translate('roles') ?></span></a>
                                    </li>

                                    <li class="">
                                        <a href="{{route('permission.index')}}" class="waves-effect {{ request()->is('permission') || request()->is('permission/*') ? 'mm active' : '' }}"><i class="dripicons-view-apps"></i> <span><?php echo translate('permission') ?></span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
