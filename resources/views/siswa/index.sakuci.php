@extends ('layouts.app')
@section ('title', config('app.name').'--Kerangka PHP Ringan') 
@section('content')
<div class="container">
   <h1>Daftar Siswa </h1>
   <a href="">
   <table class="table table-bordered table-striped">
   <thead>
      <tr>
        <th>NO</th>
        <th>Name siswaa</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Aksi</th>
     </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($data as $x)
        <tr>
          <tb>{{ $no++}}</td>
          <tb>{{ $×->nama }}</td>
          <tb>{{ $×->nis}}</td>
          <tb>{{ $×->kelas}}</td>
          <tb> 
               </tb>

</tr>
@endforeach
        </tbody>
    </table>
 </div>
      {!! $data->links() !!}       
@endsection 



