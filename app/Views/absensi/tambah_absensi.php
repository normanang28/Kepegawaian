<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate action="<?= base_url('home/aksi_tambah_absensi') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 mb-3">
                            <label class="control-label">Foto Bukti <span style="color: red;">*</span></label>
                            <div class="form-file">
                                <input type="file" name="foto_bukti" class="form-file-input form-control" >
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 mb-3">
                            <label class="control-label">Absensi <span style="color: red;">*</span></label>
                            <select id="nama_absen" class="form-control" name="nama_absen" required>
                                <option>Pilih Absensi</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a href="<?= base_url('/home/absensi_pegawai') ?>" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  // Fungsi untuk memeriksa apakah formulir sudah diisi hari ini
  function checkFormSubmission() {
    // Ambil tanggal terakhir pengisian dari penyimpanan lokal (local storage)
    const lastSubmissionDate = localStorage.getItem("lastSubmissionDate");

    // Ambil tanggal hari ini
    const today = new Date().toLocaleDateString();

    // Periksa apakah tanggal terakhir sama dengan hari ini
    if (lastSubmissionDate === today) {
      // Jika sudah diisi hari ini, nonaktifkan tombol "Submit"
      document.querySelector('button[type="submit"]').disabled = true;
    } else {
      // Jika belum diisi hari ini, izinkan pengisian
      document.querySelector('button[type="submit"]').disabled = false;
    }
  }

  // Panggil fungsi saat halaman dimuat
  window.onload = checkFormSubmission;

  // Fungsi untuk mengatur tanggal terakhir pengisian saat formulir disubmit
  document.querySelector('form').addEventListener('submit', function () {
    // Ambil tanggal hari ini
    const today = new Date().toLocaleDateString();

    // Simpan tanggal hari ini ke penyimpanan lokal (local storage)
    localStorage.setItem("lastSubmissionDate", today);
  });
</script>
