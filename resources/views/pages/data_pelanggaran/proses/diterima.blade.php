<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                {{-- <button type="button" class="btn btn-info">Sebelumnya</button> --}}
            </div>
            <div>

                @if ($kasus->status_id > 1)
                    <button type="button" class="btn btn-primary" onclick="getViewProcess(2)">Selanjutnya <i
                            class="far fa-arrow-right"></i></button>
                @endif

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 13.6%;">
                    </div>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Klarifikasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Gelar Audit Investigasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidik</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Pemberkasan</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>Penuntutan</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidang KEPP</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="div col-12">
            <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span>
                Tambah Terlapor</button>
        </div>
    </div>

    <div class="col-lg-12">
        <form action="/data-kasus/update" method="post">
            @csrf
            <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
            <div class="row">
                <hr>
                <h3>Nota Dinas</h3>
                <hr class="mt-2">
                <div class="col-lg-6 mb-3">
                    <label for="no_nota_dinas" class="form-label">No. Nota Dinas</label>
                    <input type="text" name="no_nota_dinas" class="form-control border-dark"
                        placeholder="No. Nota Dinas" value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Perihal Nota Dinas</label>
                    <input type="text" name="perihal_nota_dinas" class="form-control border-dark"
                        placeholder="Perihal Nota Dinas" value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="wujud_perbuatan" class="form-label">Wujud Perbuatan</label>
                    <select name="id_wujud_perbuatan" id="id_wujud_perbuatan" class="form-control">
                        @if (isset($wujud_perbuatan))
                            @foreach ($wujud_perbuatan as $key => $wujud)
                                <option value="{{ $wujud->id }}"
                                    {{ isset($kasus) ? ($kasus->id_wujud_perbuatan == $wujud->id ? 'selected' : '') : '' }}>
                                    {{ $wujud->keterangan_wp }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="tanggal_nota_dinas" class="form-label">Tanggal Nota Dinas</label>
                    <input type="text" name="tanggal_nota_dinas" class="form-control border-dark"
                        placeholder="Tanggal Nota Dinas" value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}">
                </div>
            </div>
            <div class="row">
                <hr>
                <h3>Pelapor</h3>
                <hr class="mt-2">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="pelapor" class="form-label">Pelapor</label>
                            <input type="text" name="pelapor" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->pelapor : '' }}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" name="umur" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->umur : '' }}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">-- Jenis Kelamin --</option>
                                @if (isset($jenis_kelamin))
                                    @foreach ($jenis_kelamin as $key => $jk)
                                        <option value="{{ $jk->id }}"
                                            {{ $kasus->jenis_identitas == $jk->id ? 'selected' : '' }}>
                                            {{ $jk->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="no_telp" class="form-label">No. Telephone</label>
                            <input type="text" name="no_telp" class="form-control border-dark"
                                placeholder="No. Telephone" value="{{ isset($kasus) ? $kasus->no_telp : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->pekerjaan : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            {{-- <input type="text" name="agama" class="form-control" value="{{ isset($kasus) ? ($kasus->agama == 0 ? 'Islam' : 'Kristen') : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="agama" id="agama">
                                <option value="">-- Agama --</option>
                                @if (isset($agama))
                                    @foreach ($agama as $key => $ag)
                                        <option value="{{ $ag->id }}"
                                            {{ $kasus->agama == $ag->id ? 'selected' : '' }}>{{ $ag->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="no_identitas" class="form-label">No Identitas</label>
                            <input type="text" name="no_identitas" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->no_identitas : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="jenis_identitas" class="form-label">Jenis Identitas</label>
                            {{-- <input type="text" name="jenis_identitas" class="form-control" value="{{ isset($kasus) ? $kasus->jenis_identitas : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="jenis_identitas" id="jenis_identitas">
                                <option value="">-- Jenis Identitas --</option>
                                @if (isset($jenis_identitas))
                                    @foreach ($jenis_identitas as $key => $ji)
                                        <option value="{{ $ji->id }}"
                                            {{ $kasus->jenis_identitas == $ji->id ? 'selected' : '' }}>
                                            {{ $ji->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" cols="30" rows="7" placeholder="Alamat" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->alamat : '' }}">{{ isset($kasus) ? $kasus->alamat : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                <h3>Terlapor</h3>
                <hr class="mt-2">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="terlapor" class="form-label">Terlapor</label>
                            <input type="text" name="terlapor" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->terlapor : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tempat" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir"
                                class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->tempat_lahir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                placeholder="Tanggal Lahir" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->tanggal_lahir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="No. Handphone"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->no_hp : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir"
                                placeholder="Pendidikan Terakhir" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->pendidikan_terakhir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <select name="id_pangkat" id="id_pangkat" class="form-control">
                                @if (isset($pangkat))
                                    @foreach ($pangkat as $key => $pangkt)
                                        <option value="{{ $pangkt->id }}"
                                            {{ isset($kasus) ? ($kasus->id_pangkat == $pangkt->id ? 'selected' : '') : '' }}>
                                            {{ $pangkt->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="nrp" class="form-label">NRP</label>
                            <input type="text" name="nrp" placeholder="NRP Terlapor"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->nrp : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="suku" class="form-label">Suku</label>
                            <input type="text" name="suku" placeholder="Suku Terlapor"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->suku : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            {{-- <input type="text" name="agama_terlapor" class="form-control" value="{{ isset($kasus) ? ($kasus->agama_terlapor == 0 ? 'Islam' : 'Kristen') : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="agama_terlapor" id="agama-terlapor">
                                <option value="">-- Agama --</option>
                                @if (isset($agama))
                                    @foreach ($agama as $key => $ag)
                                        <option value="{{ $ag->id }}"
                                            {{ $kasus->agama == $ag->id ? 'selected' : '' }}>{{ $ag->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" placeholder="Jabatan Terlapor"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jabatan : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kesatuan" class="form-label">Kesatuan</label>
                            <input type="text" name="kesatuan" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->kesatuan : '' }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat_terlapor" id="alamat_terlapor" cols="30" rows="4" placeholder="Alamat"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->alamat_terlapor : '' }}">{{ isset($kasus) ? $kasus->alamat_terlapor : '' }}</textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                            <textarea name="alamat_tempat_tinggal" id="alamat_tempat_tinggal" cols="30" rows="4"
                                placeholder="Alamat" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->alamat_tempat_tinggal : '' }}">{{ isset($kasus) ? $kasus->alamat_tempat_tinggal : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                <h3>Kronologis</h3>
                <hr class="mt-2">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="tempat_kejadian" class="form-label">Tempat Kejadian</label>
                            <input type="text" name="tempat_kejadian" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->tempat_kejadian : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
                            <input type="text" name="tanggal_kejadian" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->tanggal_kejadian : '' }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="nama_korban" class="form-label">Nama Korban</label>
                            <input type="text" name="nama_korban" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->nama_korban : '' }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kronologis</label>
                            <textarea name="kronologis" cols="30" rows="7" placeholder="Kronologis" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->kronologi : '' }}">{{ isset($kasus) ? $kasus->kronologi : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-2">
                        <div class="col-lg-12 mb-3">
                            @if (isset($disposisi->no_agenda))
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="" class="form-label">Nomor Agenda</label>
                                        <p>{{ $disposisi->no_agenda }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-2">
                        <div class="col-lg-12 mb-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Disposisi Karo</label>
                                    @if ($disposisi_karo)
                                        <a href="/lembar-disposisi-karo/{{ $kasus->id }}">
                                            <button class="btn btn-primary" style="width: 100%" type="button">
                                                <i class="far fa-download"></i> Download
                                            </button></a>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#modal_disposisi_karo"
                                            type="button" class="btn btn-outline-primary" style="width: 100%">
                                            <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Disposisi Sesro</label>
                                    @if ($disposisi_sesro)
                                        <a href="/lembar-disposisi-sesro/{{ $kasus->id }}">
                                            <button class="btn btn-primary" style="width: 100%" type="button">
                                                <i class="far fa-download"></i> Download
                                            </button></a>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#modal_disposisi_sesro"
                                            type="button" class="btn btn-outline-primary" style="width: 100%">
                                            <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Disposisi
                                        Kabagetika </label>
                                    @if ($disposisi_kabag)
                                        <a href="/lembar-disposisi-kabag/{{ $kasus->id }}">
                                            <button class="btn btn-primary" style="width: 100%" type="button">
                                                <i class="far fa-download"></i> Download
                                            </button></a>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#modal_disposisi"
                                            type="button" class="btn btn-outline-primary" style="width: 100%">
                                            <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                        </button>
                                    @endif

                                </div>

                            </div>

                            {{-- <input type="text" class="form-control" value="{{ $kasus->terlapor }}" > --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-update-diterima col-12 btn-success" type="submit"
                                value="update_data" name="type_submit">
                                <i class="far fa-upload"></i> Update Data
                            </button>
                        </div>
                        <div class="col-6">
                            @if ($disposisi_kabag && $disposisi_karo && $disposisi_sesro)
                                <form action="/data-kasus/update" method="post">
                                    @csrf
                                    <input type="text" class="form-control" value="{{ $kasus->id }}" hidden
                                        name="kasus_id">
                                    <input type="text" class="form-control" value="2" hidden
                                        name="disposisi_tujuan" hidden>
                                    <button class="btn btn-success col-12" name="type_submit"
                                        {{ $kasus->status_id > 4 ? 'disabled' : '' }} value="update_status">
                                        Lanjutkan Timeline Klasifikasi
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-success col-12 disabled">
                                    Lanjutkan Timeline Klasifikasi
                                </button>
                            @endif
                            {{-- <button class="btn btn-update-diterima btn-primary" type="submit" value="update_status"
                                    name="type_submit" {{ $kasus->status_id > 1 ? 'disabled' : '' }}>
                                    <i class="far fa-upload"></i> Lanjut Proses Audit Investigasi
                                </button> --}}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_disposisi" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Disposisi</h5>
                <button type="button" class="btn-close btn-tutup" form="form-disposisi-kabag"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/lembar-disposisi-kabag" method="post" id="form-disposisi-kabag">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Agenda :</label>
                        <input type="text" class="form-control" id="no_agenda" aria-describedby="emailHelp"
                            name="no_agenda" placeholder="Nomor Agenda">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Surat dari :</label>
                        <?php
                        if (isset($kasus->no_nota_dinas)) {
                            $surat_dari = explode('/', $kasus->no_nota_dinas);
                            $surat_dari = end($surat_dari);
                        }
                        ?>
                        <input type="text" class="form-control" id="surat_dari" aria-describedby="emailHelp"
                            name="surat_dari" placeholder="Surat dari"
                            value="{{ isset($surat_dari) ? $surat_dari : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                            value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}" placeholder="Nomor Surat"
                            readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                            value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Klasifikasi</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Sangat Rahasia">Sangat Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Derajat</label>
                        <select name="derajat" id="derajat" class="form-control">
                            <option value="">Pilih Derajat</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Kilat">Kilat</option>
                            <option value="Rahasia">Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tim</label>
                        <select name="tim" id="tim" class="form-control">
                            <option value="">Pilih Tim</option>
                            @for ($i = 0; $i < count($tims); $i++)
                                <option value="{{ $tims[$i] }}">{{ $tims[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal"
                            value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" readonly="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  btn-tutup" form="form-disposisi-kabag"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_disposisi_karo" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Disposisi</h5>
                <button type="button" class="btn-close btn-tutup" form="form-disposisi-karo"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/lembar-disposisi-karo" method="post" id="form-disposisi-karo">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Agenda :</label>
                        <input type="text" class="form-control" id="no_agenda" aria-describedby="emailHelp"
                            name="no_agenda" placeholder="Nomor Agenda">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Surat dari :</label>
                        <?php
                        if (isset($kasus->no_nota_dinas)) {
                            $surat_dari = explode('/', $kasus->no_nota_dinas);
                            $surat_dari = end($surat_dari);
                        }
                        ?>
                        <input type="text" class="form-control" id="surat_dari" aria-describedby="emailHelp"
                            name="surat_dari" placeholder="Surat dari"
                            value="{{ isset($surat_dari) ? $surat_dari : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                            value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}" placeholder="Nomor Surat"
                            readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                            value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Klasifikasi</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Sangat Rahasia">Sangat Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Derajat</label>
                        <select name="derajat" id="derajat" class="form-control">
                            <option value="">Pilih Derajat</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Kilat">Kilat</option>
                            <option value="Rahasia">Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal"
                            value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" readonly="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  btn-tutup" form="form-disposisi-auditor"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_disposisi_sesro"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Disposisi</h5>
                <button type="button" class="btn-close btn-tutup" form="form-disposisi-sesro"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/lembar-disposisi-sesro" method="post" id="form-disposisi-sesro">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Agenda :</label>
                        <input type="text" class="form-control" id="no_agenda" aria-describedby="emailHelp"
                            name="no_agenda" placeholder="Nomor Agenda">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Surat dari :</label>
                        <?php
                        if (isset($kasus->no_nota_dinas)) {
                            $surat_dari = explode('/', $kasus->no_nota_dinas);
                            $surat_dari = end($surat_dari);
                        }
                        ?>
                        <input type="text" class="form-control" id="surat_dari" aria-describedby="emailHelp"
                            name="surat_dari" placeholder="Surat dari"
                            value="{{ isset($surat_dari) ? $surat_dari : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                            value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}" placeholder="Nomor Surat"
                            readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                            value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Klasifikasi</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Sangat Rahasia">Sangat Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Derajat</label>
                        <select name="derajat" id="derajat" class="form-control">
                            <option value="">Pilih Derajat</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Kilat">Kilat</option>
                            <option value="Rahasia">Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal"
                            value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" readonly="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  btn-tutup" form="form-disposisi-sesro"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btn-terlapor').on('click', function() {
            $('#modal_terlapor').modal('show');
        })
        $('#form-disposisi-kabag').validate({
            rules: {
                no_agenda: {
                    required: true,
                },
                tanggal: {
                    required: true,
                },
                nomor_surat: {
                    required: true,
                },
                surat_dari: {
                    required: true,
                },
                klasifikasi: {
                    required: true,
                },
                derajat: {
                    required: true,
                },
                tim: {
                    required: true,
                },
            },
            messages: {
                no_agenda: "Silahkan isi nomor agenda!",
                tanggal: "Silahkan isi tanggal!",
                nomor_surat: "Silahkan isi nomor surat!",
                surat_dari: "Silahkan isi surat dari!",
                klasifikasi: "Silahkan pilih klasifikasi!",
                derajat: "Silahkan pilih derajat!",
                tim: "Silahkan pilih tim!",
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                label.remove();
            },
            submitHandler: function(form) { // for demo
                form.submit();
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                var id = $('#status_id').val();
                $('#modal_disposisi').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/data-kasus/view/${kasus_id}/${id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });

        $('#form-disposisi-karo').validate({
            rules: {
                no_agenda: {
                    required: true,
                },
                klasifikasi: {
                    required: true,
                },
                derajat: {
                    required: true,
                },
            },
            messages: {
                no_agenda: "Silahkan isi Nomor Agenda!",
                klasifikasi: "Silahkan isi Klasifikasi!",
                derajat: "Silahkan isi Derajat!"
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                label.remove();
            },
            submitHandler: function(form) { // for demo
                form.submit();
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                var id = $('#status_id').val();
                $('#modal_disposisi_karo').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/data-kasus/view/${kasus_id}/${id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });

        $('#form-disposisi-sesro').validate({
            rules: {
                no_agenda: {
                    required: true,
                },
                klasifikasi: {
                    required: true,
                },
                derajat: {
                    required: true,
                },
            },
            messages: {
                no_agenda: "Silahkan isi Nomor Agenda!",
                klasifikasi: "Silahkan isi Klasifikasi!",
                derajat: "Silahkan isi Derajat!"
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                label.remove();
            },
            submitHandler: function(form) { // for demo
                form.submit();
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                var id = $('#status_id').val();
                $('#modal_disposisi_sesro').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/data-kasus/view/${kasus_id}/${id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });

        $('select').select2({
            theme: 'bootstrap-5'
        });
        getPolda()
    });

    function getPolda() {
        let disposisi = $('#disposisi-tujuan').val()
        if (disposisi == '3') {
            $.ajax({
                url: "/api/all-polda",
                method: "get"
            }).done(function(data) {
                $("#limpah-polda").html(data)
            });
        } else $("#limpah-polda").html("")
    }

    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
        $('#no_agenda').val('');
        $('#klasifikasi').val('');
        $('#derajat').val('');
        $('#tim').val('');
    })
</script>
