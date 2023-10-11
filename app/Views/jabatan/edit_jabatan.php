<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_jabatan')?>" method="post">
              <input type="hidden" name="id" value="<?= $jofinson->id_jabatan ?>">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Jabatan<span style="color: red;">*</span></label>
                        <input type="text" id="nama_jabatan" name="nama_jabatan" 
                        class="form-control text-capitalize" placeholder="Nama Jabatan" value="<?= $jofinson->nama_jabatan?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Tugas Jabatan<span style="color: red;">*</span></label>
                        <input type="text" id="catatan_jabatan" name="catatan_jabatan" 
                        class="form-control text-capitalize" placeholder="Tugas Jabatan" value="<?= $jofinson->catatan_jabatan?>">
                    </div>
                </div>
                <a href="<?= base_url('/home/jabatan')?>" type="submit" class="btn btn-primary">Cancel</a></button>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>
</div>