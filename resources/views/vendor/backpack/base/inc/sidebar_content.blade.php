<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="las la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href='{{ backpack_url('user') }}'><i class='nav-icon las la-user'></i> <span>@lang('admin.users')</span></a></li>
<li class="nav-item"><a class="nav-link" href='{{ backpack_url('campaign') }}'><i class='nav-icon las la-users'></i> <span>@lang('admin.campaigns_sidebar')</span></a></li>
<li class="nav-item"><a class="nav-link" href='{{ backpack_url('optiongroup') }}'><i class='nav-icon las la-cogs'></i> <span>@lang('admin.option_groups')</span></a></li>

<li class="nav-item"><a class="nav-link" href="{{ url(config('backpack.base.route_prefix').'/page') }}"><i class="nav-icon las la-file"></i> <span>{{ ucfirst(trans('backpack::pagemanager.pages')) }}</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon las la-list"></i> <span>Menu</span></a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-newspaper"></i> <span>News</span> </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon las la-newspaper"></i> <span>Articles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon las la-list"></i> <span>Categories</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon las la-tag"></i> <span>Tags</span></a></li>
    </ul>
</li>
