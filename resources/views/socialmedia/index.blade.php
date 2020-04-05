@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Social Media Form</div>

                    <div class="row justify-content-center">
      <div class="col-md-12">
        <p><button type="button" class="btn btn-primary" onclick="document.location.href='{{ route('socialmedia.create') }}'"><i class="glyphicon glyphicon-list position-left"></i> New</button></p>
        <div class="box">
          <div class="box-body">
            <table class="table table-hover table-striped table-condensed dtt">
                <thead>
                    <tr role="row">
                        <th>ID</th>
						<th>service</th>
						<th>heading</th>
                        <th>web_link</th>
                        <th>video_link</th>
                        <th>image_link</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                    <tr>
						<th>ID</th>
						<th>service</th>
						<th>heading</th>
                        <th>web_link</th>
                        <th>video_link</th>
                        <th>image_link</th>
                    </tr>
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function () {
            $('.dtt').each(function () {
                $(this).DataTable({
                    processing: true,
                    serverSide: true,
                     ajax: '{{ route('socialmedia.get_data') }}',
                    columns: [
                        { data: 'id', name: 'id' },
						{ data: 'service', name: 'service' },
						{ data: 'heading', name: 'heading' },
                        { data: 'web_link', name: 'web_link' },
						{ data: 'video_link', name: 'video_link' },
						{ data: 'image_link', name: 'image_link' },
                        { data: null, className: "center", render: function ( data, type, row ) {
                              // Combine the first and last names into a single table field
                              return '<a href="/socialmedia/edit/' + data.id + '" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>';
                          } },

                        ],
                    columnDefs: [
                          { targets: [3], "orderable": false },
                          { targets: [3], "searchable": false },

                      ],
                      lengthMenu: [[10, 25, 50,100, 500], [10, 25, 50,100, 500]],
                    buttons: {
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                className: 'btn bg-teal-400',
                                text: '<i class="icon-copy position-left"></i> Copy ',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                text: '<i class="icon-printer position-left"></i> Print ',
                                className: 'btn bg-teal-400',
                                autoPrint: false,
                                message: "Social Media Share, Date: {{  \Carbon\Carbon::now() }}, From A To Z",
                                exportOptions: {
                                    columns: ':visible'
                                },
                                customize: function (win) {
                                    $(win.document.body)
                                        .css('font-size', '10pt')
                                        .prepend(
                                        '<div style="position:inherit; top:0; left:40%; width: 300;"><label>Social Media Share</label></div> '
                                        );

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }

                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="icon-file-excel position-left"></i> Excel',
                                className: 'btn bg-teal-400',
                                exportOptions: {
                                    columns: ':visible'
                                },
                                customize: function (xlsx) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    var numrows = 3;
                                    var clR = $('row', sheet);

                                    //update Row
                                    clR.each(function () {
                                        var attr = $(this).attr('r');
                                        var ind = parseInt(attr);
                                        ind = ind + numrows;
                                        $(this).attr("r", ind);
                                    });

                                    // Create row before data
                                    $('row c ', sheet).each(function () {
                                        var attr = $(this).attr('r');
                                        var pre = attr.substring(0, 1);
                                        var ind = parseInt(attr.substring(1, attr.length));
                                        ind = ind + numrows;
                                        $(this).attr("r", pre + ind);
                                    });

                                    function Addrow(index, data) {
                                        msg = '<row r="' + index + '">'
                                        for (i = 0; i < data.length; i++) {
                                            var key = data[i].key;
                                            var value = data[i].value;
                                            msg += '<c t="inlineStr" r="' + key + index + '">';
                                            msg += '<is>';
                                            msg += '<t>' + value + '</t>';
                                            msg += '</is>';
                                            msg += '</c>';
                                        }
                                        msg += '</row>';
                                        return msg;
                                    }


                                    //insert
                                    var r1 = Addrow(1, [{ key: 'A', value: '111' }, { key: 'B', value: '112' }]);
                                    var r2 = Addrow(2, [{ key: 'A', value: '221' }, { key: 'B', value: '222' }]);
                                    var r3 = Addrow(3, [{ key: 'A', value: '331' }, { key: 'B', value: '332' }]);

                                    sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2 + r3 + sheet.childNodes[0].childNodes[1].innerHTML;
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="icon-file-pdf position-left"></i> PDF',
                                className: 'btn bg-teal-400',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'colvis',
                                text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                                className: 'btn bg-teal-400 btn-icon'
                            }
                        ]
                    },

                    minimumResultsForSearch: Infinity,
                    width: 'auto'
                });

                $.extend($.fn.dataTable.defaults, {
                    autoWidth: false,
                    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',

                });
            });

        })
        
    </script>
@endsection
