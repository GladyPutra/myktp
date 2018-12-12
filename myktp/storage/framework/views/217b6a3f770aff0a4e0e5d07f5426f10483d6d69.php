<?php $__env->startSection('content'); ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>DAFTAR PENGURUS KKM UAJY <small></small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <ul class="nav navbar-right">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
          <?php if($pengurus->count()): ?>
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <?php $no=1; ?>
                    <td align="center"><b>No.</b></td>
                    <td align="center"><b>Bidang</b></td>
                    <td align="center"><b>Pengusul</b></td>
                    <td align="center"><b>Judul</b></td>
                    <td align="center"><b>Kontrol</b></td>
                  </tr>
                </thead>
                <?php $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td align="center" width="30px"> <?php echo e($no++); ?> </td>
                      <td width="70px"><?php echo e($data->bidangpkm['singkatan']); ?></td>
                      <td width="300px"><b>Ketua: <?php echo e($data->pengusul['first_name']); ?> <?php echo e($data->pengusul['last_name']); ?> (<?php echo e($data->pengusul['npm']); ?>)</b><br>
                        Anggota:<br><?php $no2=1; ?>
                        <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dtanggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php echo e($no2++); ?>. <?php echo e($data->pengusul['']); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </td>
                      <td width="550px"> <?php echo e($data->judul_pkm); ?> </td>
                      <td align="center">
                        <form method="POST" action="<?php echo e(route('peserta.destroy', $data->id)); ?>" accept-charset="UTF-8">
                          <input name="_method" type="hidden" value="DELETE">
                          <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                            <a href="<?php echo e(route('peserta.show', $data->id)); ?>" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Detail</a>
                            <a target="_blank" href="<?php echo e(route('pengusul.read', $data->id)); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Berkas</a>
                            <a href="<?php echo e(route('peserta.setting', $data->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-gear"></i> Setting</a>
                            <input type="submit" class="btn btn-warning btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?');" value="Hapus">
                        </form>
                      </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </table>
            </div>
            <!-- PAGINATION -->
           <?php echo $pengurus->links(); ?>

          <?php else: ?>
              <div class="alert">
                  <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
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

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>