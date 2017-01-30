<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/sidebar') ?>
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
                                DATA PEMPOL
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
                                    	<th>Jabatan Agen</th>
                                        <th>No. Polis</th>
                                        <th>Nama Pempol</th>
                                        <th>Tanggal Mulai</th>
                                        <th>CB Premi</th>
                                        <th>Premi Top</th>
                                        <th>Premi AFYP</th>
                                        <th>PP</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                	<?php 
                                		if($pempol->num_rows() > 0){ 
                                			foreach($pempol->result() as $row){ ?>
                                	<tr>
                                		<td><?php echo $row->user_namaAgen ?></td>
                                		<td><?php echo $row->user_namaJabatanAgen ?></td>
                                		<td><?php echo $row->r_nomorPolis ?></td>
                                		<td><?php echo $row->r_namaPempol ?></td>
                                		<td><?php echo $row->r_tanggalMulai ?></td>
                                		<td><?php echo $row->r_cbPremi ?></td>
                                		<td><?php echo $row->r_premiTopUp ?></td>
                                		<td><?php echo $row->r_premiAFYP ?></td>
                                		<td><?php echo $row->r_premiPokok + $row->r_premiTopUp ?></td>
                                	</tr>
                                	<?php } } ?>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php $this->load->view('template/footer') ?>

    <script type="text/javascript">

        $('.count-to').countTo();  
        
        $(function () {
	    $('#tabel').DataTable({
	    	responsive: {
		        details: true
		    }
	    });	
	});

    </script>

    </html>