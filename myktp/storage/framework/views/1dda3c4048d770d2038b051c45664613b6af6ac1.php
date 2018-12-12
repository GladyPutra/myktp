<?php $__env->startSection('content'); ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>DATA WARGA NEGARA INDONESIA <small></small></h3>
      </div>

      <div class="title_right">
        <?php echo Form::open(['method'=>'GET','url'=>'/peserta-pkm/search']); ?>

        <div class="col-md-8 col-sm-8 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pencarian...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">Cari</button>
              <a href="<?php echo e(route('trainweb')); ?>" class="btn btn-primary btn-xs"><i class="fa fa-globe"></i> Train From Web</a>
              <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</a>
            </span>
          </div>
        </div>
        <?php echo Form::close(); ?>

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
              <div class="clearfix">Jumlah Warga Negara: <b><?php echo e($citizen->count()); ?> </b></div>
            </div>
            <div class="x_content">
          <?php if($citizen->count()): ?>
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <?php $no=1; ?>
                    <td align="center"><b>No.</b></td>
                    <td align="center"><b>Fullname</b></td>
                    <td align="center"><b>NIK</b></td>
                    <td align="center"><b>Gender</b></td>
                    <td align="center"><b>Place of Birth</b></td>
                    <td align="center"><b>Birth Date</b></td>
                    <td align="center"><b>State</b></td>
                    <td align="center"><b>Status</b></td>
                    <td align="center"><b>Kontrol</b></td>
                  </tr>
                </thead>
                <?php $__currentLoopData = $citizen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td align="center" width="30px"> <?php echo e($no++); ?> </td>
                      <td width="300px"><?php echo e(ucwords($data->fullname)); ?></td>
                      <td width="200px"><?php echo e(ucwords($data->nik)); ?></td>
                      <td width="70px"><?php echo e(ucwords($data->gender)); ?></td>
                      <td width="150px"><?php echo e(ucwords($data->place_of_birth)); ?></td>
                      <td width="150px"><?php echo e(date('F d, Y', strtotime($data->birth_date))); ?></td>
                      <td width="70px"><?php echo e($data->state); ?></td>
                      <td width="70px"><?php echo e($data->the_status); ?></td>
                      <td align="center">
                        <form method="POST" action="<?php echo e(route('destroy', $data->id)); ?>" accept-charset="UTF-8">
                          <input name="_method" type="hidden" value="DELETE">
                          <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                            <a href="<?php echo e(route('detail', $data->id)); ?>" class="btn btn-default btn-xs"><i class="fa fa-info-circle"></i> Detail</a>
                            <a href="<?php echo e(route('edit', $data->id)); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Edit</a>
                            <input type="submit" class="btn btn-warning btn-xs" onclick="return confirm('Are You Sure?');" value="Hapus">
                        </form>
                      </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </table>
            </div>
            <!-- PAGINATION -->
           <?php echo $citizen->links(); ?>

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