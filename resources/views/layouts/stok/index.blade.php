@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create')}}">Tambah</a>
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
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Nama Barang</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah Stok</th>
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
        var dataUser = $('#table_stok').DataTable({
            serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
            ajax: {
                "url": "{{ url('stok/list') }}",
                "dataType": "json",
                "type": "GET",
                "data": function(d) {
                    d.barang_id = $('#barang_id').val();
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
                data: "barang.barang_nama",
                className: "",
                orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: true // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "stok_tanggal",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "stok_jumlah",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "aksi",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisadiurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisadicari
            }]
        });

        $('#barang_id').on('change', function() {
            dataUser.ajax.reload();
        });
    });
</script>
@endpush