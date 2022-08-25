<body class="latar">
<div class="page-header">
    <h1 style="color: #000;" align="center"><b>Gejala</b></h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading" align="right">        
        <form class="form-inline">
            <input type="hidden" name="m" value="gejala" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=@$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn tambah"><span class="glyphicon glyphicon-search"></span></button>
            </div>
            <span class="pull-left">
            <div class="form-group">
                <a class="btn tambah" href="?m=gejala_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
            </div></span>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead><tr>
                <th>Kode</th>
                <th>Nama Gejala</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr></thead>
            <?php
            $q = esc_field(@$_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_gejala 
            WHERE kode_gejala LIKE '%$q%' OR nama_gejala LIKE '%$q%' OR keterangan LIKE '%$q%' 
            ORDER BY kode_gejala");
            $no=0;
            foreach($rows as $row):?>
            <tr>
                <td><?=$row->kode_gejala ?></td>
                <td><?=$row->nama_gejala?></td>

                <td><?php if($row->gambar == null){
                   echo "Tidak Ada Gambar";  }else{?><img src="gambar/<?=$row->gambar?>" width="100px" height="100px">
                <?php }?>
                </td>
                <td class="nw">
                    <a class="btn btn-xs edit" href="?m=gejala_ubah&ID=<?=$row->kode_gejala?>"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="btn btn-xs edit" href="aksi.php?act=gejala_hapus&ID=<?=$row->kode_gejala?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>