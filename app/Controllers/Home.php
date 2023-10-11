<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    public function index()
    {
        if(session()->get('id')>0 ) {
            return redirect()->to('home/dashboard');

        }else{

            $model=new M_model();
            echo view('login');
        }
    }


    public function aksi_login()
    {
        $n=$this->request->getPost('username'); 
        $p=$this->request->getPost('password');

        $captchaResponse = $this->request->getPost('g-recaptcha-response');
        $captchaSecretKey = '6Le4D6snAAAAAHD3_8OPnw4teaKXWZdefSyXn4H3';

        $verifyCaptchaResponse = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$captchaSecretKey}&response={$captchaResponse}"
        );

        $captchaData = json_decode($verifyCaptchaResponse);

        if (!$captchaData->success) {

            session()->setFlashdata('error', 'CAPTCHA verification failed. Please try again.');
            return redirect()->to('/Home');
        }

        $model= new M_model();
        $data=array(
            'username'=>$n, 
            'password'=>md5($p)
        );
        $cek=$model->getarray('user', $data);
        if ($cek>0) {
            $where=array('id_user_pegawai'=>$cek['id_user']);
            $pengguna=$model->getarray('pegawai', $where);
            session()->set('id', $cek['id_user']);
            session()->set('username', $cek['username']);
            
            session()->set('nama_pegawai', $pengguna['nama_pegawai']);

            session()->set('level', $cek['level']);
            return redirect()->to('/home/dashboard');

        }else {
            return redirect()->to('/');
        }
    }


    public function log_out()
    {
        if(session()->get('id')>0) {

           session()->destroy();
           return redirect()->to('/');

       }else{
        return redirect()->to('/home/dashboard');
    }
}


public function ganti_profile()
{
    if(session()->get('level')== 1 || session()->get('level')== 2 || session()->get('level')== 3) {

        $id=session()->get('id');
        $where2=array('id_user'=>$id);
        $where=array('id_user_pegawai'=>$id);
        $model=new M_model();
        $pakif['users']=$model->edit_pp('pegawai',$where);
        $pakif['use']=$model->edit_pp('user',$where2);

        $kui['foto']=$model->getRow('user',$where2);

        $id=session()->get('id');


        echo view('header',$kui);
        echo view('menu');
        echo view('ganti_pp', $pakif);
        echo view('footer');
    }else {
        return redirect()->to('/');
    }
}

public function aksi_ganti_profile()
{
    $model= new M_model();
    $id=session()->get('id');
    $where=array('id_user'=>$id);
    $photo=$this->request->getFile('foto');
    $kui=$model->getRow('user',$where);
    if( $photo != '' ){}
        elseif($photo != '' && file_exists(PUBLIC_PATH."/images/profile/".$kui->foto) ) 
        {
            unlink(PUBLIC_PATH."/images/profile/".$kui->foto);
        }
        elseif($photo == '')
        {
            $username= $this->request->getPost('username');
            $nik= $this->request->getPost('nik');   
            $nama_pegawai= $this->request->getPost('nama_pegawai');  
            $ttl= $this->request->getPost('ttl');     
            $jk= $this->request->getPost('jk');          
            $email= $this->request->getPost('email');                    

            $user=array(
                'username'=>$username,
            );
            $model->edit('user', $user,$where);
            $where2=array('id_user_pegawai'=>$id);

            $pegawai=array(
                'nik'=>$nik,
                'nama_pegawai'=>$nama_pegawai,
                'ttl'=>$ttl,
                'jk'=>$jk,
                'email'=>$email,
            );
            $model->edit('pegawai', $pegawai, $where2);
            return redirect()->to('/home/ganti_profile');
        }

        $username= $this->request->getPost('username');
        $nik= $this->request->getPost('nik');   
        $nama_pegawai= $this->request->getPost('nama_pegawai');  
        $ttl= $this->request->getPost('ttl');     
        $jk= $this->request->getPost('jk');          
        $email= $this->request->getPost('email');   

        $img = $photo->getRandomName();
        $photo->move(PUBLIC_PATH.'/images/profile/',$img);
        $user=array(
            'username'=>$username,
            'foto'=>$img
        );
        $model=new M_model();
        $model->edit('user', $user,$where);

        $pegawai=array(
            'nik'=>$nik,
            'nama_pegawai'=>$nama_pegawai,
            'ttl'=>$ttl,
            'jk'=>$jk,
            'email'=>$email,
        );
        $where2=array('id_user_pegawai'=>$id);
        $model->edit('pegawai', $pegawai, $where2);
        return redirect()->to('/home/ganti_profile');
    }


    public function ganti_password()  
    {
        if(session()->get('level')== 1 || session()->get('level')== 2 || session()->get('level')== 3) {

            $id=session()->get('id');
            $where2=array('id_user'=>$id);
            $model=new M_model();
            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);
            $pakif['use']=$model->getRow('user',$where2);

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            echo view('header',$kui);
            echo view('menu');
            echo view('ganti_pw',$pakif);
            echo view('footer');
        }else{
            return redirect()->to('/');
        }
    }

    public function aksi_ganti_pw()   
    {
        $pass=$this->request->getPost('password');
        $id=session()->get('id');
        $model= new M_model();

        $data=array( 
            'password'=>md5($pass)
        );
        
        $where=array('id_user'=>$id);
        $model->edit('user', $data, $where);

        return redirect()->to('/home/log_out');
    }


