<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <div class="logo-icon-container">
                        <?php $admin_logo_img = AdminFacades::setting('admin_icon_image', ''); ?>
                        @if($admin_logo_img == '')
                            <img src="{{ asset('assets/images/logo-icon-light.png') }}" alt="Logo Icon">
                        @else
                            <img src="{{ AdminFacades::image($admin_logo_img) }}" alt="Logo Icon">
                        @endif
                    </div>
                    <div class="title">{{AdminFacades::setting('admin_title', 'VOYAGER')}}</div>
                </a>
            </div><!-- .navbar-header -->

            <div class="panel widget center bgimage" style="background-image:url({{ AdminFacades::image( AdminFacades::setting('admin_bg_image'),  '/assets/images/bg.jpg' ) }});">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>

                    <a href="{{ route('admin.profile') }}" class="btn btn-primary">Profile</a>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>

        {!! menu('admin', 'admin_menu') !!}
    </nav>
</div>
