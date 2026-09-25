@extends('layouts.app')
@section('content')
<div class="container">
    <h1>lokasi</h1>
    <a href="">Tambah lokasi</a>
    <table class="table table-bordered table-striped">
        <thead> 
            <tr>
                <th>NO</th>
                <th>keterangan</th>
                <th>Aksi</th>
            </tr>   
        </thead>
        <tbody>
            @php 
            $no = 1;
            @endphp
            @foreach ($data as $items)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $items->keterangan }}</td>
                <td>
                  
                </td>
            </tr>     
            @endforeach
        </tbody>
    </table>
    
    {!! $data->links() !!}
</div>
@endsection