//Dashboard----------------------------------------------------------------------------------------------------------------
    public function dashboard()
    {
        if(session()->get('id')>0) {

            $model= new M_model();
            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);       

            echo view('header', $kui);
            echo view('menu');
            echo view('dashboard');
            echo view('footer');
        }else{
            return redirect()->to('/');
        }
    }


//Jabatan------------------------------------------------------------------------------------------------------------------
    public function pegawaian()
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $on='pegawai.id_jabatan_pegawai=jabatan.id_jabatan';
            $on2='pegawai.id_user_pegawai=user.id_user';
            $kui['jofinson']=$model->tampilPegawaian('pegawai', 'jabatan', 'user', $on, $on2, 'tanggal_pegawai');

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('pegawaian/pegawaian');
            echo view('footer'); 

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function tambah_pegawaian()
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $on='pegawai.id_jabatan_pegawai=jabatan.id_jabatan';
            $kui['jofinson']=$model->tampiltambahPegawaian('pegawai', 'jabatan', $on, 'tanggal_pegawai');

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            $kui['j']=$model->tampil('jabatan'); 

            echo view('header',$kui);
            echo view('menu');
            echo view('pegawaian/tambah_pegawaian');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_tambah_pegawaian()
    {
        $model=new M_model();

        $jabatan=$this->request->getPost('id_jabatan');
        $nik=$this->request->getPost('nik');
        $nama_pegawai=$this->request->getPost('nama_pegawai');
        $ttl=$this->request->getPost('ttl');
        $jk=$this->request->getPost('jk');
        $email=$this->request->getPost('email');
        $username=$this->request->getPost('username');
        $password=$this->request->getPost('password');
        $level=$this->request->getPost('level');

        $user=array(
            'username'=>$username,
            'password'=>md5('Jofinson123'),
            'level'=>$level,
        );

        $model=new M_model();
        $model->simpan('user', $user);
        $where=array('username'=>$username);
        $id=$model->getarray('user', $where);
        $iduser = $id['id_user'];

        $pegawai=array(
            'id_jabatan_pegawai'=> $jabatan,
            'nik'=>$nik,
            'nama_pegawai'=>$nama_pegawai,
            'ttl'=>$ttl,
            'jk'=>$jk,
            'email'=>$email,
            'id_user_pegawai'=>$iduser,
        );
        $model->simpan('pegawai', $pegawai);
        return redirect()->to('/home/pegawaian');
    }

    public function reset_pw($id)
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $where=array('id_user'=>$id);
            $data=array(
                'password'=>md5('Jofinson123')
            );
            $model->edit('user',$data,$where);
            return redirect()->to('/home/pegawaian');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function edit_pegawaian($id)
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $where2=array('pegawai.id_user_pegawai'=>$id);
            $on='pegawai.id_jabatan_pegawai=jabatan.id_jabatan';
            $on2 ='pegawai.id_user_pegawai=user.id_user';
            $kui['jofinson']=$model->ultraRows('pegawai', 'jabatan', 'user',$on, $on2, $where2);
            $kui['j']=$model->tampil('jabatan');

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('pegawaian/edit_pegawaian');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_edit_pegawaian()
    {
        $id= $this->request->getPost('id');
        $jabatan=$this->request->getPost('id_jabatan');
        $nik=$this->request->getPost('nik');
        $nama_pegawai=$this->request->getPost('nama_pegawai');
        $ttl=$this->request->getPost('ttl');
        $jk=$this->request->getPost('jk');
        $email=$this->request->getPost('email');
        $username=$this->request->getPost('username');
        $password=$this->request->getPost('password');
        $level=$this->request->getPost('level');

        $where=array('id_user'=>$id);    
        $where2=array('id_user_pegawai'=>$id);
        if ($password !='') {
            $user=array(
                'username'=>$username,
                'level'=>$level,
            );
        }else{
            $user=array(
                'username'=>$username,
                'level'=>$level,
            );
        }

        $model=new M_model();
        $model->edit('user', $user,$where);

        $pegawai=array(
            'id_jabatan_pegawai'=> $jabatan,
            'nik'=>$nik,
            'nama_pegawai'=>$nama_pegawai,
            'ttl'=>$ttl,
            'jk'=>$jk,
            'email'=>$email,
        );
        $model->edit('pegawai', $pegawai, $where2);
        return redirect()->to('/home/pegawaian');
    }

    public function hapus_pegawaian($id)
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $where2=array('id_user'=>$id);
            $where=array('id_user_pegawai'=>$id);
            $model->hapus('pegawai',$where);
            $model->hapus('user',$where2);
            return redirect()->to('/home/pegawaian');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }


