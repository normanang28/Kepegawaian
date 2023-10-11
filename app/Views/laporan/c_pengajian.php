<table id="datatable-buttons" align="center" border="1" width="80%" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Pegawai</th>
      <th class="text-center">Tanggal Gajian</th>
      <th class="text-center">Nominal</th>
      <th class="text-center">Bukti</th>
      <th class="text-center">Tanggal Gaji</th>
    </tr>
  </thead>


  <tbody>
    <?php
    $no=1;
    foreach ($jofinson as $jo){
      if ($jo->status == "Diterima") {
        ?>
        <tr>
          <th class="text-center"><?php echo $no++ ?></th>
          <td class="text-capitalize text-center"><?php echo $jo->nama_pegawai?></td>
          <td class="text-capitalize text-center"><?php echo $jo->tanggal_gaji?></td>
          <td class="text-capitalize text-center"><?php echo $jo->harga_gaji?></td>
          <td lass="text-capitalize text-center"><?php echo $jo->bukti?></td>
          <td lass="text-capitalize text-center"><?php echo $jo->tanggal_gaji?></td>
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