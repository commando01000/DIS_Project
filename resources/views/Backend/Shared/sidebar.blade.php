<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>@lang('translation.dashboard')</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action py-2 ripple active">
                <i class="fas fa-chart-area fa-fw me-3"></i><span>@lang('translation.home')</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                    class="fas fa-lock fa-fw me-3"></i><span>@lang('translation.projects')</span></a>
            <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                    class="fas fa-chart-line fa-fw me-3"></i><span>@lang('translation.about')</span></a>
            <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-chart-pie fa-fw me-3"></i><span>@lang('translation.Contact-Us')</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                    class="fas fa-users fa-fw me-3"></i><span>@lang('translation.engineers')</span></a>
            <a href={{ route('admin.settings') }} class="list-group-item list-group-item-action py-2 ripple"><i
                    class="fas fa-money-bill fa-fw me-3"></i><span></span></a>
            <!-- Logout Button -->
            <div style="margin-top: auto; margin-left: 12px; margin-right: 12px;">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-sign-out-alt fa-fw me-3"></i><span>@lang('translation.submit')</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
<!-- Sidebar -->
