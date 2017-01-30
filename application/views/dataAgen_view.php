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
                                DATA AGEN
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover nowrap" id="tabel" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama Agen</th>
                                        <th>Nomor Lisensi</th>
                                        <th>Jabatan</th>
                                        <th>Jumlah Organisasi</th>
                                        <th>Total Produksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach( $agen->result() as $row ){ ?>
                                    <tr>
                                        <td><?php echo $row->user_namaAgen ?></a></td>
                                        <td><a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('dashboard/modalAgenPempol/'.$row->user_idPusat) ?>" ><?php echo $row->user_nomorLisensi ?></a></td>
                                        <td><?php echo $row->user_namaJabatanAgen ?></td>
                                        <td><a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('dashboard/modalAgenBawahan/'.$row->user_idPusat) ?>" ><?php echo jumlahOrganisasiAgen($row->user_idPusat) ?></td>
                                        <td><?php echo totalProduksi($row->user_idPusat) ?></td>
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
        
        $(function () {
	    $('#tabel').DataTable({
	    	responsive: {
		        details: true
		    }
	    });	
	});

        $('.count-to').countTo();
        
        $('body').on('hidden.bs.modal', '.modal', function () {
          $(this).removeData('bs.modal');
        });

    </script>

    </html>