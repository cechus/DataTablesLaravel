<!DOCTYPE html>
<html>
<head>
    <title>Laravel DataTables</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/datatables.min.js"></script>
</head>
<body>
 
<div class="container">
    <table id="task" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>Id</th>
            <th>Task</th>
            <th>Category</th>
            <th>State</th>
            <th>Estado</th>
        </tr>
        </thead>
    </table>
</div>
 
<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('#task').DataTable({
            "dom": '<"top"if>rt<"col-sm-7"p><"row"><"col-sm-4"l>',
            bInfo: true,
            bLengthChange: true,
            bFilter: true,
            processing: true,
            serverSide: true,
            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            scrollY:        400,
            deferRender:    true,
            scroller:       true,
            ajax: "{{ route('datatable.tasks') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'category', name: 'category'},
                {data: 'state', name: 'state'},
                //{data: 'Estado', name: 'estadoo'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            search: {
                "regex": true
            }
        });
    });
</script>
</body>
</html>