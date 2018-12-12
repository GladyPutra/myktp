<?php $__env->startSection('content'); ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><b>DETAIL PENDUDUK</b></h3><br>
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
                    <h2>Nama Penduduk: <?php echo e($citizen['fullname']); ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <?php echo Form::model($citizen, ['route'=>['update', $citizen->id], 'method'=> 'PATCH', 'id'=>'demo-form2', 'data-parsley-validate class'=>'form-horizontal form-label-left']); ?>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fullname
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="fullname" required="required" placeholder="Fullname" class="form-control col-md-7 col-xs-12" value="<?php echo e($citizen['fullname']); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NIK
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="nik" required="required" placeholder="NIK" class="form-control col-md-7 col-xs-12" value="<?php echo e($citizen['nik']); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="L" <?php if($citizen['gender'] == "Male") echo "checked"; ?>> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="P" <?php if($citizen['gender'] == "Female") echo "checked"; ?>> Female
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Place of Birth
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="place_of_birth" required="required" placeholder="Place of Birth" class="form-control col-md-7 col-xs-12" value="<?php echo e($citizen['place_of_birth']); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Birth Date
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="last-name" name="birth_date" required="required" placeholder="Birth Date" class="form-control col-md-7 col-xs-12" value="<?php echo e($citizen['birth_date']); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type of Blood</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="middle-name" name="type_blood" placeholder="Type of Blood" class="form-control col-md-7 col-xs-12">
                            <option value="A" <?php if($citizen['type_blood'] == "A") echo "selected";?>>A</option>
                            <option value="B" <?php if($citizen['type_blood'] == "B") echo "selected";?>>B</option>
                            <option value="AB" <?php if($citizen['type_blood'] == "AB") echo "selected";?>>AB</option>
                            <option value="O" <?php if($citizen['type_blood'] == "O") echo "selected";?>>O</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" name="address" required="required" placeholder="Address" class="form-control col-md-7 col-xs-12"><?php echo e($citizen['address']); ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Job
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="job" required="required" placeholder="Place of Birth" class="form-control col-md-7 col-xs-12" value="<?php echo e($citizen['job']); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="Married" <?php if($citizen['the_status'] == "Married") echo "checked"; ?>> &nbsp; Married &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="Single" <?php if($citizen['the_status'] == "Single") echo "checked"; ?>> Single
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="state" value="WNI" <?php if($citizen['state'] == "WNI") echo "checked"; ?>> &nbsp; WNI &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="state" value="WNA" <?php if($citizen['state'] == "WNA") echo "checked"; ?>> WNA
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                          <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                      </div>
                    </form>
                    <?php echo Form::close(); ?>

                  </div>
                </div>
              </div>
            </div>
                  </div>
                </div>

  <!-- /page content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>