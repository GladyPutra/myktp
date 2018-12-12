<?php $__env->startSection('content'); ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><b>DETAIL PENGGUNA</b></h3><br>
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
                    <h2><?php echo e(ucfirst($pengguna->first_name)); ?> <?php echo e(ucfirst($pengguna->last_name)); ?><small> | <?php echo e($pengguna->role['role_name']); ?></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="col-xs-2" for="first-name">Nama Depan</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e(ucfirst($pengguna->first_name)); ?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Nama Belakang</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e(ucfirst($pengguna->last_name)); ?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Jenis Kelamin</label>
                        <div class="col-xs-2">
                          <label for="last-name">:
                            <?php if($pengguna->gender == "L"): ?>
                              Laki-Laki
                            <?php else: ?>
                              Perempuan
                            <?php endif; ?>
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">NPM / NIDN</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e($pengguna->npm); ?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Role</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e($pengguna->role['role_name']); ?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Program Studi</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e($pengguna->prodi['prodi_name']); ?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Tanggal Lahir</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e(date('d F Y', strtotime($pengguna->born_date))); ?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Alamat</label>
                        <div><label class="col-xs-10">: <?php echo e($pengguna->address); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Email</label>
                        <div><label class="col-xs-10">: <?php echo e($pengguna->email); ?></label></div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2" for="last-name">Username</label>
                        <div class="col-xs-2">
                          <label for="last-name">: <?php echo e($pengguna->username); ?></label>
                        </div>
                      </div>
                    </form>
                    <form method="POST" action="<?php echo e(route('pengguna.reset_password', $pengguna->id)); ?>" accept-charset="UTF-8">
                      <input name="_method" type="hidden" value="DELETE">
                      <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                        <input type="submit" class="btn btn-primary btn-xs" onclick="return confirm('AApakah Yakin Ingin Reset Password Pengguna?');" value="Reset Password">
                        <a href="<?php echo e(route('pengguna.index')); ?>" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
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