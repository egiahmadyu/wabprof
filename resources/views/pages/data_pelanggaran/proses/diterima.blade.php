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
                    <p>Riksa</p>
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

    @if ($kasus->status_dihentikan == 0)
        <div class="row mb-4">
            <div class="div col-12">
                <button type="button" class="btn btn-primary col-12 btn-terlapor"><span
                        class="far fa-plus-square"></span>
                    Tambah Terlapor</button>
            </div>
        </div>
    @endif

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
                        placeholder="No. Nota Dinas" value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}" required>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Perihal Nota Dinas</label>
                    <input type="text" name="perihal_nota_dinas" class="form-control border-dark"
                        placeholder="Perihal Nota Dinas" value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}"
                        required>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="wujud_perbuatan" class="form-label">Wujud Perbuatan</label>
                    <select name="id_wujud_perbuatan" id="id_wujud_perbuatan" class="form-control" required>
                        @if (isset($wujud_perbuatan))
                            <option value="">Pilih</option>
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
                    <input type="date" id="tanggal_nota_dinas" name="tanggal_nota_dinas"
                        class="form-control border-dark datepicker" data-select="datepicker"
                        value="{{ $kasus->tanggal_nota_dinas }}" required>
                </div>
            </div>
            <div class="row">
                <hr>
                <h3>Pelapor</h3>
                <hr class="mt-2">
                <div class="col-lg-12">
                    <div class="row">
                        @if ($kasus->id_card)
                            <div class="col-lg-6 mb-3">
                                <div class="card">
                                    <img src="{{ $kasus->id_card }}" class="card-img-top" alt="..."
                                        height="400">
                                    <div class="card-body">
                                        <h5 class="card-title">Poto KTP</h5>
                                        <a href="{{ $kasus->id_card }}" class="btn btn-primary btn-sm"
                                            target="_blank">Buka Gambar</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($kasus->selfie)
                            <div class="col-lg-6 mb-3">
                                <div class="card">
                                    <img src="{{ $kasus->selfie }}" class="card-img-top" alt="..."
                                        height="400">
                                    <div class="card-body">
                                        <h5 class="card-title">Poto Selfie</h5>
                                        <a href="{{ $kasus->selfie }}" class="btn btn-primary btn-sm"
                                            target="_blank">Buka Gambar</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 mb-3">
                            <label for="pelapor" class="form-label">Pelapor</label>
                            <input type="text" name="pelapor" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->pelapor : '' }}" required>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" name="umur" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->umur : '' }}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="jenis_kelamin" id="jenis_kelamin" required>
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
                                name="agama" id="agama" required>
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
                        <div class="col-lg-6 mb-3">
                            <label for="terlapor" class="form-label">Terlapor</label>
                            <input type="text" name="terlapor" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->terlapor : '' }}" required>
                        </div>
                        {{-- <div class="col-lg-6 mb-3">
                            <label for="tempat" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir"
                                class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->tempat_lahir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" data-select="datepicker"
                                placeholder="Tanggal Lahir" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->tanggal_lahir : '' }}">
                        </div> --}}
                        <div class="col-lg-6 mb-3">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="No. Handphone"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->no_hp : '' }}">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <select name="id_pangkat" id="id_pangkat" class="form-control" required>
                                @if (isset($pangkat))
                                    <option value="">Pilih Pangkat</option>
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
                            <input type="text" name="nrp" placeholder="NRP Terlapor" id="nrp"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->nrp : '' }}"
                                required maxlength="8">
                        </div>
                        {{-- <div class="col-lg-6 mb-3">
                            <label for="suku" class="form-label">Suku</label>
                            <input type="text" name="suku" placeholder="Suku Terlapor"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->suku : '' }}">
                        </div> --}}

                        <div class="col-lg-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" placeholder="Jabatan Terlapor"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jabatan : '' }}"
                                required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kesatuan" class="form-label">Kesatuan</label>
                            <input type="text" name="kesatuan" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->kesatuan : '' }}" required>
                        </div>
                        {{-- <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat_terlapor" id="alamat_terlapor" cols="30" rows="4" placeholder="Alamat"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->alamat_terlapor : '' }}">{{ isset($kasus) ? $kasus->alamat_terlapor : '' }}</textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                            <textarea name="alamat_tempat_tinggal" id="alamat_tempat_tinggal" cols="30" rows="4"
                                placeholder="Alamat" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->alamat_tempat_tinggal : '' }}">{{ isset($kasus) ? $kasus->alamat_tempat_tinggal : '' }}</textarea>
                        </div> --}}
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
                            <input type="date" name="tanggal_kejadian" class="form-control border-dark"
                                id="tanggal_kejadian"
                                value="{{ isset($kasus) && $kasus->tanggal_kejadian ? $kasus->tanggal_kejadian : '' }}">
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
                        @if (count($kasus->evidences) > 0)
                            <div class="col-lg-12">
                                <button class="btn btn-primary" style="width: 100%" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modal_bukti">
                                    <i class="far fa-image"></i> Lihat Evidences / Bukti
                                </button>
                                <div class="modal fade" id="modal_bukti" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Bukti / Evidences</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @foreach ($kasus->evidences as $value)
                                                        <?php
                                                        $cek = explode('.', $value->file_path);
                                                        ?>
                                                        <div class="col-lg-6 mb-3">
                                                            <div class="card">
                                                                @if (end($cek) == 'pdf')
                                                                    <div class="embed-responsive">
                                                                        <iframe class="embed-responsive-item"
                                                                            height="200"
                                                                            src="{{ $value->file_path }}"
                                                                            allowfullscreen></iframe>
                                                                    </div>
                                                                @else
                                                                    <img src="{{ $value->file_path }}" alt=""
                                                                        height="200">
                                                                @endif

                                                                <div class="card-body">
                                                                    <a href="{{ $value->file_path }}"
                                                                        class="btn btn-primary btn-sm"
                                                                        target="_blank">Buka
                                                                        File</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($kasus->fakta_fakta)
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <label for="inputCity" class="form-label">Fakta - Fakta</label>
                        @php
                            $fakta = json_decode($kasus->fakta_fakta);
                        @endphp
                        @for ($i = 0; $i < count($fakta); $i++)
                            <li>{{ $fakta[$i] }}</li>
                        @endfor

                    </div>
                </div>
            @endif

            @if ($kasus->pendapat_pelapor)
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <label for="inputCity" class="form-label">Pendapat Pelapor</label>
                        @php
                            $pendapat_pelapor = json_decode($kasus->pendapat_pelapor);
                        @endphp
                        @for ($i = 0; $i < count($pendapat_pelapor); $i++)
                            <li>{{ $pendapat_pelapor[$i] }}</li>
                        @endfor

                    </div>
                </div>
            @endif

            @if ($kasus->catatan)
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <label for="inputCity" class="form-label">Catatan</label>
                        @php
                            $catatan = json_decode($kasus->catatan);
                        @endphp
                        @for ($i = 0; $i < count($catatan); $i++)
                            <li>{{ $catatan[$i] }}</li>
                        @endfor

                    </div>
                </div>
            @endif
            @if (isset($disposisi->no_agenda))
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
            @endif

            <div class="row mb-4">
                <div class="col-lg-12">
                    <button class="btn btn-update-diterima col-12 btn-success" type="submit" value="update_data"
                        name="type_submit" {{ auth()->user()->hasRole(['akreditor', 'admin'])? '': 'disabled' }}>
                        <i class="far fa-upload"></i> Update Data
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-2">
                        <div class="col-lg-12 mb-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Disposisi Karo
                                        @if ($disposisi_karo)
                                            <a href="/lembar-disposisi-karo/{{ $kasus->id }}">Lihat Dokumen</a>
                                        @endif
                                    </label>
                                    @if (auth()->user()->hasRole(['urtu', 'admin']))
                                        @if ($disposisi_karo)
                                            {{-- <a href="/lembar-disposisi-karo/{{ $kasus->id }}" target="_blank">
                                                <button class="btn btn-primary" style="width: 100%" type="button">
                                                    <i class="far fa-download"></i> Download
                                                </button></a> --}}

                                            <button data-bs-toggle="modal" data-bs-target="#modal_disposisi_karo"
                                                type="button" class="btn btn-primary" style="width: 100%">
                                                <i class="far fa-file-plus"></i> Update Disposisi</h6>
                                            </button>
                                        @else
                                            <button data-bs-toggle="modal" data-bs-target="#modal_disposisi_karo"
                                                type="button" class="btn btn-outline-primary" style="width: 100%">
                                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Update Disposisi
                                                </h6>
                                            </button>
                                        @endif
                                    @else
                                        @if (!$disposisi_karo)
                                            {{-- <a href="/lembar-disposisi-karo/{{ $kasus->id }}" target="_blank">
                                                <button class="btn btn-primary" style="width: 100%" type="button">
                                                    <i class="far fa-download"></i> Download
                                                </button></a>
                                                <br> --}}
                                            <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                                dilakukan oleh Urtu</h6>
                                        @else
                                            <br>
                                            <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                                dilakukan oleh Urtu</h6>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Disposisi Sesro
                                        @if ($disposisi_sesro)
                                            <a href="/lembar-disposisi-sesro/{{ $kasus->id }}" target="_blank">
                                                Lihat Dokumen
                                            </a>
                                        @endif
                                    </label>
                                    @if (auth()->user()->hasRole(['urtu', 'admin']))
                                        @if ($disposisi_sesro)
                                            {{-- <a href="/lembar-disposisi-sesro/{{ $kasus->id }}" target="_blank">
                                                <button class="btn btn-primary" style="width: 100%" type="button">
                                                    <i class="far fa-download"></i> Download Disposisi
                                                </button></a> --}}
                                            <button data-bs-toggle="modal" data-bs-target="#modal_disposisi_sesro"
                                                type="button" class="btn btn-primary" style="width: 100%">
                                                <i class="far fa-file-plus"></i> Update Disposisi</h6>
                                            @else
                                                <button data-bs-toggle="modal" data-bs-target="#modal_disposisi_sesro"
                                                    type="button" class="btn btn-outline-primary"
                                                    style="width: 100%">
                                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen
                                                    </h6>
                                                </button>
                                        @endif
                                    @else
                                        @if (!$disposisi_sesro)
                                            <br>
                                            <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                                dilakukan oleh Urtu</h6>
                                            <a href="/lembar-disposisi-sesro/{{ $kasus->id }}" target="_blank">
                                                <button class="btn btn-primary" style="width: 100%" type="button">
                                                    <i class="far fa-download"></i> Download Disposisi
                                                </button></a>
                                        @else
                                            <br>
                                            <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                                dilakukan oleh Urtu</h6>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Disposisi
                                        Kabagetika
                                        @if ($disposisi_kabag)
                                            <a href="/lembar-disposisi-kabag/{{ $kasus->id }}" target="_blank">
                                                Lihat Dokumen
                                            </a>
                                        @endif
                                    </label>
                                    @if (auth()->user()->hasRole(['urmin', 'admin']))
                                        @if ($disposisi_kabag)
                                            <button data-bs-toggle="modal" data-bs-target="#modal_disposisi"
                                                type="button" class="btn btn-primary" style="width: 100%">
                                                <i class="far fa-file-plus"></i> Update Disposisi</h6>
                                            </button>
                                        @else
                                            <button data-bs-toggle="modal" data-bs-target="#modal_disposisi"
                                                type="button" class="btn btn-outline-primary" style="width: 100%"
                                                {{ $disposisi_karo || $disposisi_sesro ? '' : 'disabled' }}>
                                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                            </button>
                                        @endif
                                    @else
                                        @if (!$disposisi_kabag)
                                            <br>
                                            <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                                dilakukan oleh Urmin</h6>
                                            {{-- <a href="/lembar-disposisi-kabag/{{ $kasus->id }}" target="_blank">
                                                <button class="btn btn-primary" style="width: 100%" type="button">
                                                    <i class="far fa-download"></i> Download
                                                </button></a> --}}
                                        @else
                                            <br>
                                            <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                                dilakukan oleh Urmin</h6>
                                        @endif
                                    @endif


                                </div>

                            </div>

                            {{-- <input type="text" class="form-control" value="{{ $kasus->terlapor }}" > --}}
                        </div>
                    </div>
                </div>
            </div>
            <h3>Harap Lengkapi Data Sebelum Melanjutkan ke Proses Selanjutnya</h3>
            @if ($kasus->status_dihentikan == 0)
                <div class="row">
                    <div class="col-lg-12">
                        @if ($disposisi_kabag && ($disposisi_karo || $disposisi_sesro) && $kasus->status_id == 1)
                            @if (auth()->user()->hasRole(['akreditor', 'admin']))
                                <input type="text" name="disposisi_tujuan" value="2" hidden>
                                <button class="btn btn-success col-12" name="type_submit" type="submit"
                                    {{ $kasus->status_id > 4 ? 'disabled' : '' }} value="update_status">
                                    Lanjutkan Klarifikasi
                                </button>
                            @else
                                <br>
                                <h6 class="badge rounded-pill bg-warning text-dark">Disposisi Ini bisa
                                    dilakukan oleh Akreditor</h6>
                            @endif
                            {{-- <form action="/data-kasus/update" method="post">
                                @csrf
                                <input type="text" class="form-control" value="{{ $kasus->id }}" hidden
                                    name="kasus_id">
                                <input type="text" class="form-control" value="2" hidden
                                    name="disposisi_tujuan" hidden>
                                <button class="btn btn-success col-12" name="type_submit"
                                    {{ $kasus->status_id > 4 ? 'disabled' : '' }} value="update_status">
                                    Lanjutkan Klarifikasi
                                </button>
                            </form> --}}
                        @else
                            <button class="btn btn-success col-12 disabled">
                                Lanjutkan Klarifikasi
                            </button>
                        @endif
                        {{-- <button class="btn btn-update-diterima btn-primary" type="submit" value="update_status"
                        name="type_submit" {{ $kasus->status_id > 1 ? 'disabled' : '' }}>
                        <i class="far fa-upload"></i> Lanjut Proses Audit Investigasi
                    </button> --}}
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-update-diterima col-12 btn-success" type="submit"
                                    value="update_data" name="type_submit">
                                    <i class="far fa-upload"></i> Update Data
                                </button>
                            </div>

                        </div>
                    </div>
                </div> --}}
            @endif
    </div>
    </form>
