<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    @lang('public.dashboard')
                </a>
{{--                project section--}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProject" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                    @lang('public.project')
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProject" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('projects_index') }}">@lang('public.project_dashboard')</a>
                        <a class="nav-link" href="{{ route('tasks_index') }}">@lang('public.taskboard')</a>
                    </nav>
                </div>
                {{--                employee section--}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEmployee" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                    @lang('public.employee')
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEmployee" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('employees_index') }}">@lang('public.employee_list')</a>
                        <a class="nav-link" href="{{ route('add_employee') }}">@lang('public.add_employee')</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('departments_index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-sitemap"></i></div>
                    @lang('public.department')
                </a>
                {{--                employee section--}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRequest" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope-open"></i></div>
                    @lang('public.request')
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseRequest" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('leaves_index') }}">@lang('public.leave_request')</a>
                        <a class="nav-link" href="{{ route('claims_index') }}">@lang('public.claim_request')</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('payrolls_index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-sack-dollar"></i></div>
                    @lang('public.payroll')
                </a>
                <a class="nav-link" href="{{ route('announcements_index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                    @lang('public.announcements')
                </a>
                <a class="nav-link" href="{{ route('tickets_index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-ticket"></i></div>
                    @lang('public.employee_ticket')
                </a>
                <a class="nav-link" href="{{ route('admin_index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                    @lang('public.sub_admin')
                </a>
            </div>
        </div>

    </nav>
</div>
