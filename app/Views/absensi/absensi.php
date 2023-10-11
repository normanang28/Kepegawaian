<style>
  /* CSS untuk mengatur tampilan card */
  .custom-card {
    border: 1px solid #ccc;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
  }

  /* CSS untuk mengatur tombol Tambah */
  .custom-add-button {
    margin-bottom: 20px;
  }

  /* CSS untuk mengatur tabel */
  .custom-table {
    /* Tambahkan properti CSS sesuai keinginan Anda */
  }
</style>

<div class="col-lg-12">
  <div class="card custom-card"> <!-- Tambahkan kelas "custom-card" di sini -->
    <div class="card-body">
      <?php  if(session()->get('level')== 2) { ?>
        <div class="alert alert-warning" role="alert">Apabila pada tabel Nama Pegawai yang berwarna biru dan bergaris bawah terdapat bukti kehadiran, Anda dapat mendownloadnya dengan menekan nama Pegawai.</div> 
      <?php }else{} ?>
      
      <form action="<?= base_url('/home/status_absen/')?>" method="post">
        <a href="<?= base_url('/home/tambah_absensi/')?>" class="custom-add-button"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
          <?php  if(session()->get('level')== 2) { ?>     
            <button type="submit" class="btn btn-primary">
              <span class="tf-icons bx bx-check-double"></span>&nbsp;
            </button>
          <?php }else{} ?>

        </a>
        <br>
        <div class="table-responsive custom-table" style="margin-top: 20px;"> <!-- Tambahkan kelas "custom-table" di sini -->
          <table class="table items-table table table-bordered table-striped verticle-middle table-responsive-sm">
            <thead>
              <tr>
          <?php  if(session()->get('level')== 2) { ?>     
                <th class="text-center">#</th>
          <?php }else{} ?>
          <?php  if(session()->get('level')== 3) { ?>     
                <th class="text-center">No</th>
          <?php }else{} ?>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Absen</th>
                <th class="text-center">Tanggal Absen</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach ($jofinson as $jo){
                ?>
                <tr>
          <?php  if(session()->get('level')== 2) { ?>
                  <td class="text-center">
                      <input type="checkbox" class="checkbox__input" value="<?= $jo->id_absen ?>" name="absensi[]" id="absensi_<?= $jo->id_absen ?>"/>
                  </td>
          <?php }else{} ?> 
          <?php  if(session()->get('level')== 3) { ?>     
                  <th class="text-center"><?php echo $no++ ?></th>
          <?php }else{} ?>
                  <?php if (session()->get('level') == 2 && !empty($jo->foto_bukti)) { ?>
                    <td class="text-capitalize text-center">
                      <a href="<?= base_url('/home/download/' . $jo->foto_bukti) ?>" style="text-decoration: underline;">
                        <?php echo $jo->username ?>
                      </a>
                    </td>
                  <?php } else { ?>
                    <td class="text-capitalize text-center"><?php echo $jo->username ?></td>
                  <?php } ?>
                  <td class="text-capitalize text-center"><?php echo $jo->nama_absen ?></td>
                  <td class="text-capitalize text-center"><?php echo $jo->tanggal_absen ?></td>
                  <td class="text-capitalize text-center"><?php echo $jo->status_absen ?></td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

