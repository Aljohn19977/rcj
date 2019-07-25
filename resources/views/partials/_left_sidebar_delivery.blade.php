    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    {{ Html::image('images/user.png', 'a picture') }}
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RCJ DELIVERY</div>                
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ url('/admin-logout') }}"><i class="material-icons">input</i>Logout</a></li>
                                    <form id="logout-form" action="{{ url('/admin-logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
         @yield('side-menu')
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <a href="javascript:void(0);">RCJ FASHION</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>