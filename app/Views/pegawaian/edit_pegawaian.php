<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_pegawaian')?>" method="post">
              <input type="hidden" name="id" value="<?= $jofinson->id_user ?>">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">NIK<span style="color: red;">*</span></label>
                        <input type="number" id="nik" name="nik" 
                        class="form-control text-capitalize" placeholder="NIK" value="<?= $jofinson->nik?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Pegawai<span style="color: red;">*</span></label>
                        <input type="text" id="nama_pegawai" name="nama_pegawai" 
                        class="form-control text-capitalize" placeholder="Nama Pegawai" value="<?= $jofinson->nama_pegawai?>">
                    </div>
                  <div class="mb-3 col-md-6">
                        <label class="control-label col-12">Jabatan <span class="required"></span>
                        </label>
                        <div class="col-12">
                            <select  name="id_jabatan" class="form-control text-capitalize" id="id_jabatan" required>
                             <option class="text-capitalize" value="<?= $jofinson->id_jabatan?>"><?= $jofinson->nama_jabatan?></option>
                              <?php 
                              foreach ($j as $jabatan) {
                                  ?>
                                  <option class="text-capitalize" value="<?php echo $jabatan->id_jabatan ?>"><?php echo $jabatan->nama_jabatan ?></option>
                              <?php } ?>
                          </select>
                      </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Tempat Tanggal Lahir<span style="color: red;">*</span></label>
                    <input type="text" id="ttl" name="ttl" 
                    class="form-control text-capitalize" placeholder="Tempat Tanggal Lahir" value="<?= $jofinson->ttl?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Jenis Kelamin<span style="color: red;">*</span></label>
                    <div class="col-12">
                        <select id="jk" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="jk" required="required">
                          <option class="text-uppercase" value="<?= $jofinson->jk?>"><?= $jofinson->jk?></option>
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                      </select>
                  </div>
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">E-mail<span style="color: red;">*</span></label>
                <input type="text" id="email" name="email" 
                class="form-control" placeholder="E-mail" value="<?= $jofinson->email?>">
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Username<span style="color: red;">*</span></label>
                <input type="text" id="username" name="username" 
                class="form-control text-capitalize" placeholder="Username" value="<?= $jofinson->username?>">
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Level<span style="color: red;">*</span></label>
                <div class="col-12">
                    <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
                      <option class="text-uppercase" value="<?= $jofinson->level?>"><?= $jofinson->level?></option>
                      <option value="1">Super Admin</option>
                      <option value="2">Admin</option>
                      <option value="3">Guru</option>
                  </select>
              </div>
          </div>
      </div>
      <a href="<?= base_url('/home/pegawaian')?>" type="submit" class="btn btn-primary">Cancel</a></button>
      <button type="submit" class="btn btn-success">Submit</button>
  </form>
</div>
</div>
</div>
</div>