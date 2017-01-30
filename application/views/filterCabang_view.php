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
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH UP</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">ATASAN</div>
                            <div class="text"></div>
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
                            <div class="number count-to" data-from="0" data-to="<?php echo $agen ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
		
		<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FILTER DATA
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
                        	<form action="post" action="<?php site_url('Dashboard/filterCabang') ?>">
                        	<div class="row clearfix">
                            		<div class="col-md-4">
                                    
                                        	<div class="form-line">
                                        	<select name="wil" id="filterWilayah" style="width: 100%">
                                        		<option></option>
                                        		<?php foreach( $namaKantor->result() as $nk ){ ?>
                                        		<option value="<?php echo $nk->k_kode_kantor_wilayah ?>"><?php echo $nk->k_kantor_wilayah ?></option>
                                        		<?php } ?>
                                        	</select>
                                        	</div>
                                    
                                	</div>
                                	
                                	<div class="col-md-4">
                                    
                                        	<div class="form-line">
                                        	<select name="cab" id="filterCabang" style="width: 100%">
                                        		
                                        	</select>
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
                            <table class="table table-bordered table-striped table-hover nowrap" width="100%" id="tabel">
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
                                    <?php if ($namaKantorCabang->num_rows() > 0) {
                                                foreach ($namaKantorCabang->result() as $row) {
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
        
        $('body').on('hidden.bs.modal', '.modal', function () {
          $(this).removeData('bs.modal');
        });

        $('.count-to').countTo();
        
        $("#filterWilayah").select2({
        		placeholder: "Pilih Wilayah",
  			allowClear: true
        	});
       
       	$("#filterCabang").select2({
        		placeholder: "Pilih Cabang",
  			allowClear: true
        	});
        	
        $("#filterWilayah").change(function(){
        	var kodeWilayah = $(this).val();
        	
        	$.ajax({
	            type: 'post',
	            url: '<?php echo base_url() ?>dashboard/optionCabang',
	            data: {kodeWilayah: kodeWilayah},
	            success: function(response){
	                $("#filterCabang").html(response);
	            }
	        });
	});
        	
        $(document).ready(function() {
        	$('#tabel').DataTable({
        		responsive: {
			        details: true
			    },
			paging: false
        	});	
        });

    </script>

    </html>