<div class="card-header">Data Penyelidik</div>
<div class="card-body">
    @if(isset($penyidiks) && !empty($penyidiks))
        @foreach($penyidiks as $penyidik)
            <div class="row mb-3">
                <div class="col">
                    <label for="">Nama : </label>
                    <p>{{ $penyidik->name }}</p>
                </div>
                <div class="col">
                    <label for="">NRP : </label>
                    <p>{{ $penyidik->nrp }}</p>
                </div>
                <div class="col">
                    <label for="">Pangkat : </label>
                    <p>{{ $penyidik->pangkat->name }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                <label for="">Jabatan : </label>
                <p>{{ $penyidik->jabatan }}</p>
            </div>
            <div class="col">
                <label for="">Tim : </label>
                <p>{{ $penyidik->tim }}</p>
            </div>
            <div class="col">
                <label for="">Unit : </label>
                <p>{{ $penyidik->unit }}</p>
            </div>
        </div>
        <hr>
        @endforeach
    @else
        <div class="row mb-3 text-center">
            <p>Tidak Ada Data Penyidik</p>
        </div>
    @endif
</div>