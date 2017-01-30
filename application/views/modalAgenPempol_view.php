    <link href="<?php echo base_url() ?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATA AGEN PEMPOL
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </h2>
                <!--ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul-->
            </div>
            <div class="body table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example" id="jempol">
                    <thead>
                        <tr>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($pempol->num_rows() > 0){
                            foreach($pempol->result() as $row){
                                ?>

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

                        <?php        
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Jquery Core Js -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    
    <script src="<?php echo base_url() ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    
    <script type="text/javascript">
        
        $('#jempol').DataTable();

    </script>