//Jabatan------------------------------------------------------------------------------------------------------------------
    public function jabatan()
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $kui['jofinson']=$model->tampilJabatan('jabatan', 'tanggal_jabatan');

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('jabatan/jabatan');
            echo view('footer'); 

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function tambah_jabatan()
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $kui['duar']=$model->tampil('jabatan');

            $id=session()->get('id');
            $where=array('id_user'=>$id);
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('jabatan/tambah_jabatan');
            echo view('footer'); 

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_tambah_jabatan()
    {
        $model=new M_model();
        $nama_jabatan=$this->request->getPost('nama_jabatan');
        $catatan_jabatan=$this->request->getPost('catatan_jabatan');
        $data=array(
            'nama_jabatan'=>$nama_jabatan,
            'catatan_jabatan'=>$catatan_jabatan,
        );
        $model->simpan('jabatan',$data);
        return redirect()->to('/home/jabatan');
    }

    public function edit_jabatan($id)
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $where=array('id_jabatan'=>$id);
            $kui['jofinson']=$model->getRow('jabatan', $where);

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('jabatan/edit_jabatan');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_edit_jabatan()
    {
        $model=new M_model();
        $id=$this->request->getPost('id');
        $nama_jabatan=$this->request->getPost('nama_jabatan');
        $catatan_jabatan=$this->request->getPost('catatan_jabatan');
        $data=array(
            'nama_jabatan'=>$nama_jabatan,
            'catatan_jabatan'=>$catatan_jabatan,
        );        
        $where=array('id_jabatan'=>$id);
        $model->edit('jabatan',$data,$where);
        return redirect()->to('/home/jabatan');
    }

    public function hapus_jabatan($id)
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $where=array('id_jabatan'=>$id);
            $model->hapus('jabatan',$where);
            return redirect()->to('/home/jabatan');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }


