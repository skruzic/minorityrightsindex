{{-- This file is used for menu items by any Backpack v7 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('campaign') }}"><i class="nav-icon la la-users"></i> <span>Campaigns</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('optiongroup') }}"><i class="nav-icon la la-cogs"></i> <span>Option Groups</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}"><i class="nav-icon la la-file"></i> <span>{{ ucfirst(trans('backpack::pagemanager.pages')) }}</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon la la-list"></i> <span>Menu</span></a></li>
