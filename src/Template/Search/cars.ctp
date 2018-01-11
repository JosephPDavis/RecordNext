<!-- container section start -->
<section id="container" class="">
<!--main content start-->
<section id="main-content">
  <section class="wrapper">            
      <!--overview start-->
		  <div class="row">
			<div class="col-lg-12">
			<!--pagination start-->
		              <section class="panel">
		                  <div class="panel-body">
					<div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Cat Id</th>
                                  <th>Type</th>
                                  <th>Make</th>
                                  <th>Model</th>
                                  <th>Year</th>
                                  <th>Mileage</th>
                                  <th>Price</th>
                                  <th>City</th>
                                  <th>State</th>
                                  <th>Zip</th>
                                  <th>Phone</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php  foreach ($cars as $car): ?>
				<tr>
                                  <td><?= $car['id'] ?></td>
                                  <td><?= $car['category_id'] ?></td>
                                  <td><?= $car['type'] ?></td>
                                  <td><?= $car['make'] ?></td>
                                  <td><?= $car['model'] ?></td>
                                  <td><?= $car['year'] ?></td>
				  <td><?= $car['mileage'] ?></td>
                                  <td><?= $car['price'] ?></td>
                                  <td><?= $car['city'] ?></td>
                                  <td><?= $car['state'] ?></td>
                                  <td><?= $car['zip'] ?></td>
				  <td><?= $car['phone'] ?></td>
                                </tr>
				<?php endforeach;  ?>
                              </tbody>
                            </table>
                          </div>

		                      <div class="text-center">
						<?php echo $getresponse = $this->MyPaginator->show_paginator($data, $rows, $page); ?>
		                      </div>
		                  </div>
		              </section>
		              <!--pagination end-->
</div></div>
</section>
</section>
</section>
