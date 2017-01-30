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

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH SP</div>
                            <div class="number" id="jumlahSP"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH UP</div>
                            <div class="number" id="jumlahUP"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH PP</div>
                            <div class="number" id="jumlahPP"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH AGEN</div>
                            <div id="jumlahAgen" class="number"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA KANTOR WILAYAH
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <!--li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li-->
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover tes nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode kantor</th>
                                        <th>Nama Kantor</th>
                                        <th>Jumlah Agen</th>
                                        <th>Jumlah AFYP</th>
                                        <th>Jumlah SP</th>
                                        <th>Jumlah UP</th>
                                        <th>Jumlah PP</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Kode kantor</th>
                                        <th>Nama Kantor</th>
                                        <th>Jumlah Agen</th>
                                        <th>Jumlah AFYP</th>
                                        <th>Jumlah SP</th>
                                        <th>Jumlah UP</th>
                                        <th>Jumlah PP</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if ($namaKantor->num_rows() > 0) {
                                                foreach ($namaKantor->result() as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row->k_kode ?></td>
                                        <td><a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('dashboard/modalWilayahPempol/'.$row->k_kode) ?>" ><?php echo $row->k_nama ?></a></td>
                                        <td><a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('dashboard/modalAgenWilayah/'.$row->k_kode) ?>" ><?php jumlahAgenPerWilayah($row->k_kode) ?></a></td>
                                        <td><?php echo number_format(jumlahPremiAFYPPerWilayah($row->k_kode),2); ?></td>
                                        <td><?php jumlahSPPerWilayah($row->k_kode) ?></td>
                                        <td><?php echo number_format(jumlahPremiPokokPerWilayah($row->k_kode),2) ?></td>
                                        <td><?php echo number_format(jumlahPPPerWilayah($row->k_kode),2) ?></td>
                                    </tr>
                                    <?php 
                                                }
                                            }
                                    ?>
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
        
        var pathArray   =   window.location.pathname.split( '/' );
        var segment_1   =   pathArray[1];
        var webroot     =   (window.location.protocol + "//" + window.location.host + "/");

        $('body').on('hidden.bs.modal', '.modal', function () {
          $(this).removeData('bs.modal');
        });

        $('.count-to').countTo();
        
        $(function () {
	    $('.tes').DataTable({
	    	responsive: {
		        details: true
		    }
	    });	
	});
        
        var kodeWilayah = '<?php echo $_SESSION['kodeKantorWilayah'] ?>';
        
        $( document ).ready(function() {

            $.ajax({
                url: webroot+'counter/jumlahAgenWilayah/'+kodeWilayah,
                type: 'get',
                success:function(response){
                    $('#jumlahAgen').text(response);
                }
            });

            $.ajax({
                url: webroot+'counter/jumlahSPWilayah/'+kodeWilayah,
                type: 'get',
                success:function(response){
                    $('#jumlahSP').text(response);
                }
            });

            $.ajax({
                url: webroot+'counter/jumlahUPWilayah/'+kodeWilayah,
                type: 'get',
                success:function(response){
                    $('#jumlahUP').text(response);
                }
            });

            $.ajax({
                url: webroot+'counter/jumlahPPWilayah/'+kodeWilayah,
                type: 'get',
                success:function(response){
                    $('#jumlahPP').text(response);
                }
            });

        });

    </script>

    </html>