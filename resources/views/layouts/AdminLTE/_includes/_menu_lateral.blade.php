<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header" style="color:#fff;"> MAIN MENU <i class="fa fa-level-down"></i></li>  
			<li class="
						{{ Request::segment(1) === null ? 'active' : null }}
						{{ Request::segment(1) === 'home' ? 'active' : null }}
					  ">
				<a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a> 
				@if(Auth::user()->id!=2)
				<a href="{{ route('addFoodDetails') }}" title="Food Details"><i class="fa fa-plus"></i> <span> Add Food Item</span></a>
				<a href="{{ route('foodListing') }}" title="Food Details"><i class="fa fa-list"></i> <span> Food Details</span></a>
				<a href="{{ route('addHealthIssue') }}" title="Issue Details"><i class="fa fa-plus"></i> <span> Add Health Issue</span></a>
				<a href="{{ route('healthIssueListing') }}" title="Issue Details"><i class="fa fa-list"></i> <span> Health Issues List</span></a>
				@endif 
				@if(Auth::user()->id==2)
				<a href="{{ route('problemlist') }}" title="List">
					<i class="fa fa-list"></i> <span> Health Problems</span>
				</a>
				<a href="{{ route('levellist') }}" title="List">
					<i class="fa fa-list"></i> <span> Levels</span>
				</a>  
				@endif  
			</li>
			
			@if(Request::segment(1) === 'profile')

			<li class="{{ Request::segment(1) === 'profile' ? 'active' : null }}">
				<a href="{{ route('profile') }}" title="Profile"><i class="fa fa-user"></i> <span> PROFILE</span></a>
			</li>

			@endif
			@if(Auth::user()->id==2)
			<li class="treeview 
				{{ Request::segment(1) === 'config' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'user' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'role' ? 'active menu-open' : null }}
				">
				<a href="#">
					<i class="fa fa-gear"></i>
					<span>SETTINGS</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@if (Auth::user()->can('root-dev', ''))
						<li class="{{ Request::segment(1) === 'config' && Request::segment(2) === null ? 'active' : null }}">
							<a href="{{ route('config') }}" title="App Config">
								<i class="fa fa-gear"></i> <span> Settings App</span>
							</a>
						</li>
					@endif					
					<li class="
						{{ Request::segment(1) === 'user' ? 'active' : null }}
						{{ Request::segment(1) === 'role' ? 'active' : null }}
						">
						<a href="{{ route('user') }}" title="Users">
							<i class="fa fa-user"></i> <span> Users</span>
						</a>
					
					</li>
				</ul>
			</li>  
			@endif    
		</ul>
	</section>
</aside>