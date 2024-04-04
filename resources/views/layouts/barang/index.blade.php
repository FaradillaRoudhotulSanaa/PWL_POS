@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create')}}">Tambah</a>
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
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">- Semua -</option>
                            @foreach($kategori as $item)
                            <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori Barang</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Barang</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
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
        var dataUser = $('#table_barang').DataTable({
            serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
            ajax: {
                "url": "{{ url('barang/list') }}",
                "dataType": "json",
                "type": "GET",
                "data": function(d) {
                    d.kategori_id = $('#kategori_id').val();
                }
            },
            columns: [{
                data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "barang_kode",
                className: "",
                orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: true // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "kategori.kategori_nama",
                className: "",
                orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: true // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "barang_nama",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisa dicari
            }, {
                data: "harga_beli",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisadiurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisadicari
            }, {
                data: "harga_jual",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisadiurutkan
                searchable: false // searchable: true, jika ingin kolom ini bisadicari
            }, {
                data: "aksi",
                className: "",
                orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                searchable: false
            }]
        });

        $('#kategori_id').on('change', function() {
            dataUser.ajax.reload();
        });
    });
</script>
@endpush