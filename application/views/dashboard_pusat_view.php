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
                                        <th>Nomor</th>
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
                                        <th>Nomor</th>
                                        <th>Kode kantor</th>
                                        <th>Nama Kantor</th>
                                        <th>Nama Kantor Wilayah</th>
                                        <th>Kode Kantor Wilayah</th>
                                        <th>Divisi</th>
                                        <th>Distribusi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
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

    </script>

    </html>