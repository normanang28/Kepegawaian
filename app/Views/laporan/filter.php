<div class="col-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>
        <?php if ($kunci=='view_absensi') {
        }else if ($kunci=='view_agenda') {
        }else{
        }
        ?>
      </h2>
      <!--  -->
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form class="form-horizontal form-label-left" novalidate

      action="
      <?php if ($kunci=='view_absensi') {
        echo base_url('home/cari_absensi');
        }else if ($kunci=='view_agenda') {
          echo base_url('home/cari_agenda');
          }else{
            echo base_url('home/cari_pengajian');
          }
        ?>" method="post">

        <div class="item form-group">
          <label class="control-label col-12">Start Date<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <input id="name" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="awal" placeholder="" required="required" type="date">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-12">End Date<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <input type="date" id="kode" name="akhir" required="required" placeholder="" class="form-control col-12">
          </div>
        </div>
        <br>
        <div class="form-group">
          <div class="col-12">
            <button id="send" type="submit" class="btn btn-warning"><i class="fa fa-print"></i> Print</button>
          </div>
        </div>
      </form>
      <br>
      <div class="ln_solid"></div>

      <form class="form-horizontal form-label-left" novalidate

      action="
      <?php if ($kunci=='view_absensi') {
        echo base_url('home/pdf_absensi');
        }else if ($kunci=='view_agenda') {
          echo base_url('home/pdf_agenda');
          }else{
            echo base_url('home/pdf_pengajian');
          }
        ?>" method="post">

        <div class="item form-group">
          <label class="control-label col-12">Start Date<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <input id="name" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="awal" placeholder="" required="required" type="date">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-12">End Date<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <input type="date" id="kode" name="akhir" required="required" placeholder="" class="form-control col-12">
          </div>
        </div>
        <br>
        <div class="form-group">
          <div class="col-12">
            <button type="submit" class="btn btn-danger"><i class="fa fa-print"></i> PDF</button>
          </div>
        </div>
      </form>
      <br>

      <div class="ln_solid"></div>

      <form class="form-horizontal form-label-left" novalidate

      action="
      <?php if ($kunci=='view_absensi') {
        echo base_url('home/excel_absensi');
        }else if ($kunci=='view_agenda') {
          echo base_url('home/excel_agenda');
          }else{
            echo base_url('home/excel_pengajian');
          }
        ?>" method="post">

        <div class="item form-group">
          <label class="control-label col-12">Start Date<span style="color: red;">*</span> 
          </label>
          <div class="col-12">
            <input id="name" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="awal" placeholder="" required="required" type="date">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-12">End Date<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <input type="date" id="kode" name="akhir" required="required" placeholder="" class="form-control col-12">
          </div>
        </div>
        <br>
        <div class="form-group">
          <div class="col-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Excel</button>
          </div>
        </div>
      </form>
      <br>
      <div class="ln_solid"></div>
      <form class="form-horizontal form-label-left" novalidate
      action="
      <?php if ($kunci=='view_absensi') {
        echo base_url('home/absensi_pegawai');
        }else if ($kunci=='view_agenda') {
          echo base_url('home/agenda');
          }else{
            echo base_url('home/pengajian_pegawai');
          }
        ?>" method="post">
      </div>
    </div>
  </div>