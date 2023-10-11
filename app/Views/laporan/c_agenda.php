<table id="datatable-buttons" align="center" border="1" width="80%" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Rencana Pekerjaan</th>
      <th class="text-center">Nama Pegawai</th>
      <th class="text-center">Agenda</th>
      <th class="text-center">Tanggal Agenda</th>
    </tr>
  </thead>


  <tbody>
    <?php
    $no=1;
    foreach ($jofinson as $jo){
      if ($jo->status_agenda == "Disetujui") {
        ?>
        <tr>
          <th class="text-capitalize text-center"><?php echo $no++ ?></th>
          <td class="text-capitalize text-center"><?php echo $jo->nama_rencana ?></td>
          <td class="text-capitalize text-center"><?php echo $jo->username ?></td>
          <td class="text-capitalize text-center"><?php echo $jo->agenda ?></td>
          <td class="text-capitalize text-center"><?php echo $jo->tanggal_agenda ?></td>
        </tr>
        <?php
      }
    }
    ?>
  </tbody>
</table>
</div>
<script>
  window.print();
</script>