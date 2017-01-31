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
                                        <th>Nomor</th>
                                        <th>Nama Agen</th>
                                        <th>Nomor Lisensi</th>
                                        <th>Jabatan</th>
                                        <th>Jumlah Organisasi</th>
                                        <th>Total Produksi</th>
                                    </tr>
                                </thead>
                                
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
        
        $('.count-to').countTo();
        
        $('body').on('hidden.bs.modal', '.modal', function () {
          $(this).removeData('bs.modal');
        });

        $(document).ready(function() {
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
            {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };
    
            var t = $("#tabel").dataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#mytable_filter input')
                            .off('.DT')
                            .on('keyup.DT', function(e) {
                                if (e.keyCode == 13) {
                                    api.search(this.value).draw();
                        }
                    });
                },
                oLanguage: {
                    sProcessing: "loading..."
                },
                responsive: {
                    details: true
                },
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {"url": "<?php echo site_url('dashboard/jsonDataAgen')?>", "type": "POST"},
                columns: [
                    {"data": null},
                    {"data": "user_namaAgen"},
                    {"data": "user_nomorLisensi"},
                    {"data": "user_namaJabatanAgen"},
                    {"data": "user_idPusat"},
                    {"data": "user_idPusat"}
                ],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    //var idPusat = data['user_idPusat'];
                    
                    $('td:eq(0)', row).html(index);
                    
                    $.post( "<?php echo site_url('dashboard/linkAgenJumlahOrganisasi') ?>", { idPusat: data['user_idPusat'] })
                        .done(function(data){
                            $('td:eq(4)', row).html(data);
                        });

                    $.post( "<?php echo site_url('dashboard/linkAgenTotalProduksi') ?>", { idPusat: data['user_idPusat'] })
                        .done(function(data){
                            $('td:eq(5)', row).html(data);
                        });
                }
            });
        });

    </script>

    </html>