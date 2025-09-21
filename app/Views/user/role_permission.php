          <div class="container-xxl flex-grow-1 container-p-y">


              <div class="row g-4">


                  <div class="card">


                      <form id="addRoleForm" class="row g-3" action="<?php echo site_url(); ?>User/add_role" method="POST">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <label class="form-label" for="modalRoleName">Role Name</label>
                                      <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                                  </div>
                                  <div class="col-md-6">
                                      <label class="form-label" for="modalRoleName">Role Description</label>
                                      <input type="text" id="role_desc" name="role_desc" class="form-control" placeholder="Enter a role description" tabindex="-1" />
                                  </div>
                              </div>
                          </div>
                          <h5 class="card-header pb-1">Role Permission</h5>
                          <div class="table-responsive">
                              <table class="table table-striped border-top">
                                  <thead>
                                      <tr>
                                          <th class="text-nowrap">Module/Permissions</th>
                                          <th class="text-nowrap text-center">Read</th>
                                          <th class="text-nowrap text-center">Create</th>
                                          <th class="text-nowrap text-center">Edit</th>
                                          <th class="text-nowrap text-center">Delete</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($permission_list as $key => $value) { ?>
                                          <tr>
                                              <td class="text-nowrap"><?php echo $value['name']; ?></td>
                                              <td>
                                                  <div class="form-check d-flex justify-content-center">
                                                      <input class="form-check-input" type="checkbox" name="permission_read[<?php echo $value['id']; ?>]" id="permission_read<?php echo $value['id']; ?>" value="YES" checked />
                                                  </div>
                                              </td>
                                              <td>
                                                  <div class="form-check d-flex justify-content-center">
                                                      <input class="form-check-input" type="checkbox" name="permission_create[<?php echo $value['id']; ?>]" id="permission_create<?php echo $value['id']; ?>" value="YES" checked />
                                                  </div>
                                              </td>
                                              <td>
                                                  <div class="form-check d-flex justify-content-center">
                                                      <input class="form-check-input" type="checkbox" name="permission_edit[<?php echo $value['id']; ?>]" id="permission_edit<?php echo $value['id']; ?>" value="YES" checked />
                                                  </div>
                                              </td>
                                              <td>
                                                  <div class="form-check d-flex justify-content-center">
                                                      <input class="form-check-input" type="checkbox" name="permission_del[<?php echo $value['id']; ?>]" id="permission_del<?php echo $value['id']; ?>" value="YES" checked />
                                                  </div>
                                              </td>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                          <div class="card-body">

                              <div class="row">

                                  <div class="mt-3">
                                      <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                      <a href="<?php echo site_url(); ?>User/role" class="btn btn-label-secondary">Cancel</a>
                                  </div>
                              </div>

                          </div>
                      </form>

                  </div>

              </div>


          </div>