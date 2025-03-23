<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

	

		<!--start page wrapper -->
		<div class="page-wrapper category-list">
			<div class="page-content">


				<div class="card radius-10">
					<div class="card-header border-bottom-0 bg-transparent">
						<div class="d-flex align-items-center">
							<div>
								<h3 class="font-weight-bold mb-0">Recent Orders</h3>
							</div>
							<div class="ms-auto">
								<button type="button" class="btn btn-white radius-10">View More</button>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table mb-0 align-middle" id="ordersTable">
								<thead>
									<tr>
										<th>Photo</th>
										<th>Product Name</th>
										<th>Customer</th>
										<th>Product id</th>
										<th>Price</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/shoes.png" class="p-1" alt="">
											</div>
										</td>
										<td>Nike Sports NK</td>
										<td>Mitchell Daniel</td>
										<td>#9668521</td>
										<td>$99.85</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
										</td>
									</tr>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/smartphone.png" class="p-1" alt="">
											</div>
										</td>
										<td>Redmi Airdts</td>
										<td>Craig Clayton</td>
										<td>#8627523</td>
										<td>$59.35</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-danger radius-30">Cancelled</a>
										</td>
									</tr>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/mouse.png" class="p-1" alt="">
											</div>
										</td>
										<td>Magic Mouse 2</td>
										<td>Julia Burke</td>
										<td>#6875954</td>
										<td>$42.68</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-warning radius-30">Pending</a>
										</td>
									</tr>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/tshirt.png" class="p-1" alt="">
											</div>
										</td>
										<td>Coton-T-Shirt</td>
										<td>Clark Natela</td>
										<td>#4587892</td>
										<td>$32.78</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
										</td>
									</tr>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/headphones.png" class="p-1" alt="">
											</div>
										</td>
										<td>Headphones 7</td>
										<td>Robin Mandela</td>
										<td>#5587426</td>
										<td>$29.52</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
										</td>
									</tr>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/mouse.png" class="p-1" alt="">
											</div>
										</td>
										<td>Magic Mouse 2</td>
										<td>Julia Burke</td>
										<td>#6875954</td>
										<td>$42.68</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-warning radius-30">Pending</a>
										</td>
									</tr>
									<tr>
										<td>
											<div class="product-img bg-transparent border">
												<img src="<?=base_url()?>assets/images/icons/tshirt.png" class="p-1" alt="">
											</div>
										</td>
										<td>Coton-T-Shirt</td>
										<td>Clark Natela</td>
										<td>#4587892</td>
										<td>$32.78</td>
										<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>

				</div>

			</div>
		</div>

		<!--end page wrapper -->

		<script>




    $(document).ready(function() {
        // Destroy any existing DataTable instance before initializing
        if ($.fn.DataTable.isDataTable("#ordersTable")) {
            $('#ordersTable').DataTable().destroy();
        }

        // Initialize DataTable
        $('#ordersTable').DataTable({
            "paging": true, 
            "lengthMenu": [4, 10, 25, 50], 
            "pageLength": 4, 
            "ordering": true, 
            "info": true,  
            "searching": true, 
            "language": {
                "paginate": {
                    "previous": "&laquo;", 
                    "next": "&raquo;"
                }
            }
        });
    });
</script>

