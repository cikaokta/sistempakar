<?php
$rows = $db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala IN (SELECT kode_gejala FROM tb_konsultasi WHERE jawaban='Ya')");
if( !$rows ) :
    print_msg('Belum ada gejala terpilih!', 'warning');
    echo '<p><a class="btn btn-primary" href="aksi.php?m=konsu&act=new"><span class="glyphicon glyphicon-refresh"></span> Konsultasi Lagi</a></p>';
else:

?>
<div class="panel panel-primary">
    <div class="panel-heading">        
        <h3 class="panel-title">Gejala Terpilih</h3>
    </div>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Gejala</th>
        </tr>
    </thead>
    <?php
    $no=1;
    foreach($rows as $row):?>
    <tr>
        <td><?=$no++?></td>
        <td><?=$row->nama_gejala?></td>
    </tr>
    <?php endforeach;
    ?>
    </table>
</div>
<?php
$rows = $db->get_results("SELECT * 
    FROM tb_relasi r INNER JOIN tb_diagnosa d ON d.kode_diagnosa = r.kode_diagnosa      
    WHERE r.kode_gejala IN (SELECT kode_gejala FROM tb_konsultasi WHERE jawaban='Ya') ORDER BY r.kode_diagnosa, r.kode_gejala");

foreach($rows as $row){
    $diagnosa[$row->kode_diagnosa]['mb'] = $diagnosa[$row->kode_diagnosa]['mb'] + $row->mb * (1 - $diagnosa[$row->kode_diagnosa]['mb']);

    $diagnosa[$row->kode_diagnosa]['md'] = $diagnosa[$row->kode_diagnosa]['md'] + $row->md * (1 - $diagnosa[$row->kode_diagnosa]['md']);
    
    $diagnosa[$row->kode_diagnosa]['cf'] = $diagnosa[$row->kode_diagnosa]['mb'] -  $diagnosa[$row->kode_diagnosa]['md'];     
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">        
        <h3 class="panel-title">Hasil Analisa</h3>
    </div>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
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
            $result[$key] = ++$no;
        }    
        return $result;
    }    
     
    $rank = ranking($diagnosa);
   
    foreach($rank as $key => $value):?>
    <tr class="<?=($value==1) ? 'text-primary' : ''?>">
        <td><?=$no++?></td>
        <td><?=$DIAGNOSA[$key]->nama_diagnosa?></td>
        <td><?=$diagnosa[$key]['cf']?></td>
    </tr>
    <?php endforeach;
    reset($rank);
    $_SESSION['gejala'] = $gejala;
    ?>
    </table>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <td>Diagnosa</td>
                <td><?=$DIAGNOSA[key($rank)]->nama_diagnosa?></td>
            </tr>
            
            <tr>
                <td>Solusi</td>
                <td><?=$DIAGNOSA[key($rank)]->keterangan?></td>
            </tr>
        </table>
        
        <p>
            <a class="btn btn-primary" href="aksi.php?m=konsu&act=new"><span class="glyphicon glyphicon-refresh"></span> Konsultasi Lagi</a>
            <a class="btn btn-default" href="cetak.php?m=konsu" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </p>       
    </div>
</div>
<?php endif;?>