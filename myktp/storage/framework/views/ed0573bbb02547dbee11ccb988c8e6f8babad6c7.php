<?php $__env->startSection('content'); ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><b>EDIT PENGGUNA</b></h3><br>
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
                    <h2><?php echo e(ucfirst($pengguna->first_name)); ?> <?php echo e(ucfirst($pengguna->last_name)); ?></h2>
                    <ul class="nav navbar-right">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo Form::model($pengguna, ['route'=>['pengguna.update', $pengguna->id], 'method'=> 'PATCH', 'id'=>'demo-form2', 'data-parsley-validate class'=>'form-horizontal form-label-left']); ?>

                    <form>
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Depan
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="first_name" required="required" placeholder="Nama Depan" class="form-control col-md-7 col-xs-12" value="<?php echo e($pengguna->first_name); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nama Belakang
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last_name" required="required" placeholder="Nama Belakang" class="form-control col-md-7 col-xs-12" value="<?php echo e($pengguna->last_name); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">NPM</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" placeholder="NPM" class="form-control col-md-7 col-xs-12" type="text" name="npm" value="<?php echo e($pengguna->npm); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Studi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="middle-name" name="prodi" placeholder="Program Studi" class="form-control col-md-7 col-xs-12">
                            <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($data->id); ?>" <?php if($data->id == $pengguna->prodi_id) echo "selected";?>><?php echo e($data->prodi_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Role Pengguna</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="middle-name" name="role" placeholder="Role Pengguna" class="form-control col-md-7 col-xs-12">
                            <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($data->role_id); ?>" <?php if($data->role_id == $pengguna->role_id) echo "selected";?>><?php echo e($data->role_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="L" <?php if($pengguna->gender == "L") echo "checked"; ?>> &nbsp; Laki-Laki &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="P" <?php if($pengguna->gender == "P") echo "checked"; ?>> Perempuan
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir</label>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                          <input type="date" name="born_date" class="date-picker form-control col-md-7 col-xs-12" required="required" value="<?php echo e(Auth::User()->born_date); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Alamat
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" name="address" required="required" placeholder="Alamat" class="form-control col-md-7 col-xs-12"><?php echo e($pengguna->address); ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="email" required="required" placeholder="Email" class="form-control col-md-7 col-xs-12" value="<?php echo e($pengguna->email); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nomor Telepon</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="contact_number" required="required" placeholder="Nomor Telepon" class="form-control col-md-7 col-xs-12" value="<?php echo e($pengguna->contact_number); ?>">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="line_id" placeholder="Id Line" class="form-control col-md-7 col-xs-12" value="<?php echo e($pengguna->line_id); ?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                          <a href="<?php echo e(route('pengguna.index')); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> Batal</a>
                          <form method="POST" action="<?php echo e(route('pengguna.destroy', $pengguna->id)); ?>" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                              <input type="submit" class="btn btn-warning" onclick="return confirm('AApakah Yakin Ingin Menghapus Data Pengguna?');" value="Hapus">
                          </form>
                        </div>
                      </div>
                    </form>
                    <?php echo Form::close(); ?>

                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>