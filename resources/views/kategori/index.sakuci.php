@extends('layouts.app')

@section('content')
<div class="container">
    <h1>kategori</h1>
    <table class="table table-bordered table-striped">
        <thead> 
            <tr>
                <th>NO</th>
                <th>nama kategori</th>
                <th>kode katogori</th>
                <th>keterangan</th>
            </tr>   
        </thead>
        <tbody>
            @php 
            $no = 1;
            @endphp
            @foreach ($data as $items)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $items->nama_kategori }}</td>
                <td>{{ $items->kode_kategori }}</td>
                <td>{{ $items->keterangan }}</td>
            </tr>     
            @endforeach
        </tbody>
    </table>
    
    {!! $data->links() !!}
</div>
@endsection