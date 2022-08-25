<body class="latar">
<div class="page-header">
    <h1 style="color: #000;" align="center"><b>Tambah Basis Pengetahuan</b></h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label style="color: #000;">Penyakit <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_diagnosa">
                    <option value="">&nbsp;</option>
                    <?=CF_get_diagnosa_option(set_value('kode_diagnosa'))?>
                </select>
            </div>
            <div class="form-group">
                <label style="color: #000;">Gejala <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_gejala">
                    <option value="">&nbsp;</option>
                    <?=CF_get_gejala_option(set_value('kode_gejala'))?>
                </select>
            </div>
            <div class="form-group">
                <label style="color: #000;">MB <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="mb" value="<?=set_value('mb')?>" />
            </div>
            <div class="form-group">
                <label style="color: #000;">MD <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="md" value="<?=set_value('md')?>" />
            </div>
            <div class="form-group">
                <button class="btn edit"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn edit" href="?m=relasi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>