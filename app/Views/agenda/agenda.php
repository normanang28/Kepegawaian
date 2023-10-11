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

      <form action="<?= base_url('/home/status_agenda/')?>" method="post">
        <a href="<?= base_url('/home/tambah_agenda/')?>" class="custom-add-button"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
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
              <th class="text-center">Rencana Pekerjaan</th>
              <th class="text-center">Nama Pegawai</th>
              <th class="text-center">Agenda</th>
              <th class="text-center">Tanggal</th>
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
               <?php  if(session()->get('level')== 2) { ?>
                <td class="text-center">
                  <input type="checkbox" class="checkbox__input" value="<?= $jo->id_agenda ?>" name="agenda[]" id="agenda_<?= $jo->id_agenda ?>"/>
                </td>
              <?php }else{} ?> 
              <?php  if(session()->get('level')== 3) { ?>   
                <th class="text-center"><?php echo $no++ ?></th>
              <?php }else{} ?> 
              <td class="text-capitalize text-center"><?php echo $jo->nama_rencana ?></td>
              <td class="text-capitalize text-center"><?php echo $jo->username ?></td>
              <td class="text-capitalize text-center"><?php echo $jo->agenda ?></td>
              <td class="text-capitalize text-center"><?php echo $jo->tanggal_agenda ?></td>
              <td class="text-capitalize text-center"><?php echo $jo->status_agenda ?></td>
              <?php  if(session()->get('level')== 2) { ?>   
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= base_url('/home/edit_agenda/'.$jo->id_agenda)?>"
                      ><i class="bx bx-edit-alt me-1"></i> Edit</a
                      >
                      <a class="dropdown-item" href="<?= base_url('/home/hapus_agenda/'.$jo->id_agenda)?>"
                        ><i class="bx bx-trash me-1"></i> Delete</a
                        >
                      </div>
                    </div>
                  </td>
              <?php }else{} ?> 
              <?php  if(session()->get('level')== 3) { ?>   
                  <td class="text-center" <?php if ($jo->status_agenda == 'Disetujui') echo 'style="display: none;"'; ?>>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('/home/edit_agenda/'.$jo->id_agenda)?>"
                          ><i class="bx bx-edit-alt me-1"></i> Edit</a
                          >
                          <a class="dropdown-item" href="<?= base_url('/home/hapus_agenda/'.$jo->id_agenda)?>"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                            >
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

