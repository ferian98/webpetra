<?php
class Surat_baptis extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_surat');
  }

  function index(){
    $s = $this->session->userdata("status");
    if($s == null){
      redirect(base_url());
    } else {
      $in = $this->session->flashdata('in');
      if ($in != null){
        $data['dt_edit'] = $in;
        echo 'haha';
      }
      $data['nomor'] = $this->get_nomor_surat();
      $this->load->view('surat_baptis_view',$data);
    }
  }

  function simpan(){
    $nomor = $this->input->post('nomor');
    $nama = $this->input->post('nama');
    $t4_lahir = $this->input->post('tempat_lahir');
    $tgl_lahir = $this->input->post('tanggal_lahir');
    $ayah = $this->input->post('nama_ayah');
    $ibu = $this->input->post('nama_ibu'); 
    $hari_baptis = $this->input->post('hari_baptis');
    $tgl_baptis = $this->input->post('tanggal_baptis');
    $oleh = $this->input->post('oleh');

    $data = array (
      'nomor' => $nomor,
      'nama' => $nama,
      'tempat_lahir' => $t4_lahir,
      'tgl_lahir' => $tgl_lahir,
      'nm_ayah' => $ayah,
      'nm_ibu' => $ibu,
      'hari_baptis' => $hari_baptis,
      'tgl_baptis' => $tgl_baptis,
      'nm_pastor' => $oleh
      );

    $this->M_surat->insert_data('data_baptis', $data);
    redirect('Surat_baptis');
  }

  function edit(){
    $id = $this->input->post('id');
    $where = array('nomor' => $id);

    $nomor = $this->input->post('nomor');
    $nama = $this->input->post('nama');
    $t4_lahir = $this->input->post('tempat_lahir');
    $tgl_lahir = $this->input->post('tanggal_lahir');
    $ayah = $this->input->post('nama_ayah');
    $ibu = $this->input->post('nama_ibu'); 
    $hari_baptis = $this->input->post('hari_baptis');
    $tgl_baptis = $this->input->post('tanggal_baptis');
    $oleh = $this->input->post('oleh');

    $data = array (
      'nomor' => $nomor,
      'nama' => $nama,
      'tempat_lahir' => $t4_lahir,
      'tgl_lahir' => $tgl_lahir,
      'nm_ayah' => $ayah,
      'nm_ibu' => $ibu,
      'hari_baptis' => $hari_baptis,
      'tgl_baptis' => $tgl_baptis,
      'nm_pastor' => $oleh
      );

    $this->M_surat->update_data('data_baptis', $data, $where);
    redirect('Surat_baptis'); 
  }

  function get_nomor_surat(){

    $bulan = date("m");
    $bulan_romawi = $this->M_surat->romawi($bulan);
    // format nomor
    // contoh ====> 001/GPT/A/III/19
    //              [Nomor]/GPT/A/[bulan]/[tahun]
    $year = date('y');
    $format_nomor = "/GPT/A/".$bulan_romawi."/".$year;
    // Auto Nomor
    // nomor mulai dari 1 untuk tahun berbeda
    $nomor = 1;
    $nomor = $this->M_surat->addZero($nomor);
    $found = true;
    while($found){
        $sql="SELECT nomor FROM data_baptis WHERE nomor LIKE '$nomor%' AND nomor LIKE '%$year'";
        $res = $this->db->query($sql);    
        if($res->num_rows() > 0){
            $nomor= $nomor + 1;
            $nomor = $this->M_surat->addZero($nomor);
        } else {
            $found = false;
        }
    }
    $nomor = $this->M_surat->addZero($nomor).$format_nomor;
    return $nomor;
  }
  

}
?>