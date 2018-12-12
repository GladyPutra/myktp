<?php $__env->startSection('custom_css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>PENGATURAN</h3><br>
              </div>
              <div class="title_left">
                <h3></h3><br>
              </div>
              <a href="<?php echo e(route('pengaturan.index')); ?>" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh</a>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Program Studi</h2>
                    <ul class="nav navbar-right">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo e(route('pengaturan.store_prodi')); ?>" files="true" method="post" class="form-horizontal form-label-left input_mask">
                      <?php echo e(csrf_field()); ?>

                      <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                        <input type="text" name="nama_prodi" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Program Studi" required="" value="<?php echo e(old('nama_prodi')); ?>">
                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" name="singkatan" class="form-control" id="inputSuccess2" placeholder="Singkatan" required="" value="<?php echo e(old('singkatan')); ?>">
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                        <input type="text" name="nama_fakultas" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Fakultas" required="" value="<?php echo e(old('nama_fakultas')); ?>">
                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1 col-sm-1 col-xs-8 form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                      </div>
                      <div class="ln_solid"></div>
                    </form>
                  </div>
                  <div class="x_panel">
                    <div class="x_content">
                  <?php if($prodi->count()): ?>
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <?php $no=1; ?>
                            <td align="center"><b>No.</b></td>
                            <td align="center"><b>Program Studi</b></td>
                            <td align="center"><b>Fakultas</b></td>
                            <td align="center"><b>Singkatan</b></td>
                            <td align="center"><b>Kontrol</b></td>
                          </tr>
                        </thead>
                        <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td align="center" width = "20"> <?php echo e($no++); ?> </td>
                              <td><?php echo e($data->prodi_name); ?></td>
                              <td><?php echo e($data->fakultas_name); ?></td>
                              <td><?php echo e($data->singkatan); ?></td>
                              <td align="center">
                                <form method="POST" action="<?php echo e(route('pengaturan.destroy_prodi', $data->id)); ?>" accept-charset="UTF-8">
                                  <input name="_method" type="hidden" value="DELETE">
                                  <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                                    <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Program Studi?');" value="Hapus">
                                </form>
                              </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </table>
                    </div>
                    <!-- PAGINATION -->
                   <?php echo $prodi->links(); ?>

                  <?php else: ?>
                    <p>Data Tidak Tersedia</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jabatan (Role Pengguna)</h2>
                    <ul class="nav navbar-right">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="x_content">
                      <form action="<?php echo e(route('pengaturan.store_role')); ?>" files="true" method="post" class="form-horizontal form-label-left input_mask">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" name="nama_role" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nama Role" required="" value="<?php echo e(old('nama_role')); ?>">
                          <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <input type="text" name="role_id" class="form-control" id="inputSuccess2" placeholder="Kode" required="" value="<?php echo e(old('role_id')); ?>">
                        </div>

                        <div class="col-md-1 col-sm-1 col-xs-8 form-group">
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                        </div>
                        <div class="ln_solid"></div>
                      </form>
                    </div>
                    <div class="x_panel">
                      <div class="x_content">
                    <?php if($role->count()): ?>
                        <table id="datatable" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <?php $no=1; ?>
                              <td align="center"><b>No.</b></td>
                              <td align="center"><b>Kode</b></td>
                              <td align="center"><b>Nama Role</b></td>
                              <td align="center"><b>Kontrol</b></td>
                            </tr>
                          </thead>
                          <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <td align="center" width = "20"> <?php echo e($no++); ?> </td>
                                <td><?php echo e($data->role_id); ?></td>
                                <td><?php echo e($data->role_name); ?></td>
                                <td align="center">
                                  <form method="POST" action="<?php echo e(route('pengaturan.destroy_role', $data->id)); ?>" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                                      <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Program Studi?');" value="Hapus">
                                  </form>
                                </td>
                              </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                      </div>
                      <!-- PAGINATION -->
                     <?php echo $role->links(); ?>

                    <?php else: ?>
                      <p>Data Tidak Tersedia</p>
                      </div>
                    <?php endif; ?>
                  </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kategori Berkas PKM</h2>
                    <ul class="nav navbar-right">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo e(route('pengaturan.store_berkas')); ?>" files="true" method="post" class="form-horizontal form-label-left input_mask">
                      <?php echo e(csrf_field()); ?>

                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" name="nama_kategori" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nama Kategori" required="" value="<?php echo e(old('nama_kategori')); ?>">
                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-8 form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                      </div>
                      <div class="ln_solid"></div>
                    </form>
                  </div>
                  <div class="x_panel">
                    <div class="x_content">
                  <?php if($kategori_berkas->count()): ?>
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <?php $no=1; ?>
                            <td align="center"><b>No.</b></td>
                            <td align="center"><b>Nama Kategori Berkas</b></td>
                            <td align="center"><b>Kontrol</b></td>
                          </tr>
                        </thead>
                        <?php $__currentLoopData = $kategori_berkas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td align="center" width = "20"> <?php echo e($no++); ?> </td>
                              <td><?php echo e($data->nama_kategori); ?></td>
                              <td align="center">
                                <form method="POST" action="<?php echo e(route('pengaturan.destroy_kategori', $data->id)); ?>" accept-charset="UTF-8">
                                  <input name="_method" type="hidden" value="DELETE">
                                  <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                                    <input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Kategori Berkas?');" value="Hapus">
                                </form>
                              </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </table>
                    </div>
                    <!-- PAGINATION -->
                   <?php echo $kategori_berkas->links(); ?>

                  <?php else: ?>
                    <p>Data Tidak Tersedia</p>
                    </div>
                  <?php endif; ?>
                </div>
                </div>
              </div>


              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bidang PKM</h2>
                    <ul class="nav navbar-right">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <div class="form-group">
                      <?php if($bidang_pkm->count()): ?>
                          <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <?php $no=1; ?>
                                <td align="center"><b>No.</b></td>
                                <td align="center"><b>Singkatan</b></td>
                                <td align="center"><b>Bidang PKM</b></td>
                                <td align="center"><b>Kontrol</b></td>
                              </tr>
                            </thead>
                            <?php $__currentLoopData = $bidang_pkm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td align="center" width = "20"> <?php echo e($no++); ?> </td>
                                  <td><?php echo e($data->singkatan); ?></td>
                                  <td><?php echo e($data->bidang_pkm); ?></td>
                                  <td align="center">
                                    <form method="POST" action="<?php echo e(route('pengaturan.aktifkan', $data->id)); ?>" accept-charset="UTF-8">
                                      <input name="_method" type="hidden" value="DELETE">
                                      <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                                      <?php if($data->status == 1): ?>
                                        <input type="submit" class="btn btn-success btn-xs" value="Aktif">
                                      <?php else: ?>
                                        <input type="submit" class="btn btn-danger btn-xs" value="Non">
                                      <?php endif; ?>
                                    </form>


                                  </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </table>
                        </div>
                        <!-- PAGINATION -->
                       <?php echo $bidang_pkm->links(); ?>

                      <?php else: ?>
                        <p>Data Tidak Tersedia</p>
                        </div>
                      <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>