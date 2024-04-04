@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('transaksi/create')}}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter : </label>
                    <div class="col-3">
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach($user as $item)
                            <option value="{{ $item->user_id }}">{{ $item->username }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Nama User</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Pembeli</th>
                    <th>Tanggal Penjualan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div> @endsection

@push('css') @endpush
@push('js')
<script>
    $(document).ready(function() {
        var dataUser = $('#table_penjualan').DataTable({
            serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
            ajax: {
                "url": "{{ url('transaksi/list') }}",
                "dataType": "json",
                "type": "GET",
                "data": function(d) {
                    d.user_id = $('#user_id').val();
                }
            },
            columns: [{
                data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "user.username",
                className: "",
                orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: true // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "pembeli",
                className: "",
                orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: true // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "penjualan_tanggal",
                className: "",
                orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: true // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "aksi",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisadiurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisadicari
            }]
        });

        $('#user_id').on('change', function() {
            dataUser.ajax.reload();
        });
    });
</script>
@endpush