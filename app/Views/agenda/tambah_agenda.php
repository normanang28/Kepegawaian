<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_tambah_agenda')?>" method="post">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Rencana Pekerjaan<span style="color: red;">*</span></label>
                        <input type="text" id="nama_rencana" name="nama_rencana" 
                        class="form-control text-capitalize" placeholder="Rencana Pekerjaan">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Agenda<span style="color: red;">*</span></label>
                        <input type="text" id="agenda" name="agenda" 
                        class="form-control text-capitalize" placeholder="Agenda">
                    </div>
                    <div class="input input-group">
                        <label class="form-label">Tanggal<span style="color: red;">*</span></label>
                        <div class="col-12">
                        <input type="date" id="tanggal_agenda" name="tanggal_agenda" 
                        class="form-control text-capitalize" placeholder="Tanggal">
                        </div>
                    </div>
                </div>
                <br>
                <a href="<?= base_url('/home/agenda')?>" type="submit" class="btn btn-primary">Cancel</a></button>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>