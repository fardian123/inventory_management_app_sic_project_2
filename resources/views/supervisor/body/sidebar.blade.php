<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('backend/assets/images/inventorylogo.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">supervisor</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		<li>
			<a href="{{route('supervisor.dashboard')}}">
				<div class="parent-icon"><i class='bx bx-home-alt'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>


		<li class="menu-label">Inventory</li>

		<li>
			<a href="{{route('supervisor.inventory.management')}}">
				<div class="parent-icon"><i class='bx bx-package'></i>
				</div>
				<div class="menu-title">Manage Inventory</div>
			</a>
		</li>
		<li class="menu-label">Laporan</li>

		<li>
			<a href="{{route('supervisor.inventory.report')}}">
				<div class="parent-icon"><i class='bx bx-receipt'></i>
				</div>
				<div class="menu-title">Buat Laporan</div>
			</a>
		</li>
		

		
	</ul>
	
	
	

	
	<!--end navigation-->
</div>