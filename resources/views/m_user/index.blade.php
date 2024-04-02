@extends('m_user/template')
@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>CRUD User</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('user.create') }}" class="btn btn-success"> Input User</a>
        </div>
    </div>
</div>
@if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table table-bordered">
    <tr>
        <th width="5%" class="text-center">User id</th>
        <th width="5%" class="text-center">Level id</th>
        <th width="10%" class="text-center">username</th>
        <th width="10%" class="text-center">nama</th>
        <th width="10%" class="text-center">password</th>
        <th width="80%" class="text-center">Action</th>
    </tr>
    @foreach ($data as $m_user)
    <tr>
        <td>{{ $m_user->user_id }}</td>
        <td>{{ $m_user->level->level_nama }}</td>
        <td>{{ $m_user->username }}</td>
        <td>{{ $m_user->nama }}</td>
        <td>{{ $m_user->password }}</td>
        <td class="text-center">
            <form action="{{ route('user.destroy',$m_user->user_id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('user.show',$m_user->user_id) }}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{route('user.edit',$m_user->user_id) }}">Edit</a>
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
</table>
@endsection