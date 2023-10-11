<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate action="<?= base_url('home/aksi_penerimaan_gaji')?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?= $jofinson->id_gaji ?>">

                  <div class="input-group">
                    <label class="control-label col-12">Bukti Gaji Telah Diterima<span style="color: red;">*</span></label>  
                    <div class="col-12 form-file">
                        <input type="file" name="bukti" class="form-file-input form-control col-12">
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?= base_url('/home/pengajian_pegawai')?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>