</div>
</div>
@if ($disposisi_karo || $disposisi_sesro)
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_disposisi" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Disposisi</h5>
                    <button type="button" class="btn-close btn-tutup" form="form-disposisi-kabag"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/lembar-disposisi-kabag" method="post" id="form-disposisi-kabag"
                    enctype="multipart/form-data">
                    <input type="text" class="form-control" value="{{ $kasus->id }}"
                        aria-describedby="emailHelp" name="data_pelanggar_id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor Agenda :</label>
                            <input type="text" class="form-control" id="no_agenda" aria-describedby="emailHelp"
                                name="no_agenda" placeholder="Nomor Agenda"
                                value="{{ $disposisi_kabag ? $disposisi_kabag->no_agenda : '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal Disposisi
                            </label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                                value="{{ $disposisi_kabag ? date('Y-m-d', strtotime($disposisi_kabag->tanggal_surat)) : '' }}">
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
                        {{-- <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                                value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" readonly="">
                        </div> --}}
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Klasifikasi</label>
                            <select name="klasifikasi" id="klasifikasi" class="form-control">
                                <option value="">Pilih Klasifikasi</option>
                                <option value="Biasa"
                                    {{ isset($disposisi_kabag) ? ($disposisi_kabag->klasifikasi == 'Biasa' ? 'selected' : '') : '' }}>
                                    Biasa</option>
                                <option value="Sangat Rahasia"
                                    {{ isset($disposisi_kabag) ? ($disposisi_kabag->klasifikasi == 'Sangat Rahasia' ? 'selected' : '') : '' }}>
                                    Sangat
                                    Rahasia
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Derajat</label>
                            <select name="derajat" id="derajat" class="form-control">
                                <option value="">Pilih Derajat</option>
                                <option value="Biasa"
                                    {{ isset($disposisi_kabag) ? ($disposisi_kabag->derajat == 'Biasa' ? 'selected' : '') : '' }}>
                                    Biasa
                                </option>
                                <option value="Kilat"
                                    {{ isset($disposisi_kabag) ? ($disposisi_kabag->derajat == 'Kilat' ? 'selected' : '') : '' }}>
                                    Kilat
                                </option>
                                <option value="Rahasia"
                                    {{ isset($disposisi_kabag) ? ($disposisi_kabag->derajat == 'Rahasia' ? 'selected' : '') : '' }}>
                                    Rahasia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tim</label>
                            <select name="tim" id="tim" class="form-control">
                                <option value="">Pilih Tim</option>
                                @for ($i = 0; $i < count($tims); $i++)
                                    <option value="{{ $tims[$i] }}"
                                        {{ isset($disposisi_kabag) ? ($disposisi_kabag->tim == $tims[$i] ? 'selected' : '') : '' }}>
                                        {{ $tims[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Perihal</label>
                            <input type="text" class="form-control" id="perihal" name="perihal"
                                value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" readonly="">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Dokumen Disposisi</label>
                            <input class="form-control" type="file" accept=".pdf, .png" id="formFile"
                                name="filepond" {{ $disposisi_kabag ? '' : 'required' }}>
                            @if ($disposisi_kabag)
                                <a href="/lembar-disposisi-kabag/{{ $kasus->id }}" target="_blank">
                                    <p>Dokumen Sekarang </p>
                                </a>
                            @endif
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
@endif

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_disposisi_karo" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Disposisi Karo</h5>
                <button type="button" class="btn-close btn-tutup" form="form-disposisi-karo"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/lembar-disposisi-karo" method="post" id="form-disposisi-karo"
                enctype="multipart/form-data">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Agenda :</label>
                        <input type="text" class="form-control" id="no_agenda" aria-describedby="emailHelp"
                            name="no_agenda" placeholder="Nomor Agenda"
                            value="{{ $disposisi_karo ? $disposisi_karo->no_agenda : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Disposisi
                        </label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                            value="{{ $disposisi_karo ? date('Y-m-d', strtotime($disposisi_karo->tanggal_surat)) : '' }}">
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
                    {{-- <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Disposisi</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                            value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" readonly="">
                    </div> --}}
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Klasifikasi</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Biasa"
                                {{ isset($disposisi_karo) ? ($disposisi_karo->klasifikasi == 'Biasa' ? 'selected' : '') : '' }}>
                                Biasa</option>
                            <option value="Sangat Rahasia"
                                {{ isset($disposisi_karo) ? ($disposisi_karo->klasifikasi == 'Sangat Rahasia' ? 'selected' : '') : '' }}>
                                Sangat Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Derajat</label>
                        <select name="derajat" id="derajat" class="form-control">
                            <option value="">Pilih Derajat</option>
                            <option value="Biasa"
                                {{ isset($disposisi_karo) ? ($disposisi_karo->derajat == 'Biasa' ? 'selected' : '') : '' }}>
                                Biasa</option>
                            <option value="Kilat"
                                {{ isset($disposisi_karo) ? ($disposisi_karo->derajat == 'Kilat' ? 'selected' : '') : '' }}>
                                Kilat</option>
                            <option value="Rahasia"
                                {{ isset($disposisi_karo) ? ($disposisi_karo->derajat == 'Rahasia' ? 'selected' : '') : '' }}>
                                Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal"
                            value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Dokumen Disposisi</label>
                        <input class="form-control" type="file" accept=".pdf, .png" id="formFile"
                            name="filepond" {{ $disposisi_karo ? '' : 'required' }}>
                        @if ($disposisi_karo)
                            <a href="/lembar-disposisi-karo/{{ $kasus->id }}" target="_blank">
                                <p>Dokumen Sekarang </p>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  btn-tutup" form="form-disposisi-auditor"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Disposisi Sesro</h5>
                <button type="button" class="btn-close btn-tutup" form="form-disposisi-sesro"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/lembar-disposisi-sesro" method="post" id="form-disposisi-sesro"
                enctype="multipart/form-data">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Agenda :</label>
                        <input type="text" class="form-control" id="no_agenda" aria-describedby="emailHelp"
                            name="no_agenda" placeholder="Nomor Agenda"
                            value="{{ $disposisi_sesro ? $disposisi_sesro->no_agenda : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Disposisi
                        </label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                            value="{{ $disposisi_sesro ? date('Y-m-d', strtotime($disposisi_sesro->tanggal_surat)) : '' }}">
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
                    {{-- <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal_surat"
                                value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" readonly="">
                        </div> --}}
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Klasifikasi</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Biasa"
                                {{ $disposisi_sesro ? ($disposisi_sesro->klasifikasi == 'Biasa' ? 'selected' : '') : '' }}>
                                Biasa</option>
                            <option value="Sangat Rahasia"
                                {{ $disposisi_sesro ? ($disposisi_sesro->klasifikasi == 'Sangat Rahasia' ? 'selected' : '') : '' }}>
                                Sangat
                                Rahasia
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Derajat</label>
                        <select name="derajat" id="derajat" class="form-control">
                            <option value="">Pilih Derajat</option>
                            <option value="Biasa"
                                {{ $disposisi_sesro ? ($disposisi_sesro->derajat == 'Biasa' ? 'selected' : '') : '' }}>
                                Biasa
                            </option>
                            <option value="Kilat"
                                {{ $disposisi_sesro ? ($disposisi_sesro->derajat == 'Kilat' ? 'selected' : '') : '' }}>
                                Kilat
                            </option>
                            <option value="Rahasia"
                                {{ $disposisi_sesro ? ($disposisi_sesro->derajat == 'Rahasia' ? 'selected' : '') : '' }}>
                                Rahasia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal"
                            value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" readonly="">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Dokumen Disposisi</label>
                        <input class="form-control" type="file" accept=".pdf, .png" id="formFile"
                            name="filepond" {{ $disposisi_sesro ? '' : 'required' }}>
                        @if ($disposisi_sesro)
                            <a href="/lembar-disposisi-sesro/{{ $kasus->id }}" target="_blank">
                                <p>Dokumen Sekarang </p>
                            </a>
                        @endif
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

        $('#nrp').keyup(function() {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });

        $("#tanggal_nota_dinas").pDatePicker({
            lang: "id",
            selected: new Date(<?= date('Y', strtotime($kasus->tanggal_nota_dinas)) ?>,
                <?= date('m', strtotime($kasus->tanggal_nota_dinas)) ?> - 1,
                <?= date('d', strtotime($kasus->tanggal_nota_dinas)) ?>)
        });

        $("#tanggal_lahir").pDatePicker({
            lang: "id",
            selected: new Date(<?= date('Y', strtotime($kasus->tanggal_lahir)) ?>,
                <?= date('m', strtotime($kasus->tanggal_lahir)) ?> - 1,
                <?= date('d', strtotime($kasus->tanggal_lahir)) ?>)
        });
        @if ($kasus->tanggal_kejadian)
            $("#tanggal_kejadian").pDatePicker({
                lang: "id",
                selected: new Date(<?= date('Y', strtotime($kasus->tanggal_kejadian)) ?>,
                    <?= date('m', strtotime($kasus->tanggal_kejadian)) ?> - 1,
                    <?= date('d', strtotime($kasus->tanggal_kejadian)) ?>)
            });
        @else
            $("#tanggal_kejadian").pDatePicker({
                lang: "id",
            });
        @endif

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

                var body = new FormData(form);
                $.ajax({
                    url: '/lembar-disposisi-kabag',
                    beforeSend: function() {
                        $('.loader-view').show();
                    },
                    type: 'post',
                    data: body,
                    processData: false,
                    contentType: false,
                    success: function(data, status, xhr) {
                        $('#modal_disposisi').modal('hide');
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Update Disposisi Berhasil'
                            })
                        } else {
                            // $('.loader-view').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message
                            })

                        }
                        var kasus_id = $('#kasus_id').val();
                        var id = $('#status_id').val();

                        // $('.loader-view').hide();
                        $.ajax({
                            type: 'get',
                            url: `/data-kasus/view/${kasus_id}/${id}`,
                            success: function(data) {
                                $('#viewProses').html(data);
                                $('.loader-view').hide();
                                $('#viewProses').show();
                            }
                        });
                        // success callback function

                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        $('.loader-view').hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        })
                    }
                });

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
                // form.submit();
                var body = new FormData(form);
                $.ajax({
                    url: '/lembar-disposisi-karo',
                    beforeSend: function() {
                        $('.loader-view').show();
                    },
                    type: 'post',
                    data: body,
                    processData: false,
                    contentType: false,
                    success: function(data, status, xhr) {
                        // success callback function
                        $('#modal_disposisi_karo').modal('hide');
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Update Disposisi Berhasil'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message
                            })
                        }
                        var kasus_id = $('#kasus_id').val();
                        var id = $('#status_id').val();

                        // $('.loader-view').hide();
                        $.ajax({
                            type: 'get',
                            url: `/data-kasus/view/${kasus_id}/${id}`,
                            success: function(data) {
                                $('#viewProses').html(data);
                                $('.loader-view').hide();
                                $('#viewProses').show();
                            }
                        });
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        $('#modal_disposisi_karo').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message
                        })
                        $.ajax({
                            type: 'get',
                            url: `/data-kasus/view/${kasus_id}/${id}`,
                            success: function(data) {
                                $('#viewProses').html(data);
                                $('.loader-view').hide();
                                $('#viewProses').show();
                            }
                        });
                    }
                });
                // var modal = $(this).attr('modal');
                // var kasus_id = $('#kasus_id').val();
                // var id = $('#status_id').val();
                // $('#modal_disposisi_karo').modal('hide');
                // $('.loader-view').show();
                // $('#viewProses').hide();

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
                var body = new FormData(form);
                $.ajax({
                    url: '/lembar-disposisi-sesro',
                    beforeSend: function() {
                        $('.loader-view').show();
                    },
                    type: 'post',
                    data: body,
                    processData: false,
                    contentType: false,
                    success: function(data, status, xhr) {
                        // success callback function
                        $('#modal_disposisi_sesro').modal('hide');
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Update Disposisi Berhasil'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message
                            })
                        }
                        var kasus_id = $('#kasus_id').val();
                        var id = $('#status_id').val();

                        // $('.loader-view').hide();
                        $.ajax({
                            type: 'get',
                            url: `/data-kasus/view/${kasus_id}/${id}`,
                            success: function(data) {
                                $('#viewProses').html(data);
                                $('.loader-view').hide();
                                $('#viewProses').show();
                            }
                        });
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        $('.loader-view').hide();
                        add_notification('.snackbar-bg-danger', {
                            text: errorMessage,
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-center'
                        })
                    }
                });
            }
        });

        $('form select').select2({
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
        var kasus_id = $('#kasus_id').val();
        var id = $('#status_id').val();
        $('#viewProses').hide();
        $('.loader-view').show();
        $.ajax({
            type: 'get',
            url: `/data-kasus/view/${kasus_id}/${id}`,
            success: function(data) {
                $('#viewProses').html(data);
                $('.loader-view').hide();
                $('#viewProses').show();
            }
        });
    })
</script>