//Absensi------------------------------------------------------------------------------------------------------------------
    public function absensi_pegawai()
    {
        if(!session()->get('id') > 0){
            return redirect()->to('/home/dashboard');
        }

        if(session()->get('level')== 2) {
            $model=new M_model();
            $on='absensi.maker_absen=user.id_user';
            $kui['jofinson']=$model->tampilAbsen('absensi', 'user', $on, 'tanggal_absen');
        }

        if(session()->get('level')== 3) {
            $model=new M_model();
            $where=array('username'=>session()->get('username'));
            $on='absensi.maker_absen=user.id_user';
            $kui['jofinson']=$model->absen_nama('absensi', 'user', $on, 'tanggal_absen', $where);
        }

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('absensi/absensi');
        echo view('footer'); 

    }

    public function tambah_absensi()
    {
        if(session()->get('level')== 2 ||session()->get('level')== 3) {

            $model=new M_model();
            $on='absensi.maker_absen=user.id_user';
            $kui['jofinson']=$model->tampilAbsen('absensi', 'user', $on, 'tanggal_absen');

            $id=session()->get('id');
            $where=array('id_user'=>$id);
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('absensi/tambah_absensi');
            echo view('footer'); 

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_tambah_absensi()
    {
        $model = new M_model();
        $nama_absen = $this->request->getPost('nama_absen');
        $maker_absen = session()->get('id');
        $data = array(
            'nama_absen' => $nama_absen,
            'status_absen' => 'Tidak Disetujui',
            'maker_absen' => $maker_absen,
        );

        try {
            $foto = $this->request->getFile('foto_bukti');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move(ROOTPATH . '/public/bukti/', $newName);
                $data['foto_bukti'] = $newName;
            }

            $model->simpan('absensi', $data);
            return redirect()->to('/home/absensi_pegawai');
        } catch (Exception $e) {
        // Handle exceptions if needed
            return $e->getMessage();
        }
    }

    public function download($file_name)
    {
        $file_path = FCPATH . 'bukti/' . $file_name;

        if (file_exists($file_path)) {

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . filesize($file_path));

            readfile($file_path);
            exit;
        } else {
            die('File not found.');
        }
    }

    public function status_absen()
    {
        if (session()->get('level') == 2) {
            $ids = $this->request->getPost('absensi');

            if (is_array($ids)) {
                $model = new M_model();
                $data = array(
                    'status_absen' => "Disetujui"
                );

                foreach ($ids as $id) {
                    $where = array('id_absen' => $id);
                    $model->edit('absensi', $data, $where);
                }

                return redirect()->to('home/absensi_pegawai');
            } else {
                return redirect()->to('home/absensi_pegawai')->with('error', 'Invalid input data');
            }
        } else {
            return redirect()->to('/home/dashboard');
        }
    }


