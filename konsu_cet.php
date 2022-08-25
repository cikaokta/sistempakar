<h1  align="center" style="font-size: 30px"><p>Hasil Diagnosa</p></h1>
<?php

$gejala = $_SESSION['gejala'] ;
$rows = $db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala IN (SELECT kode_gejala FROM tb_konsultasi WHERE jawaban='Ya')");
?>



<?php
$rows = $db->get_results("SELECT * 
    FROM tb_relasi r INNER JOIN tb_diagnosa d ON d.kode_diagnosa = r.kode_diagnosa      
    WHERE r.kode_gejala IN (SELECT kode_gejala FROM tb_konsultasi WHERE jawaban='Ya') ORDER BY r.kode_diagnosa, r.kode_gejala");

foreach($rows as $row){
    @$diagnosa[$row->kode_diagnosa]['mb'] = $diagnosa[$row->kode_diagnosa]['mb'] + $row->mb * (1 - $diagnosa[$row->kode_diagnosa]['mb']);
    @$diagnosa[$row->kode_diagnosa]['md'] = $diagnosa[$row->kode_diagnosa]['md'] + $row->md * (1 - $diagnosa[$row->kode_diagnosa]['md']);
    
    @$diagnosa[$row->kode_diagnosa]['cf'] = $diagnosa[$row->kode_diagnosa]['mb'] -  $diagnosa[$row->kode_diagnosa]['md'];     
}
?>
<div class="panel panel-default">
    <div class="panel-heading"> 
<h3 class="panel-title">Hasil Analisa</h3>
<table class="table table-bordered table-hover ">
<thead>
    <tr style="background-color: #535c68; color: #fff;">
        <th>No</th>
        <th>Penyakit</th>
        <th>Kepercayaan</th>
    </tr>
</thead>
<?php
$no=1;
function ranking($array){
    $new_arr = array();
    foreach($array as $key => $value) {
        $new_arr[$key] = $value['cf'];
    }
    arsort($new_arr);
    
    $result = array();    
    foreach($new_arr as $key => $value){
        @$result[$key] = ++$no;
    }    
    return $result;
}    

$rank = ranking($diagnosa);

foreach($rank as $key => $value):?>
<tr class="<?=($value==1) ? 'text-primary' : ''; ?>">
    <td><?=$no++; ?></td>
    <td><?=$DIAGNOSA[$key]->nama_diagnosa; ?></td>
    <td><?=$diagnosa[$key]['cf'] * 100; ?>%</td>
</tr>
<?php endforeach;
reset($rank);
?>
</table>

<div class="panel-body">
    <table class="table table-bordered">
        <tr>
            <td>Penyakit</td>
            <td><b><?=$DIAGNOSA[key($rank)]->nama_diagnosa; ?></b></td>
        </tr>
        <tr>
            <td>Solusi</td>
            <td><?=$DIAGNOSA[key($rank)]->solusi; ?></td>
        </tr>

    </table>