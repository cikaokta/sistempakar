<?php
error_reporting(~E_NOTICE);
session_start();
$config["server"]='localhost';
$config["username"]='root';
$config["password"]='';
$config["database_name"]='spforwardcf3';

include'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include'includes/general.php';

$mod = @$_GET['m'];
$act = @$_GET['act'];   

$rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala ORDER BY kode_gejala");
$GEJALA = array();
foreach($rows as $row){
    $GEJALA[$row->kode_gejala] = $row->nama_gejala;
}

$rows = $db->get_results("SELECT * FROM tb_diagnosa ORDER BY kode_diagnosa");
$DIAGNOSA = array();
foreach($rows as $row){
    $DIAGNOSA[$row->kode_diagnosa] = $row;
}

function get_terjawab(){
    global $db;
    $rows = $db->get_results("SELECT kode_gejala, jawaban FROM tb_konsultasi");
    foreach($rows as $row){
        $arr[$row->kode_gejala] = $row->jawaban;
    }
    return @$arr;
}

function  get_next_gejala($relasi){
    eliminate_relasi($relasi);
    foreach($relasi as $key => $val){
        foreach($val as $k => $v){
            if($v=='')
                return $k;
        }
    }
    return false;
}

function get_relasi($terjawab){
    global $db;
    $rows = $db->get_results("SELECT kode_diagnosa, r.kode_gejala 
        FROM tb_relasi r
        ORDER BY kode_diagnosa, r.kode_gejala");
    $arr = array();
    foreach($rows as $row){
        $arr[@$row->kode_diagnosa][@$row->kode_gejala] = @$terjawab[$row->kode_gejala];
    }
    //echo '<pre>' . print_r($terjawab, 1) . '</pre>';
    return $arr;
}

function eliminate_relasi(&$relasi){
    foreach($relasi as $key => $val){
        $tidak=0;
        foreach($val as $k => $v){
            if($v=='Tidak')
                $tidak++;
        }
        if($tidak>=2 || $tidak >= count($val)/2)
            unset($relasi[$key]);
    }
    //echo '<pre>' . print_r($relasi, 1) . '</pre>';
}






function CF_get_diagnosa_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_diagnosa, nama_diagnosa FROM tb_diagnosa ORDER BY kode_diagnosa");
    foreach($rows as $row){
        if($row->kode_diagnosa==$selected)
            $a.="<option value='$row->kode_diagnosa' selected>[$row->kode_diagnosa] $row->nama_diagnosa</option>";
        else
            $a.="<option value='$row->kode_diagnosa'>[$row->kode_diagnosa] $row->nama_diagnosa</option>";
    }
    return $a;
}

function CF_get_gejala_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala ORDER BY kode_gejala");
    foreach($rows as $row){
        if($row->kode_gejala==$selected)
            $a.="<option value='$row->kode_gejala' selected>[$row->kode_gejala] $row->nama_gejala</option>";
        else
            $a.="<option value='$row->kode_gejala'>[$row->kode_gejala] $row->nama_gejala</option>";
    }
    return $a;
}