//Agenda------------------------------------------------------------------------------------------------------------------
    public function agenda()
    {
        if(!session()->get('id') > 0){
            return redirect()->to('/home/dashboard');
        }

        if(session()->get('level')== 2) {
            $model=new M_model();
            $on='agenda.maker_agenda=user.id_user';
            $kui['jofinson']=$model->tampilAbsen('agenda', 'user', $on, 'agenda_agenda');
        }

        if(session()->get('level')== 3) {
            $model=new M_model();
            $where=array('username'=>session()->get('username'));
            $on='agenda.maker_agenda=user.id_user';
            $kui['jofinson']=$model->absen_nama('agenda', 'user', $on, 'agenda_agenda', $where);
        }

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('agenda/agenda');
        echo view('footer'); 

    }

    public function tambah_agenda()
    {
        if(session()->get('level')== 2 || session()->get('level')== 3) {

            $model=new M_model();
            $on='agenda.maker_agenda=user.id_user';
            $kui['jofinson']=$model->tampilAbsen('agenda', 'user', $on, 'agenda_agenda');

            $id=session()->get('id');
            $where=array('id_user'=>$id);
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('agenda/tambah_agenda');
            echo view('footer'); 

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_tambah_agenda()
    {
        $model=new M_model();
        $nama_rencana=$this->request->getPost('nama_rencana');
        $agenda=$this->request->getPost('agenda');
        $tanggal_agenda=$this->request->getPost('tanggal_agenda');
        $maker_agenda = session()->get('id');
        $data=array(
            'nama_rencana'=>$nama_rencana,
            'agenda'=>$agenda,
            'tanggal_agenda'=>$tanggal_agenda,
            'status_agenda'=>'Tidak Disetujui',
            'maker_agenda'=>$maker_agenda,
        );
        $model->simpan('agenda',$data);
        return redirect()->to('/home/agenda');
    }

    public function edit_agenda($id)
    {
        if(session()->get('level')== 2 || session()->get('level')== 3) {


            $model=new M_model();
            $where2=array('id_agenda'=>$id);
            $on='agenda.maker_agenda=user.id_user';
            $kui['jofinson']=$model->fusionRows('agenda', 'user', $on, $where2);

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('agenda/edit_agenda');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_edit_agenda()
    {
        $model=new M_model();
        $id=$this->request->getPost('id');
        $nama_rencana=$this->request->getPost('nama_rencana');
        $agenda=$this->request->getPost('agenda');
        $tanggal_agenda=$this->request->getPost('tanggal_agenda');
        $maker_agenda = session()->get('id');
        $data=array(
            'nama_rencana'=>$nama_rencana,
            'agenda'=>$agenda,
            'tanggal_agenda'=>$tanggal_agenda,
            'maker_agenda'=>$maker_agenda,
        );        
        $where=array('id_agenda'=>$id);
        $model->edit('agenda',$data,$where);
        return redirect()->to('/home/agenda');
    }

    public function hapus_agenda($id)
    {
        if(session()->get('level')== 2 || session()->get('level')== 3) {

            $model=new M_model();
            $where=array('id_agenda'=>$id);
            $model->hapus('agenda',$where);
            return redirect()->to('/home/agenda');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function status_agenda()
    {
        if (session()->get('level') == 2) {
            $ids = $this->request->getPost('agenda');

            if (is_array($ids)) {
                $model = new M_model();
                $data = array(
                    'status_agenda' => "Disetujui"
                );

                foreach ($ids as $id) {
                    $where = array('id_agenda' => $id);
                    $model->edit('agenda', $data, $where);
                }

                return redirect()->to('home/agenda');
            } else {
                return redirect()->to('home/agenda')->with('error', 'Invalid input data');
            }
        } else {
            return redirect()->to('/home/dashboard');
        }
    }


//Gaji------------------------------------------------------------------------------------------------------------------
    public function pengajian_pegawai()
    {
        if(!session()->get('id') > 0){
            return redirect()->to('/home/dashboard');
        }

        if(session()->get('level')== 2) {
            $model=new M_model();
            $on='gaji.id_pegawai_gaji=pegawai.id_pegawai';
            $kui['jofinson']=$model->tampilAbsen('gaji', 'pegawai', $on, 'tanggal_gaji');
        }

        if(session()->get('level')== 3) {
            $model=new M_model();
            $where=array('nama_pegawai'=>session()->get('nama_pegawai'));
            $on='gaji.id_pegawai_gaji=pegawai.id_pegawai';
            $kui['jofinson']=$model->absen_nama('gaji', 'pegawai', $on, 'tanggal_gaji', $where);
        }

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $kui['foto']=$model->getRow('user',$where);

        echo view('header',$kui);
        echo view('menu');
        echo view('pengajian/gaji');
        echo view('footer'); 

    }

    public function tambah_gaji()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $on='gaji.id_pegawai_gaji=pegawai.id_pegawai';
            $kui['jofinson']=$model->tampiltambahPegawaian('gaji', 'pegawai', $on, 'tanggal_gaji');

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            $kui['p']=$model->tampil('pegawai'); 

            echo view('header',$kui);
            echo view('menu');
            echo view('pengajian/tambah_gaji');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_tambah_gaji()
    {
        $model=new M_model();
        $pegawai=$this->request->getPost('id_pegawai');
        $harga_gaji=$this->request->getPost('harga_gaji');
        $tanggal_gaji=$this->request->getPost('tanggal_gaji');
        $data=array(
            'id_pegawai_gaji'=> $pegawai,
            'harga_gaji'=>$harga_gaji,
            'tanggal_gaji'=>$tanggal_gaji,
            'status'=>'Belum Diterima',
        );
        $model->simpan('gaji',$data);
        return redirect()->to('/home/pengajian_pegawai');
    }

    public function edit_gaji($id)
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $where2=array('gaji.id_gaji'=>$id);
            $on='gaji.id_pegawai_gaji=pegawai.id_pegawai';
            $kui['jofinson']=$model->edit_gaji('gaji', 'pegawai', $on, $where2);
            $kui['p']=$model->tampil('pegawai');

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('pengajian/edit_gaji');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_edit_gaji()
    {
        $model=new M_model();
        $id=$this->request->getPost('id');
        $pegawai=$this->request->getPost('id_pegawai');
        $harga_gaji=$this->request->getPost('harga_gaji');
        $tanggal_gaji=$this->request->getPost('tanggal_gaji');
        $data=array(
            'id_pegawai_gaji'=> $pegawai,
            'harga_gaji'=>$harga_gaji,
            'tanggal_gaji'=>$tanggal_gaji,
        );        
        $where=array('id_gaji'=>$id);
        $model->edit('gaji',$data,$where);
        return redirect()->to('/home/pengajian_pegawai');
    }

    public function hapus_gaji($id)
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $where=array('id_gaji'=>$id);
            $model->hapus('gaji',$where);
            return redirect()->to('/home/pengajian_pegawai');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }


    public function penerimaan_gaji($id)
    {
        if(session()->get('level')== 3) {

            $model=new M_model();
            $where2=array('gaji.id_gaji'=>$id);
            $kui['jofinson']=$model->penerimaan_gaji('gaji', $where2);

            $id=session()->get('id');
            $where=array('id_user'=>$id);

            $where=array('id_user' => session()->get('id'));
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu');
            echo view('pengajian/penerimaan_gaji');
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }

    public function aksi_penerimaan_gaji()
    {
        $model=new M_model();
        $id=$this->request->getPost('id');
        $data=array(
            'status'=>'Diterima',
        );        
        $where=array('id_gaji'=>$id);

        try {
            $foto = $this->request->getFile('bukti');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move(ROOTPATH . '/public/bukti_gaji/', $newName);
                $data['bukti'] = $newName; 
            }
            $model->edit('gaji',$data,$where);
            return redirect()->to('/home/pengajian_pegawai');
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function download_bukti($file_name)
    {
        $file_path = FCPATH . 'bukti_gaji/' . $file_name;

        if (file_exists($file_path)) {

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . filesize($file_path));

            readfile($file_path);
            exit;
        } else {
            die('File not found.');
        }
    }



//Laporan-----------------------------------------------------------------------------------------------------------------
    public function absensi_pegawai_laporan()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $kui['kunci']='view_absensi';

            $id=session()->get('id');
            $where=array('id_user'=>$id);
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu',$kui);
            echo view('laporan/filter',$kui);
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function cari_absensi()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $kui['jofinson']=$model->filter_absensi('absensi',$awal,$akhir);

            echo view('laporan/c_absensi',$kui);

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function pdf_absensi()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $kui['jofinson']=$model->filter_absensi('absensi',$awal,$akhir);

            $dompdf = new\Dompdf\Dompdf();
            $dompdf->loadHtml(view('laporan/c_absensi',$kui));
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            $dompdf->stream('my.pdf', array('Attachment'=>0));

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function excel_absensi()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $data=$model->filter_absensi('absensi',$awal,$akhir);

            $spreadsheet=new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Pegawai')
            ->setCellValue('B1', 'Absen')
            ->setCellValue('C1', 'Bukti')
            ->setCellValue('D1', 'Tanggal Absen');

            $total = 0;

            $column=2;

            foreach($data as $data){
                if ($data->status_absen == "Disetujui") {

                    $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'. $column, $data->username)
                    ->setCellValue('B'. $column, $data->nama_absen)
                    ->setCellValue('C'. $column, $data->foto_bukti)
                    ->setCellValue('D'. $column, $data->tanggal_absen);


                    $column++;
                }}
                $writer = new XLsx($spreadsheet);
                $fileName = 'Laporan Absensi - Kepegawaian';

                header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition:attachment;filename='.$fileName.'.xls');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            }else{
                return redirect()->to('/home/dashboard');
            }
        }


    public function agenda_laporan()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $kui['kunci']='view_agenda';

            $id=session()->get('id');
            $where=array('id_user'=>$id);
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu',$kui);
            echo view('laporan/filter',$kui);
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function cari_agenda()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $kui['jofinson']=$model->filter_agenda('agenda',$awal,$akhir);

            echo view('laporan/c_agenda',$kui);

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function pdf_agenda()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $kui['jofinson']=$model->filter_agenda('agenda',$awal,$akhir);

            $dompdf = new\Dompdf\Dompdf();
            $dompdf->loadHtml(view('laporan/c_agenda',$kui));
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            $dompdf->stream('my.pdf', array('Attachment'=>0));

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function excel_agenda()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $data=$model->filter_agenda('agenda',$awal,$akhir);

            $spreadsheet=new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Rencana Pekerjaan')
            ->setCellValue('B1', 'Nama Pegawai')
            ->setCellValue('C1', 'Agenda')
            ->setCellValue('D1', 'Tanggal Agenda');

            $total = 0;

            $column=2;

            foreach($data as $data){
                if ($data->status_agenda == "Disetujui") {

                    $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'. $column, $data->nama_rencana)
                    ->setCellValue('B'. $column, $data->username)
                    ->setCellValue('C'. $column, $data->agenda)
                    ->setCellValue('D'. $column, $data->tanggal_agenda);


                    $column++;
                }}
                $writer = new XLsx($spreadsheet);
                $fileName = 'Laporan Agenda - Kepegawaian';

                header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition:attachment;filename='.$fileName.'.xls');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            }else{
                return redirect()->to('/home/dashboard');
            }
        }


    public function pengajian_pegawai_laporan()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $kui['kunci']='view_gaji';

            $id=session()->get('id');
            $where=array('id_user'=>$id);
            $kui['foto']=$model->getRow('user',$where);

            echo view('header',$kui);
            echo view('menu',$kui);
            echo view('laporan/filter',$kui);
            echo view('footer');

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function cari_pengajian()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $kui['jofinson']=$model->filter_gaji('gaji',$awal,$akhir);

            echo view('laporan/c_pengajian',$kui);

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function pdf_pengajian()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $kui['jofinson']=$model->filter_gaji('gaji',$awal,$akhir);

            $dompdf = new\Dompdf\Dompdf();
            $dompdf->loadHtml(view('laporan/c_pengajian',$kui));
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            $dompdf->stream('my.pdf', array('Attachment'=>0));

        }else{
            return redirect()->to('/home/dashboard');
        }
    }
    public function excel_pengajian()
    {
        if(session()->get('level')== 2) {

            $model=new M_model();
            $awal= $this->request->getPost('awal');
            $akhir= $this->request->getPost('akhir');
            $data=$model->filter_gaji('gaji',$awal,$akhir);

            $spreadsheet=new Spreadsheet();

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Pegawai')
            ->setCellValue('B1', 'Tanggal Gajian')
            ->setCellValue('C1', 'Nominal')
            ->setCellValue('D1', 'Bukti')
            ->setCellValue('E1', 'Tanggal Gaji');

            $total = 0;

            $column=2;

            foreach($data as $data){
                if ($data->status == "Diterima") {

                    $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'. $column, $data->nama_pegawai)
                    ->setCellValue('B'. $column, $data->tanggal_gaji)
                    ->setCellValue('C'. $column, $data->harga_gaji)
                    ->setCellValue('D'. $column, $data->bukti)
                    ->setCellValue('E'. $column, $data->tanggal_gaji);


                    $column++;
                }}
                $writer = new XLsx($spreadsheet);
                $fileName = 'Laporan Pengajian - Kepegawaian';

                header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition:attachment;filename='.$fileName.'.xls');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            }else{
                return redirect()->to('/home/dashboard');
            }
        }
}
