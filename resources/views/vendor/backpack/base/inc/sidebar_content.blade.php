<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li><a href='{{ backpack_url('user') }}'><i class='fa fa-user'></i> <span>Users</span></a></li>
<li><a href='{{ backpack_url('campaign') }}'><i class='fa fa-users'></i> <span>Campaigns</span></a></li>
<li><a href='{{ backpack_url('section') }}'><i class='fa fa-users'></i> <span>Sections</span></a></li>
<li><a href='{{ backpack_url('question') }}'><i class='fa fa-question'></i> <span>Questions</span></a></li>
<li><a href='{{ backpack_url('optiongroup') }}'><i class='fa fa-cogs'></i> <span>Option Groups</span></a></li>