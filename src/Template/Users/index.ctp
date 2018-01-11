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
                      <header class="panel-heading">Users</header>
		                  <div class="panel-body">
					               <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Username</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Email</th>
                                  <th>Gender</th>
                                  <th>Role</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($users as $user): ?>
				                        <tr>
                                  <td><?= $user->user_id ?></td>
                                  <td><?= $user->username ?></td>
                                  <td><?= $user->first_name ?></td>
                                  <td><?= $user->last_name ?></td>
                                  <td><?= $user->email ?></td>
                                  <td><?= $user->gender ?></td>
                                  <td><?= $user->role ?></td>
                                  <td><?php if($user->status == 1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                                  <td>
                                      <a class="btn btn-primary" href="#"><i class="icon_pencil-edit"></i></a>
                                      <a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </td>
                                </tr>
				                        <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>

		                      <div class="text-center">
		                          <ul class="pagination pagination-lg">
                                <?php
                            		// Pagination urls
                            			echo $this->Paginator->prev('< ' . __('previous'));
                            			echo $this->Paginator->numbers();
                            			echo $this->Paginator->next(__('next') . ' >');
                            		?>
		                             
		                          </ul>
		                      </div>
		                  </div>
		              </section>
		              <!--pagination end-->
</div></div>
</section>
</section>
</section>
