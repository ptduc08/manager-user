<div class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="side-menu">
			<!-- ------------------------ o tim kiem ---------------------------- -->
			<!--
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="<?php echo $this->translate('admin-cp-search'); ?>">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<i class="fa fa-search"></i>
					</button>
					</span>
				</div>
			</li> -->
                        
			<li>
				<a href="<?php echo $this->baseUrl('/admin/index/index'); ?>">
					<i class="fa fa-dashboard fa-fw"></i> <?php echo $this->translate('menu-dashboard'); ?>
				</a>
			</li>
			<li>
				<a href="#"><i class="fa fa-bars fa-fw"></i> <?php echo $this->translate('Excel file'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-excel/index'); ?>">
								<i class="fa fa-bars fa-fw"></i>
								<?php echo $this->translate('Export excel'); ?>
							</a>
						</li>
						
					</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $this->translate('menu-member-usermanager'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-user/index'); ?>">
								<i class="fa fa-user fa-fw"></i>
								<?php echo $this->translate('menu-member-usermanager'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-group/index'); ?>">
								<i class="fa fa-user fa-fw"></i>
								<?php echo $this->translate('menu-member-groupmanager'); ?>
							</a>
						</li>
					</ul>
			</li>
			
		</ul>
		<!-- /#side-menu -->
	</div>
	<!-- /.sidebar-collapse -->
</div>