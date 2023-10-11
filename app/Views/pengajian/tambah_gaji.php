<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate action="<?= base_url('home/aksi_tambah_gaji')?>" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pegawai <span style="color: red;">*</span></label>
                            <select name="id_pegawai" class="form-control text-capitalize" id="id_pegawai" required>
                                <option>Pilih Nama Pegawai</option>
                                <?php foreach ($p as $pegawai) { ?>
                                    <option class="text-capitalize" value="<?php echo $pegawai->id_pegawai ?>"><?php echo $pegawai->nama_pegawai ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label">Nominal <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" id="harga_gaji" name="harga_gaji" class="form-control text-capitalize" placeholder="Nominal">
                            </div>
                        </div>
                        <div class="input input-group">
                            <label class="form-label">Tanggal Gajian <span style="color: red;">*</span></label>
                            <div class="col-12">
                            <input type="date" id="tanggal_gaji" name="tanggal_gaji" class="form-control text-capitalize" placeholder="Tanggal Gajian">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('/home/pengajian_pegawai')?>" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// Fungsi untuk mengubah format input ke format Rupiah
document.getElementById('harga_gaji').addEventListener('keyup', function(e) {
    // Ambil nilai input
    let nominal = this.value;

    // Hapus semua karakter non-angka
    nominal = nominal.replace(/\D/g, '');

    // Format ulang sebagai mata uang Rupiah
    nominal = formatRupiah(nominal);

    // Set nilai kembali ke input
    this.value = nominal;
});

// Fungsi untuk mengubah format angka menjadi format Rupiah
function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join('');
    var ribuan = reverse.match(/\d{1,3}/g);
    var hasil = ribuan.join('.').split('').reverse().join('');
    return hasil;
}
</script>