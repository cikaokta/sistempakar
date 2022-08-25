<body class="latar">
<div class="page-header">
    <h1 style="color: #000;" align="center"><b>Penyakit</b></h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading" align="right">
        <form class="form-inline">
            <input type="hidden" name="m" value="diagnosa" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=@$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn tambah"><span class="glyphicon glyphicon-search"></span></button>
            </div>
            <span class="pull-left">
            <div class="form-group">
                <a class="btn tambah" href="?m=diagnosa_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
            </div></span>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover ">
            <thead><tr class="nw">
                <th>No</th>
                <th>Kode</th>
                <th>Nama Hama dan Penyakit</th>
                <th>Solusi</th>
                <th>Gambar</th>
                <th>Rekomendasi</th>
                <th>Aksi</th>
            </tr></thead>
            <?php
            $q = esc_field(@$_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_diagnosa 
                WHERE kode_diagnosa LIKE '%$q%' OR nama_diagnosa LIKE '%$q%' OR penyebab LIKE '%$q%' OR solusi LIKE '%$q%'
                ORDER BY kode_diagnosa");
            $no=0;            
            foreach($rows as $row):?>
            <tr>
                <td><?=++$no ?></td>
                <td><?=$row->kode_diagnosa?></td>
                <td><?=$row->nama_diagnosa?></td>
                <td><?=$row->solusi?></td>
                <td><?php if($row->gambar == null){
                   echo "Tidak Ada Gambar";  }else{?><img src="gambar/<?=$row->gambar?>" width="100px" height="100px">
                <?php }?>
                </td>
                <td><?php if($row->merk == null){
                   echo "Tidak Ada Gambar";  }else{?><img src="gambar/<?=$row->merk?>" width="100px" height="100px">
                <?php }?>
                </td>
                <td class="nw">
                    <a class="btn btn-xs edit" href="?m=diagnosa_ubah&ID=<?=$row->kode_diagnosa?>"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="btn btn-xs edit" href="aksi.php?act=diagnosa_hapus&ID=<?=$row->kode_diagnosa?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
</body>