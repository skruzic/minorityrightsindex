<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="las la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href='{{ backpack_url('user') }}'><i class='nav-icon las la-user'></i> <span>Users</span></a></li>
<li class="nav-item"><a class="nav-link" href='{{ backpack_url('campaign') }}'><i class='nav-icon las la-users'></i> <span>Campaigns</span></a></li>
<li class="nav-item"><a class="nav-link" href='{{ backpack_url('optiongroup') }}'><i class='nav-icon las la-cogs'></i> <span>Option Groups</span></a></li>

<li class="nav-item"><a class="nav-link" href="{{ url(config('backpack.base.route_prefix').'/page') }}"><i class="nav-icon las la-file"></i> <span>{{ ucfirst(trans('backpack::pagemanager.pages')) }}</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon las la-list"></i> <span>Menu</span></a></li>
