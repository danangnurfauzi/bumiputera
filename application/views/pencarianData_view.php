<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/sidebar') ?>

<style media="screen" type="text/css">

.modal-dialog {
  width: 100%;
  height: 100%;
  padding: 0;
}

.modal-content {
  height: 100%;
  border-radius: 0;
}

</style>

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FILTER
                            </h2>
                        </div>
                        <div class="body">
                            <form id="target">
                            <div class="row clearfix">
                                    <div class="col-md-4">
                                    
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input class="form-control" placeholder="Pilih Tanggal" type="text" id="dates" name="date">
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="col-md-4">
                                    
                                            <div class="form-line">
                                            <input type="submit" name="submit" value="FILTER" />
                                            </div>
                                    
                                    </div>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover nowrap" id="tabel" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Kantor Wilayah</th>
                                        <th colspan="8">BERLAKU</th>
                                        <th colspan="8">KADALUARSA</th>
                                    </tr>
                                    <tr>
                                        <th>AGEN</th>
                                        <th>AK</th>
                                        <th>RAM</th>
                                        <th>SAM</th>
                                        <th>AM</th>
                                        <th>UM</th>
                                        <th>FC</th>
                                        <th>JUMLAH</th>
                                        <th>AGEN</th>
                                        <th>AK</th>
                                        <th>RAM</th>
                                        <th>SAM</th>
                                        <th>AM</th>
                                        <th>UM</th>
                                        <th>FC</th>
                                        <th>JUMLAH</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach ($namaKantor->result() as $value){ ?>
                                        <tr>
                                            <td><?php echo $value->k_kantor_wilayah ?></td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_AGEN_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_AGEN_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_AK_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_AK_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_RAM_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_RAM_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_SAM_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_SAM_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_AM_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_AM_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_UM_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_UM_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_FC_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_FC_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_JUMLAH_1' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_JUMLAH_1' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_AGEN_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_AGEN_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_AK_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_AK_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_RAM_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_RAM_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_SAM_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_SAM_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_AM_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_AM_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_UM_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_UM_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_FC_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_FC_0' ?>" style="display: none;" />
                                            </td>
                                            <td id="<?php echo $value->k_kode_kantor_wilayah.'_JUMLAH_0' ?>">
                                                <img src="http://1opmgif057j3093j-zippykid.netdna-ssl.com/wp-content/themes/Extra/images/loading.gif" width="25" id="gambar_<?php echo $value->k_kode_kantor_wilayah.'_JUMLAH_0' ?>" style="display: none;" />
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                
            </div>
        </div>
    </div>

    <?php $this->load->view('template/footer') ?>

    <script type="text/javascript">
        
        $('.count-to').countTo();
        
        $('body').on('hidden.bs.modal', '.modal', function () {
          $(this).removeData('bs.modal');
        });

        $( "#target" ).submit(function( event ){
            
            var tanggal = $("#dates").val();

            <?php foreach($namaKantor->result() as $row){ ?>

                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_AGEN_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_AK_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_RAM_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_SAM_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_AM_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_UM_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_FC_1").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_JUMLAH_1").show();

                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_AGEN_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_AK_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_RAM_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_SAM_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_AM_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_UM_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_FC_0").show();
                $("#gambar_<?php echo $row->k_kode_kantor_wilayah ?>_JUMLAH_0").show();

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/agen/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        //alert(response);return false;
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_AGEN_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_AGEN_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/ak/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_AK_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_AK_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/ram/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_RAM_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_RAM_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/sam/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_SAM_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_SAM_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/am/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_AM_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_AM_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/um/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_UM_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_UM_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/fc/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_FC_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_FC_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/jumlah/<?php echo $row->k_kode_kantor_wilayah ?>/1',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_JUMLAH_1").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_JUMLAH_1").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/agen/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_AGEN_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_AGEN_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/ak/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_AK_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_AK_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/ram/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_RAM_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_RAM_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/sam/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_SAM_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_SAM_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/am/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_AM_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_AM_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/um/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_UM_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_UM_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/fc/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_FC_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_FC_0").html(response);
                    }
                });

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url() ?>dashboard/berlaku/jumlah/<?php echo $row->k_kode_kantor_wilayah ?>/0',
                    data: {tanggal: tanggal},
                    success: function(response){
                        $("#gambar_<?php echo $row->k_kode_kantor_wilayah?>_JUMLAH_0").hide();
                        $("#<?php echo $row->k_kode_kantor_wilayah?>_JUMLAH_0").html(response);
                    }
                });

            <?php } ?>

            event.preventDefault();

        });

        $('#dates').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });


    </script>

    </html>