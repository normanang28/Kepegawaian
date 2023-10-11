<table id="datatable-buttons" align="center" border="1" width="80%" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Pegawai</th>
      <th class="text-center">Absen</th>
      <th class="text-center">Bukti</th>
      <th class="text-center">Tanggal Absen</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($jofinson as $jo) {
      if ($jo->status_absen == "Disetujui") {
        ?>
        <tr>
          <th class="text-capitalize text-center"><?php echo $no++ ?></th>
          <td class="text-capitalize text-center"><?php echo $jo->username ?></td>
          <td class="text-capitalize text-center"><?php echo $jo->nama_absen ?></td>
          <td class="text-capitalize text-center"><?php echo $jo->foto_bukti ?></td>
          <td class="text-capitalize text-center"><?php echo $jo->tanggal_absen ?></td>
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
