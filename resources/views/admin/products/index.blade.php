<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products List</title>

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<style>
    body {
        margin: 0;
        font-family: system-ui, Arial, sans-serif;
        background: #f4f6fb;
        color: #111827;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 25px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    h2 {
        margin: 0;
        font-size: 26px;
    }

    .btn {
        padding: 10px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .btn-primary:hover {
        background: #4338ca;
    }

    .filters {
        background: #fff;
        padding: 15px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
        margin-bottom: 20px;
    }

    .filters select {
        padding: 8px 10px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        outline: none;
        min-width: 180px;
    }

    .btn-reset {
        background: #ef4444;
        color: #fff;
    }

    .btn-reset:hover {
        background: #dc2626;
    }

    .table-wrapper {
        background: #fff;
        padding: 15px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    }

    table.dataTable {
        border-collapse: collapse !important;
        width: 100% !important;
    }

    table.dataTable thead {
        background: #111827;
        color: #fff;
    }

    table.dataTable thead th {
        padding: 12px;
        border: none;
    }

    table.dataTable tbody td {
        padding: 10px;
    }

    .success {
        background: #dcfce7;
        color: #166534;
        padding: 10px 12px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    @media(max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .filters {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h2>Products</h2>

        <a class="btn btn-primary"
           href="{{ route('admin.products.create') }}">
            + Create Product
        </a>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <!-- FILTERS -->
    <div class="filters">

        <div>
            <label><strong>Brand</strong></label><br>
            <select id="brandFilter">
                <option value="">All Brands</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label><strong>Color</strong></label><br>
            <select id="colorFilter">
                <option value="">All Colors</option>
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-top:18px;">
            <button class="btn btn-reset" id="resetFilter">
                Reset
            </button>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-wrapper">

        <table id="products-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Colors</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(function () {

    let table = $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],

        ajax: {
            url: "{{ route('admin.products.index') }}",
            data: function (d) {
                d.brand_id = $('#brandFilter').val();
                d.color_id = $('#colorFilter').val();
            }
        },

        columns: [
            { data: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'brand' },
            { data: 'colors', orderable:false, searchable:false },
            { data: 'name' },
            { data: 'price' },
            { data: 'description' },
            { data: 'status' },
            { data: 'stock' },
            { data: 'image', orderable:false, searchable:false },
            { data: 'action', orderable:false, searchable:false }
        ]
    });

    $('#brandFilter, #colorFilter').on('change', function () {
        table.ajax.reload();
    });

    $('#resetFilter').on('click', function () {
        $('#brandFilter').val('');
        $('#colorFilter').val('');
        table.ajax.reload();
    });

});
</script>

</body>
</html>