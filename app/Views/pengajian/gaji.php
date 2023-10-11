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
  <div class="alert alert-warning" role="alert">Apabila pada tabel Nama Pegawai yang berwarna biru dan bergaris bawah terdapat bukti bahwa gaji pegawai sudah diterima, Anda dapat mendownloadnya dengan menekan nama Pegawai.</div> 
<?php }else{} ?>
<?php  if(session()->get('level')== 2) { ?>
    <a href="<?= base_url('/home/tambah_gaji/')?>"><button class="btn btn-success"><i class="fa fa-plus"></i>Tambah</button></a>
<?php }else{} ?>   
  </a>
  <br>
  <div class="table-responsive custom-table" style="margin-top: 20px;"> <!-- Tambahkan kelas "custom-table" di sini -->
    <table class="table items-table table table-bordered table-striped verticle-middle table-responsive-sm">
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Nama Pegawai</th>
          <th class="text-center">Tanggal Gajian</th>
          <th class="text-center">Nominal</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no=1;
        foreach ($jofinson as $jo){
          ?>
          <tr>
            <th class="text-center"><?php echo $no++ ?></th>
            <?php if (session()->get('level') == 2 && !empty($jo->bukti)) { ?>
            <td class="text-capitalize text-center">
              <a href="<?= base_url('/home/download_bukti/' . $jo->bukti) ?>" style="text-decoration: underline;">
                <?php echo $jo->nama_pegawai ?>
              </a>
            </td>
            <?php } else { ?>
            <td class="text-capitalize text-center"><?php echo $jo->nama_pegawai?></td>
            <?php } ?>
            <td class="text-capitalize text-center">Gaji <?php echo $jo->tanggal_gaji?></td>
            <td class="text-capitalize text-center"><?php echo $jo->harga_gaji?></td>
            <td class="text-capitalize text-center"><?php echo $jo->status?></td>
<?php  if(session()->get('level')== 3 && $jo->status != 'Diterima') { ?>
            <td class="text-center">
            <a href="<?= base_url('/home/penerimaan_gaji/' . $jo->id_gaji)?>"><button type="submit" class="btn btn-success"><span class="tf-icons bx bx-bitcoin"></span></button></a>
            </td>
<?php }else{} ?> 
<?php  if(session()->get('level')== 2) { ?>
            <td class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?= base_url('/home/edit_gaji/'.$jo->id_gaji)?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="<?= base_url('/home/hapus_gaji/'.$jo->id_gaji)?>"><i class="bx bx-trash me-1"></i> Delete</a>
                    </div>
                  </div>
                </td>
<?php }else{} ?> 
              </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

