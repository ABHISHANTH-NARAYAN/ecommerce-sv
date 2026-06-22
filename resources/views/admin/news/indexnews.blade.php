<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>News Management</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<style>
:root{
    --bg:#0f172a;
    --card:#111827;
    --card2:#1e293b;
    --border:#334155;
    --text:#f8fafc;
    --muted:#94a3b8;
    --primary:#6366f1;
    --success:#22c55e;
    --warning:#f59e0b;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Inter,system-ui,sans-serif;
    background:linear-gradient(135deg,#020617,#0f172a,#111827);
    color:var(--text);
    min-height:100vh;
}

/* HEADER */
.page-header{
    padding:30px;
    border-bottom:1px solid rgba(255,255,255,.08);
    backdrop-filter:blur(10px);
}

.page-header h1{
    font-size:32px;
    font-weight:800;
}

.page-header p{
    color:var(--muted);
    margin-top:6px;
}

.container{
    max-width:1400px;
    margin:auto;
    padding:25px;
}

/* TOP BAR */
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    gap:20px;
    flex-wrap:wrap;
}

.btn-primary{
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    color:white;
    padding:12px 18px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    box-shadow:0 10px 25px rgba(99,102,241,.25);
    transition:.3s;
}

.btn-primary:hover{
    transform:translateY(-2px);
}

/* SUCCESS */
.success{
    background:rgba(34,197,94,.15);
    border:1px solid rgba(34,197,94,.3);
    color:#86efac;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

/* FILTERS */
.filters{
    background:rgba(17,24,39,.9);
    border:1px solid rgba(255,255,255,.08);
    border-radius:18px;
    padding:20px;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:25px;
}

.filter-group{
    min-width:220px;
}

.filter-group label{
    display:block;
    margin-bottom:8px;
    color:#cbd5e1;
    font-size:14px;
}

.filter-group select{
    width:100%;
    padding:12px;
    background:#0f172a;
    border:1px solid var(--border);
    border-radius:12px;
    color:white;
}

/* TABLE CARD */
.table-card{
    background:rgba(17,24,39,.95);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    overflow:hidden;
    padding:20px;
}

/* DATATABLE */
table.dataTable{
    color:white !important;
}

table.dataTable thead{
    background:#1e293b;
}

table.dataTable thead th{
    color:white !important;
    border:none !important;
}

table.dataTable tbody td{
    background:#111827 !important;
    color:#e2e8f0 !important;
}

.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select{
    background:#0f172a;
    color:white;
    border:1px solid var(--border);
    border-radius:10px;
    padding:8px;
}

.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate{
    color:white !important;
}

.paginate_button{
    color:white !important;
}

/* STATUS */
.status-pill{
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.published{
    background:rgba(34,197,94,.15);
    color:#4ade80;
}

.draft{
    background:rgba(245,158,11,.15);
    color:#fbbf24;
}

/* MOBILE */
@media(max-width:768px){

    .top-bar{
        flex-direction:column;
        align-items:flex-start;
    }

    .filters{
        flex-direction:column;
    }

    .filter-group{
        width:100%;
    }
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="page-header">
    <h1>📰 News Management</h1>
    <p>Manage all news articles, categories and publishing status.</p>
</div>

<div class="container">

    <!-- TOP BAR -->
    <div class="top-bar">

        <div>
            <h2>News List</h2>
        </div>

        <a href="{{ route('admin.news.create') }}" class="btn-primary">
            + Create News
        </a>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- FILTERS -->
    <div class="filters">

        <div class="filter-group">
            <label>Status</label>
            <select id="statusFilter">
                <option value="">All Status</option>
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
            </select>
        </div>

        <div class="filter-group">
            <label>Category</label>
            <select id="categoryFilter">
                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-card">

        <table id="news-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(function () {

    let table = $('#news-table').DataTable({
        processing: true,
        serverSide: true,

        ajax: {
            url: "{{ route('admin.news.index') }}",
            data: function (d) {
                d.status = $('#statusFilter').val();
                d.news_category_id = $('#categoryFilter').val();
            }
        },

        columns: [
            { data:'DT_RowIndex', orderable:false, searchable:false },
            { data:'category', defaultContent:'No Category' },
            { data:'title' },
            { data:'description' },
            { data:'status' },
            { data:'image', orderable:false, searchable:false },
            { data:'action', orderable:false, searchable:false }
        ],

        pageLength: 10,
        responsive: true
    });

    $('#statusFilter, #categoryFilter').change(function(){
        table.ajax.reload();
    });

});
</script>

</body>
</html>