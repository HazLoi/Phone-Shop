<?php /* Smarty version Smarty-3.1.18, created on 2025-02-17 22:42:27
         compiled from "D:\a_project_2024\General\admin\templates\project01\manage\page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176601372967b358e3b8cce6-53602971%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9f614055c510e798d88ed3baf24db5eb010035d' => 
    array (
      0 => 'D:\\a_project_2024\\General\\admin\\templates\\project01\\manage\\page.tpl',
      1 => 1708100004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176601372967b358e3b8cce6-53602971',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpldirect' => 0,
    'domain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67b358e3bb0483_83013607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67b358e3bb0483_83013607')) {function content_67b358e3bb0483_83013607($_smarty_tpl) {?><div class="layout-page">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpldirect']->value)."menu/search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="content-wrapper">
		<div class="container-xxl flex-grow-1 container-p-y">
			<div class="row">
				<div class="col-lg-8 mb-4 order-0">
					<div class="card">
						<div class="d-flex align-items-end row">
							<div class="col-sm-7">
								<div class="card-body">
									<h5 class="card-title text-primary">Congratulations John! 🎉</h5>
									<p class="mb-4">
										You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
										your profile.
									</p>

									<a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
								</div>
							</div>
							<div class="col-sm-5 text-center text-sm-left">
								<div class="card-body pb-0 px-0 px-md-4">
									<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/assets/img/illustrations/man-with-laptop-light.png" height="140"
										alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
										data-app-light-img="illustrations/man-with-laptop-light.png" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 order-1">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/assets/img/icons/unicons/chart-success.png"
												alt="chart success" class="rounded" />
										</div>
										<div class="dropdown">
											<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<i class="bx bx-dots-vertical-rounded"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
												<a class="dropdown-item" href="javascript:void(0);">View More</a>
												<a class="dropdown-item" href="javascript:void(0);">Delete</a>
											</div>
										</div>
									</div>
									<span class="fw-medium d-block mb-1">Profit</span>
									<h3 class="card-title mb-2">$12,628</h3>
									<small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
												class="rounded" />
										</div>
										<div class="dropdown">
											<button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<i class="bx bx-dots-vertical-rounded"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
												<a class="dropdown-item" href="javascript:void(0);">View More</a>
												<a class="dropdown-item" href="javascript:void(0);">Delete</a>
											</div>
										</div>
									</div>
									<span>Sales</span>
									<h3 class="card-title text-nowrap mb-1">$4,679</h3>
									<small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Total Revenue -->
				<div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
					<div class="card">
						<div class="row row-bordered g-0">
							<div class="col-md-8">
								<h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
								<div id="totalRevenueChart" class="px-2"></div>
							</div>
							<div class="col-md-4">
								<div class="card-body">
									<div class="text-center">
										<div class="dropdown">
											<button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
												id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false">
												2022
											</button>
											<div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
												<a class="dropdown-item" href="javascript:void(0);">2021</a>
												<a class="dropdown-item" href="javascript:void(0);">2020</a>
												<a class="dropdown-item" href="javascript:void(0);">2019</a>
											</div>
										</div>
									</div>
								</div>
								<div id="growthChart"></div>
								<div class="text-center fw-medium pt-3 mb-2">62% Company Growth</div>

								<div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
									<div class="d-flex">
										<div class="me-2">
											<span class="badge bg-label-primary p-2"><i
													class="bx bx-dollar text-primary"></i></span>
										</div>
										<div class="d-flex flex-column">
											<small>2022</small>
											<h6 class="mb-0">$32.5k</h6>
										</div>
									</div>
									<div class="d-flex">
										<div class="me-2">
											<span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
										</div>
										<div class="d-flex flex-column">
											<small>2021</small>
											<h6 class="mb-0">$41.2k</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ Total Revenue -->
				<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
					<div class="row">
						<div class="col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/assets/img/icons/unicons/paypal.png" alt="Credit Card"
												class="rounded" />
										</div>
										<div class="dropdown">
											<button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<i class="bx bx-dots-vertical-rounded"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
												<a class="dropdown-item" href="javascript:void(0);">View More</a>
												<a class="dropdown-item" href="javascript:void(0);">Delete</a>
											</div>
										</div>
									</div>
									<span class="d-block mb-1">Payments</span>
									<h3 class="card-title text-nowrap mb-2">$2,456</h3>
									<small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
								</div>
							</div>
						</div>
						<div class="col-6 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="card-title d-flex align-items-start justify-content-between">
										<div class="avatar flex-shrink-0">
											<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
												class="rounded" />
										</div>
										<div class="dropdown">
											<button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<i class="bx bx-dots-vertical-rounded"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="cardOpt1">
												<a class="dropdown-item" href="javascript:void(0);">View More</a>
												<a class="dropdown-item" href="javascript:void(0);">Delete</a>
											</div>
										</div>
									</div>
									<span class="fw-medium d-block mb-1">Transactions</span>
									<h3 class="card-title mb-2">$14,857</h3>
									<small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 mb-4">
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
										<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
											<div class="card-title">
												<h5 class="text-nowrap mb-2">Profile Report</h5>
												<span class="badge bg-label-warning rounded-pill">Year 2021</span>
											</div>
											<div class="mt-sm-auto">
												<small class="text-success text-nowrap fw-medium"><i class="bx bx-chevron-up"></i>
													68.2%</small>
												<h3 class="mb-0">$84,686k</h3>
											</div>
										</div>
										<div id="profileReportChart"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="content-backdrop fade"></div>
	</div>
</div><?php }} ?>
