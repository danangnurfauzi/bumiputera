<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/sidebar') ?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>No Lisensi</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>No Lisensi</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach( $agen->result() as $row ){ ?>
                                    <tr>
                                        <td><?php echo $row->user_namaAgen ?></td>
                                        <td><?php echo $row->user_nomorLisensi ?></td>
                                        <td><?php echo $row->user_namaJabatanAgen ?></td>
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

    <?php $this->load->view('template/footer') ?>

    <script type="text/javascript">
        
        $('.test').DataTable();

        $('.count-to').countTo();

    </script>

    </html>