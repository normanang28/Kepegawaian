<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate  action="<?= base_url('home/aksi_ganti_profile')?>" method="post">


                    <div class="row">
                        <div class="input-group">
                            <label class="control-label col-12">Replace New Profile<span style="color: red;">*</span></label>   
                            <div class="col-12 form-file">
                                <input type="file" name="foto" class="form-file-input form-control col-12">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">NIK<span style="color: red;">*</span></label>
                            <input type="text" id="nik" name="nik" 
                            class="form-control text-capitalize" placeholder="NIK" value="<?= $users->nik?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Lengkap<span style="color: red;">*</span></label>
                            <input type="text" id="nama_pegawai" name="nama_pegawai" 
                            class="form-control text-capitalize" placeholder="Nama Lengkap" value="<?= $users->nama_pegawai?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">E-mail<span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" id="email" name="email" placeholder="E-mail" required="required" class="form-control" value="<?= $users->email?>">
                            </div> 
                        </div>  
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12" >Jenis Kelamin<span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select id="jk" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="jk" required="required">
                              <option  value="<?= $users->jk?>"><?= $users->jk; ?></option>
                              <!-- <option>Select Gender</option> -->
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                      </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Tempat Tanggal Lahir<span style="color: red;">*</span></label>
                    <input type="text" id="ttl" name="ttl" 
                    class="form-control text-capitalize" placeholder="Tempat Tanggal Lahir" value="<?= $users->ttl?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Username<span style="color: red;">*</span></label>
                    <input type="text" id="username" name="username" 
                    class="form-control text-capitalize" placeholder="Username" value="<?= $use->username?>">
                </div>
            </div>
            <a onclick="history.back()" type="submit" class="btn btn-primary" style="color: white;">Cancel</a>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>