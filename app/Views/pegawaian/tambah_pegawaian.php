<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_tambah_pegawaian')?>" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK<span style="color: red;">*</span></label>
                            <input type="number" id="nik" name="nik" class="form-control text-capitalize" placeholder="NIK">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pegawai<span style="color: red;">*</span></label>
                            <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control text-capitalize" placeholder="Nama Pegawai">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan <span class="required"></span></label>
                            <select  name="id_jabatan" class="form-control text-capitalize" id="id_jabatan" required>
                                <option>Pilih Jabatan</option>
                                <?php 
                                foreach ($j as $jabatan) {
                                    ?>
                                    <option class="text-capitalize" value="<?php echo $jabatan->id_jabatan ?>"><?php echo $jabatan->nama_jabatan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tempat Tanggal Lahir<span style="color: red;">*</span></label>
                            <input type="text" id="ttl" name="ttl" class="form-control text-capitalize" placeholder="Tempat Tanggal Lahir">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin<span style="color: red;">*</span></label>
                            <select id="jk" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="jk" required="required">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail<span style="color: red;">*</span></label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username<span style="color: red;">*</span></label>
                            <input type="text" id="username" name="username" class="form-control text-capitalize" placeholder="Username">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Level<span style="color: red;">*</span></label>
                            <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
                                <option>Select Level</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Guru</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('/home/pegawaian')?>" type="submit" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
