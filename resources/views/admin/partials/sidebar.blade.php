<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Master</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.industry.*']) }}"
                    href="{{ route('admin.industry.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Industries
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.seniority.*']) }}"
                    href="{{ route('admin.seniority.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Seniorities
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">CMS</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.banner.*']) }}"
                    href="{{ route('admin.banner.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Banners
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.faq.*']) }}"
                    href="{{ route('admin.faq.index') }}">
                    <i class="icon fa fa-circle-o"></i>All FAQs
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.contactus.*']) }}"
                    href="{{ route('admin.contactus.show') }}">
                    <i class="icon fa fa-circle-o"></i>Contact Us
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.zoom.meeting']) }}"
                href="{{ route('admin.zoom.meeting') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Zoom Meetings</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.news.*']) }}"
                href="{{ route('admin.news.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">All News</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.user.*']) }}"
                href="{{ route('admin.user.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">All Mentee</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.mentor.*']) }}"
                href="{{ route('admin.mentor.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">All Mentors</span>
            </a>
        </li>
    </ul>
</aside>