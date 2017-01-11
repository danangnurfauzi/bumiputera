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
                <h2>DASHBOARD</h2>
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
                            <div class="text"><?php echo ($namaAtasan->num_rows() > 0) ? $namaAtasan->row()->user_namaAgenInduk : '' ?></div>
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

            <?php if( $role != 0 ){ ?>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA BAWAHAN
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel">
                                <thead>
                                    <tr>
                                        <th>Nomor ID Pusat</th>
                                        <th>Nomor Lisensi</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nomor ID Pusat</th>
                                        <th>Nomor Lisensi</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if( $bawahan->num_rows() > 0 ){  foreach( $bawahan->result() as $row ){ ?>
                                    <tr>
                                        <td><?php echo $row->user_idPusat ?></td>
                                        <td><?php echo $row->user_nomorLisensi ?></td>
                                        <td><a data-toggle="modal" href="<?php echo site_url('dashboard/modalPempol/'.$row->user_idPusat) ?>" data-target="#myModal"><?php echo $row->user_namaAgen ?></a></td>
                                        <td><?php echo $row->user_namaJabatanAgen." (".$row->user_kodeJabatanAgen.")" ?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php }else{ ?>

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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel">
                                <thead>
                                    <tr>
                                        <th>Kode kantor</th>
                                        <th>Nama Kantor</th>
                                        <th>Nama Kantor Wilayah</th>
                                        <th>Kode Kantor Wilayah</th>
                                        <th>Divisi</th>
                                        <th>Distribusi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Kode kantor</th>
                                        <th>Nama Kantor</th>
                                        <th>Nama Kantor Wilayah</th>
                                        <th>Kode Kantor Wilayah</th>
                                        <th>Divisi</th>
                                        <th>Distribusi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if( $namaKantor->num_rows() > 0 ){  foreach( $namaKantor->result() as $row ){ ?>
                                    <tr>
                                        <td><?php echo $row->k_kode ?></td>
                                        <td><?php echo $row->k_nama ?></td>
                                        <td><?php echo $row->k_kantor_wilayah ?></td>
                                        <td><?php echo $row->k_kode_kantor_wilayah ?></td>
                                        <td><?php echo $row->k_divisi ?></td>
                                        <td><?php echo $row->k_distribusi ?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>

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

        <?php if($role == 0){ ?>

        var table;
 
        $(document).ready(function() {
         
            //datatables
            table = $('#tabel').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "destroy": true,
                "searching": true,
                "paging": true,

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('dashboard/ajax_list_kantor')?>",
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],
         
            });
         
        });

        <?php } ?>

    </script>

    </html>