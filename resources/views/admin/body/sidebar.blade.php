<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('backend/assets/images/inventorylogo.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Admin</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		<li>
			<a href="{{route('admin.dashboard')}}">
				<div class="parent-icon"><i class='bx bx-home-alt'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>


		<li class="menu-label">Inventory</li>
		
		<li>
			<a href="{{route('admin.inventory.management')}}">
				<div class="parent-icon"><i class='bx bx-package'></i>
				</div>
				<div class="menu-title">Manage Inventory</div>
			</a>
		</li>
		<li>
			<a href="{{route('admin.inventory.history')}}">
				<div class="parent-icon"><i class='bx bx-history'></i>
				</div>
				<div class="menu-title">History</div>
			</a>
		</li>

		
	</ul>
	
	
	

	
	<!--end navigation-->
</div>