<?php $this->load->view('template/header') ?>
<?php $this->load->view('template/sidebar') ?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DATA PEMPOL WILAYAH</h2>
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
                                    	<th>Nomor</th>
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
        
        //$('.test').DataTable();

        $('.count-to').countTo();

        var table;
 
        /**$(document).ready(function() {
         
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
                    "url": "<?php echo site_url('dashboard/ssp')?>",
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
         
        });**/
        
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
	            ajax: {"url": "<?php echo site_url('dashboard/jsonPempolWilayah')?>", "type": "POST"},
	            columns: [
	            	{"data": null},
	                {"data": "r_nomorPolis"},
	                {"data": "r_namaPempol"},
	                {"data": "r_tanggalMulai"},
	                {"data": "r_cbPremi"},
	                {"data": "r_premiTopUp"},
	                {"data": "r_premiAFYP"},
	                {"data": "PP"}
	            ],
	            rowCallback: function(row, data, iDisplayIndex) {
	                var info = this.fnPagingInfo();
	                var page = info.iPage;
	                var length = info.iLength;
	                var index = page * length + (iDisplayIndex + 1);
	                $('td:eq(0)', row).html(index);
	            }
	        });
	    });
    </script>

    </html>