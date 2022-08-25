<body class="latar">
<div class="page-header">
    <h1 style="color: #000;" align="center"><b>Tambah Gejala</b></h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label style="color: #000;">Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', kode_oto('kode_gejala', 'tb_gejala', 'G', 2))?>"/>
            </div>
            <div class="form-group">
                <label style="color: #000;">Nama Gejala <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama')?>"/>
            </div>
            <div class="form-group">
                <label style="color: #000;">Gambar<span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control" value="<?=set_value('gambar')?>" >
            </div>
            <div class="form-group">
                <button class="btn edit"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn edit" href="?m=gejala"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>