<?php $__env->startSection('content'); ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><b>DETAIL CITIZEN</b></h3><br>
              </div>

              <div class="title_right">
                <!--  -->
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Fullname: <?php echo e($citizen['fullname']); ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">NIK</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['nik']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Gender</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['gender']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Place and Birth Date</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['place_of_birth']); ?>, <?php echo e(date('d F Y', strtotime($citizen['birth_date']))); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Type of Blood</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['type_blood']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Address</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['address']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Job</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['job']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Status</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['the_status']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">State</label>
                        <div class="col-md-6 col-sm-6"><label>: <?php echo e($citizen['state']); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Image</label>
                        <div class="col-md-6 col-sm-6">
                          <label>:<br>

                          </label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
                  </div>
                </div>

  <!-- /page content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>