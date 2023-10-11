<!-- <marquee><h2 class="text-uppercaze" >Selamat Datang <?= session()->get('nama_pegawai')?>!!</h2></marquee> -->
<h4 class="text-uppercaze" id="welcome-text">Selamat Datang Di Aplikasi Kepegawaian, <?= session()->get('nama_pegawai')?>!!</h4>
<style>
	#welcome-text {
		white-space: nowrap; /* Mencegah teks meluncur ke baris berikutnya */
		overflow: hidden; /* Sembunyikan teks yang berlebihan */
		animation: typing 8.5s steps(100, end) infinite; /* Animasi ketik */

		/* Anda bisa menambahkan properti CSS lain sesuai keinginan Anda */
	}

/* Animasi ketik */
@keyframes typing {
	from {
		width: 0;
	}
	to {
		width: 100%;
	}
}

</style>