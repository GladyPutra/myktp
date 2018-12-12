<?php $__env->startSection('custom_css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><b>PENGATURAN ACCOUNT PENGUSUL</b></h3><br>
              </div>

              <div class="title_right">
                <!--  -->
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Account KKM</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">

                          <!-- ===================== TAB 1 =============================== -->
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  <div class="x_content">
                                    <br>
                                  <form action="<?php echo e(route('pengusul.reset_password')); ?>" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                      <label class="col-xs-2" >Nama Depan</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->first_name); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Nama Belakang</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->last_name); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Jenis Kelamin</label>
                                      <div class="col-md-6 col-sm-6"><label>:
                                        <?php if(Auth::User()->gender == "L"): ?>
                                          Laki-Laki
                                        <?php else: ?>
                                          Perempuan
                                        <?php endif; ?>
                                      </label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">NPM</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->npm); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Program Studi</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->prodi['prodi_name']); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Fakultas</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->prodi['fakultas_name']); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Tanggal Lahir</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->born_date); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Email</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->email); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Username</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->username); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Alamat</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->address); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Nomor HP</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->contact_number); ?></label></div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-xs-2" for="last-name">Id Line</label>
                                      <div class="col-md-6 col-sm-6"><label>: <?php echo e(Auth::User()->line_id); ?></label></div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-xs-2" for="first-name">Password
                                      </label>
                                      <div class="col-md-6 col-sm-6">
                                        <input type="password" id="first-name" name="password_dikti" required="required" placeholder="Password Simbelmawa" class="form-control col-md-7 col-xs-12" value="<?php echo e(Auth::User()->password); ?>">
                                      </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Reset Password</button>
                                      </div>
                                    </div>
                                  </form>
                                  </div>
                              </div>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- /page content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_peserta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>