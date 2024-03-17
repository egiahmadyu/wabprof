<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(9)"><i
                        class="far fa-arrow-left"></i>
                    Sebelumnya</button>
            </div>
            <!-- <div>
                @if ($kasus->status_id > 6)
<button type="button" class="btn btn-primary" onclick="getViewProcess(7)">Selanjutnya <i
                            class="far fa-arrow-right"></i></button>
@endif
            </div> -->
        </div>
    </div>

    <!-- Timeline -->
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 86.6%;">
                    </div>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Klarifikasi </p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Gelar Audit Investigasi</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Riksa</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Pemberkasan</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>Penuntutan</p>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidang KEPP</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table>
                                {{-- <tr>
                                    <td> No. SPRIN </td>
                                    <td>:</td>
                                    <td>
                                        @if (isset($sprin))
                                            Sprin/{{ $sprin->no_sprin }}/HUK.6.6./2023
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>Pelapor</td>
                                    <td>:</td>
                                    <td>{{ $kasus->pelapor }}</td>
                                </tr>
                                <tr>
                                    <td>Terlapor</td>
                                    <td>:</td>
                                    <td>{{ $kasus->terlapor }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table>
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td>Perihal</td>
                                </tr>
                                <tr>
                                    <td>Unit Pelaksana</td>
                                    <td>:</td>
                                    <td>{{ $kasus->pelapor }}</td>
                                </tr>
                                <tr>
                                    <td>Ketua Tim</td>
                                    <td>:</td>
                                    <td>{{ $kasus->terlapor }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <form class="row g-3" novalidate id="form_sidangkeep" method="post" action="/sidangkeep/save">
            @csrf
            <input type="text" name="data_pelanggar_id" value="{{ $kasus->id }}" hidden>
            <hr>
            <div class="row">
                <h4>Sidang</h4>
                <div class="col-2">
                    <label for="inputAddress" class="form-label">Tanggal Sidang</label>
                    <input type="date" class="form-control" name="tgl_sidang" required
                        value="{{ $sidang ? $sidang->tgl_sidang ? date('Y-m-d', strtotime($sidang->tgl_sidang)) : '' : '' }}"
                        {{ $sidang ? ($sidang->tgl_sidang ? 'disabled' : '') : '' }}>
                </div>
                <div class="col-2">
                    <label for="inputAddress" class="form-label">Jam Sidang</label>
                    <input type="time" class="form-control" name="jam_sidang" required
                        value="{{ $sidang ? $sidang->jam_sidang : '' }}"
                        {{ $sidang ? ($sidang->jam_sidang ? 'disabled' : '') : '' }}>
                </div>
                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Tempat Sidang</label>
                    <input type="text" class="form-control" name="tempat_sidang" required
                        value="{{ $sidang ? $sidang->tempat_sidang : '' }}"
                        {{ $sidang ? ($sidang->tempat_sidang ? 'disabled' : '') : '' }}>
                </div>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">Pakaian Sidang</label>
                    <input type="text" class="form-control" name="pakaian_sidang" required
                        value="{{ $sidang ? $sidang->pakaian_sidang : '' }}"
                        {{ $sidang ? ($sidang->pakaian_sidang ? 'disabled' : '') : '' }}>
                </div>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">Terduga {{ $kasus->terlapor }}</label>
                    {{-- <div class="form-check">
                        <input type="radio" class="form-check-input" id="validationFormCheck2" name="kehadiran"
                            required {{ $sidang ? ($sidang->kehadiran == 'Hadir' ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="validationFormCheck2">Hadir</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="validationFormCheck3" name="kehadiran"
                            required {{ $sidang ? ($sidang->kehadiran == 'Tidak hadir' ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="validationFormCheck3">Tidak hadir
                    </div> --}}
                    <select class="form-select" aria-label="Default select example" required name="kehadiran"
                        {{ $sidang ? ($sidang->kehadiran ? 'disabled' : '') : '' }}>
                        <option selected value="">--> Pilih Kehadiran <-- </option>
                        <option value="Hadir" {{ $sidang ? ($sidang->kehadiran == 'Hadir' ? 'selected' : '') : '' }}>
                            Hadir</option>
                        <option
                            value="Tidak Hadir"{{ $sidang ? ($sidang->kehadiran == 'Tidak Hadir' ? 'selected' : '') : '' }}>
                            Tidak Hadir</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row putusan_sidang_row">
                <h4>Putusan Sidang</h4>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">Putusan Sidang</label>
                    <select class="form-select" aria-label="Default select example" name="putusan_sidang" required
                        onchange="check_putusan_sidangkeep()" id="putusan_sidang"
                        {{ $sidang ? ($sidang->putusan_sidang ? 'disabled' : '') : '' }}>
                        <option selected value="">--> Pilih Putusan Sidang <-- </option>
                        <option value="Terbukti"
                            {{ $sidang ? ($sidang->putusan_sidang == 'Terbukti' ? 'selected' : '') : '' }}>Terbukti
                        </option>
                        <option value="Tidak Terbukti"
                            {{ $sidang ? ($sidang->putusan_sidang == 'Tidak Terbukti' ? 'selected' : '') : '' }}>Tidak
                            Terbukti</option>
                    </select>
                </div>
                <div class="col-md-4 keputusan_sidang_1">
                    <label for="inputCity" class="form-label">Keputusan Etik</label>
                    @if ($sidang && $sidang->keputusan_etiks)
                        <ul>
                            @foreach ($sidang->keputusan_etiks as $value)
                                <li>{{ $value->keputusan }}</li>
                            @endforeach
                        </ul>
                    @else
                        <select class="form-select" aria-label="Default select example" name="keputusan_etik[]"
                            multiple="multiple" id="keputusan_etik">
                            <option value="">--> Pilih Keputusan <-- </option>
                            <option value="Perilaku Pelanggar dinyatakan sebagai perbuatan tercela">Perilaku Pelanggar
                                dinyatakan sebagai perbuatan tercela
                            </option>
                            <option
                                value="Kewajiban Pelanggar untuk meminta maaf secara lisan dihadapan Sidang KKEP dan secara tertulis kepada pimpinan Polri dan pihak yang dirugikan">
                                Kewajiban Pelanggar untuk meminta maaf secara lisan dihadapan Sidang KKEP dan secara
                                tertulis kepada pimpinan Polri dan pihak yang dirugikan
                            </option>
                            <option
                                value="Kewajiban Pelanggar untuk mengikuti pembinaan rohani, mental dan pengetahuan profesi selama 1 (satu) bulan">
                                Kewajiban Pelanggar untuk mengikuti pembinaan rohani, mental dan pengetahuan profesi
                                selama
                                1 (satu) bulan
                            </option>
                        </select>
                    @endif
                </div>
                <div class="col-md-4 keputusan_sidang_1">
                    <label for="inputCity" class="form-label">Keputusan Administratif</label>
                    @if ($sidang && $sidang->administratif)
                        <ul>
                            @foreach ($sidang->administratif as $value)
                                <li>{{ $value->keputusan }}</li>
                            @endforeach
                        </ul>
                    @else
                        <select class="form-select keputusan_sidang_1" aria-label="Default select example"
                            name="keputusan_administratif[]" multiple="multiple" id="keputusan_administratif"
                            {{ $sidang ? ($sidang->keputusan_etik || $sidang->keputusan_administratif ? 'disabled' : '') : '' }}>
                            <option value="">--> Pilih Keputusan <-- </option>
                            <option value="Mutasi Bersifat Demosi paling singkat 1 (satu) tahun">Mutasi Bersifat Demosi
                                paling singkat 1 (satu) tahun</option>
                            <option
                                value="Penundaan kenaikan pangkat paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)">
                                Penundaan kenaikan pangkat paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)
                            </option>
                            <option
                                value="Penundaan pendidikan paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)">
                                Penundaan pendidikan paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)
                            </option>
                            <option value="Penempatan pada Tempat Khusus paling lama 30 (tiga puluh) hari">
                                Penempatan pada Tempat
                                Khusus paling lama 30 (tiga puluh) hari</option>
                            <option value="PTDH">PTDH</option>
                        </select>
                    @endif
                </div>
                <div class="col-md-12">
                    <label for="inputCity" class="form-label">Keputusan Sidang</label>
                    <textarea name="keputusan_sidang" cols="30" id="alamat" rows="9" placeholder="Keputusan Hakim"
                        required class="form-control border-dark" {{ $sidang ? ($sidang->keputusan_sidang ? 'readonly' : '') : '' }}>{{ $sidang ? $sidang->keputusan_sidang : '' }}</textarea>
                    </select>
                </div>
            </div>
            @if (!$sidang)
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </div>
            @endif
        </form>
    </div>
    @if ($sidang)
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-centered align-middle table-nowrap mb-0" id="data-data">
                    <thead class="text-muted table-light">
                        <tr>
                            <th scope="col"> Nama Kegiatan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laporan Hasil Sidang KEPP</td>
                            <td>
                                <form action="/sidang/lhs/kepp" id="form_lhs_kepp" method="post" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                hidden>
                                            <input type="text" class="form-control" name="no_surat_lhs" required
                                                value="{{ $sidang ? $sidang->no_surat_lhs : '' }}"
                                                placeholder="No Surat Laporan Hasil Sidang"
                                                {{ $sidang->no_surat_lhs ? 'readonly' : '' }}>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                hidden>
                                            <input type="date" class="form-control" name="tanggal_lhs" required
                                                value="{{ $sidang ? $sidang->tanggal_lhs ? date('Y-m-d', strtotime($sidang->tanggal_lhs)) : '' : '' }}"
                                                placeholder="No Surat Laporan Hasil Sidang"
                                                {{ $sidang->tanggal_lhs ? 'readonly' : '' }}>
                                        </div>

                                        <div class="col-lg-6 mt-2">
                                            <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                hidden>
                                            <input type="text" class="form-control" name="nomor_putusan" required
                                                value="{{ $sidang ? $sidang->nomor_putusan : '' }}"
                                                placeholder="No Putusan"
                                                {{ $sidang->nomor_putusan ? 'readonly' : '' }}>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                hidden>
                                            <input type="date" class="form-control" name="tanggal_putusan"
                                                required value="{{ $sidang ? $sidang->tanggal_putusan ? date('Y-m-d', strtotime($sidang->tanggal_putusan)) : '' : '' }}"
                                                placeholder="No Surat Laporan Hasil Sidang"
                                                {{ $sidang->tanggal_putusan ? 'readonly' : '' }}>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <button type="submit"
                                                class="btn btn-primary">{{ $sidang->no_surat_lhs ? 'Download' : 'Buat Dokumen' }}</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <hr>
    @if ($sidang && $sidang->kehadiran == 'Hadir' && $sidang->putusan_sidang == 'Terbukti')
        @if (!$sidang_banding)
            <div class="row mt-2">
                <div class="col-lg-12">
                    <form action="/sidangkeep/pengajuan_banding" method="post">
                        @csrf
                        <input type="text" class="form-control" value="{{ $kasus->id }}" hidden
                            name="kasus_id">
                        <button class="btn btn-success" name="type_submit" value="update_status">
                            Ajukan Sidang Banding
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @endif

    @if ($sidang_banding)
        <div class="row mb-2">
            <form class="row g-3" novalidate id="form_sidang_banding" method="post" action="/sidang_banding/save">
                @csrf
                <input type="text" name="data_pelanggar_id" value="{{ $kasus->id }}" hidden>
                <hr>
                <div class="row">
                    <h4>Sidang Banding</h4>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Tanggal Permohonan</label>
                        <input type="date" class="form-control" name="tanggal_permohonan_sidang_banding" required
                            value="{{ $sidang_banding ? $sidang_banding->tanggal_permohonan_sidang_banding ? date('Y-m-d', strtotime($sidang_banding->tanggal_permohonan_sidang_banding)) : '' : '' }}"
                            {{ $sidang_banding ? ($sidang_banding->tanggal_permohonan_sidang_banding ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-2 mb-4">
                        <label for="inputAddress" class="form-label">Tanggal Memori Banding</label>
                        <input type="date" class="form-control" name="tanggal_memori_banding" required
                            value="{{ $sidang_banding ? $sidang_banding->tanggal_memori_banding ? date('Y-m-d', strtotime($sidang_banding->tanggal_memori_banding)) : '' : '' }}"
                            {{ $sidang_banding ? ($sidang_banding->tanggal_memori_banding ? 'disabled' : '') : '' }}>
                    </div>
                    <hr>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Tanggal Sidang</label>
                        <input type="date" class="form-control" name="tgl_sidang" required
                            value="{{ $sidang_banding ? $sidang_banding->tgl_sidang ? date('Y-m-d', strtotime($sidang_banding->tgl_sidang)) : '' : '' }}"
                            {{ $sidang_banding ? ($sidang_banding->tgl_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Jam Sidang</label>
                        <input type="time" class="form-control" name="jam_sidang" required
                            value="{{ $sidang_banding ? $sidang_banding->jam_sidang : '' }}"
                            {{ $sidang_banding ? ($sidang_banding->jam_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-4">
                        <label for="inputAddress2" class="form-label">Tempat Sidang</label>
                        <input type="text" class="form-control" name="tempat_sidang" required
                            value="{{ $sidang_banding ? $sidang_banding->tempat_sidang : '' }}"
                            {{ $sidang_banding ? ($sidang_banding->tempat_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Pakaian Sidang</label>
                        <input type="text" class="form-control" name="pakaian_sidang" required
                            value="{{ $sidang_banding ? $sidang_banding->pakaian_sidang : '' }}"
                            {{ $sidang_banding ? ($sidang_banding->pakaian_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Kehadiran</label>
                        <select class="form-select" aria-label="Default select example" required name="kehadiran"
                            {{ $sidang_banding ? ($sidang_banding->kehadiran ? 'disabled' : '') : '' }}>
                            <option selected value="">--> Pilih Kehadiran <-- </option>
                            <option value="Hadir"
                                {{ $sidang_banding ? ($sidang_banding->kehadiran == 'Hadir' ? 'selected' : '') : '' }}>
                                Hadir</option>
                            <option
                                value="Tidak Hadir"{{ $sidang_banding ? ($sidang_banding->kehadiran == 'Tidak Hadir' ? 'selected' : '') : '' }}>
                                Tidak Hadir</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row putusan_sidang_row">
                    <h4>Putusan Sidang</h4>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Putusan Sidang</label>
                        <select class="form-select" aria-label="Default select example" name="putusan_sidang"
                            required id="putusan_sidang_banding" onchange="check_putusan_sidangbanding()"
                            {{ $sidang_banding ? ($sidang_banding->putusan_sidang ? 'disabled' : '') : '' }}>
                            <option selected value="">--> Pilih Putusan Sidang <-- </option>
                            <option value="Terbukti"
                                {{ $sidang_banding ? ($sidang_banding->putusan_sidang == 'Terbukti' ? 'selected' : '') : '' }}>
                                Terbukti
                            </option>
                            <option value="Tidak Terbukti"
                                {{ $sidang_banding ? ($sidang_banding->putusan_sidang == 'Tidak Terbukti' ? 'selected' : '') : '' }}>
                                Tidak
                                Terbukti</option>
                        </select>
                    </div>
                    <div class="col-md-4 keputusan_sidang_2">
                        <label for="inputCity" class="form-label">Keputusan Etik</label>
                        @if ($sidang_banding && count($sidang_banding->keputusan_etiks) > 0)
                            <ul>
                                @foreach ($sidang_banding->keputusan_etiks as $value)
                                    <li>{{ $value->keputusan }}</li>
                                @endforeach
                            </ul>
                        @else
                            <select class="form-select" aria-label="Default select example" name="keputusan_etik[]"
                                multiple="multiple" required id="keputusan_etik_sidang_banding">
                                <option value="">--> Pilih Keputusan <-- </option>
                                <option value="Perilaku Pelanggar dinyatakan sebagai perbuatan tercela">Perilaku
                                    Pelanggar
                                    dinyatakan sebagai perbuatan tercela
                                </option>
                                <option
                                    value="Kewajiban Pelanggar untuk meminta maaf secara lisan dihadapan Sidang KKEP dan secara tertulis kepada pimpinan Polri dan pihak yang dirugikan">
                                    Kewajiban Pelanggar untuk meminta maaf secara lisan dihadapan Sidang KKEP dan secara
                                    tertulis kepada pimpinan Polri dan pihak yang dirugikan
                                </option>
                                <option
                                    value="Kewajiban Pelanggar untuk mengikuti pembinaan rohani, mental dan pengetahuan profesi selama 1 (satu) bulan">
                                    Kewajiban Pelanggar untuk mengikuti pembinaan rohani, mental dan pengetahuan profesi
                                    selama
                                    1 (satu) bulan
                                </option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4 keputusan_sidang_2">
                        <label for="inputCity" class="form-label">Keputusan Administratif</label>
                        @if ($sidang_banding && count($sidang_banding->administratif) > 0)
                            <ul>
                                @foreach ($sidang_banding->administratif as $value)
                                    <li>{{ $value->keputusan }}</li>
                                @endforeach
                            </ul>
                        @else
                            <select class="form-select" aria-label="Default select example"
                                name="keputusan_administratif[]" multiple="multiple" required
                                id="keputusan_administratif_sidang_banding"
                                {{ $sidang_banding ? ($sidang_banding->keputusan_etik || $sidang_banding->keputusan_administratif ? 'disabled' : '') : '' }}>
                                <option value="">--> Pilih Keputusan <-- </option>
                                <option value="Mutasi Bersifat Demosi paling singkat 1 (satu) tahun">Mutasi Bersifat
                                    Demosi
                                    paling singkat 1 (satu) tahun</option>
                                <option
                                    value="Penundaan kenaikan pangkat paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)">
                                    Penundaan kenaikan pangkat paling singkat 1 (satu) tahun dan paling lama 3 (tiga
                                    tahun)
                                </option>
                                <option
                                    value="Penundaan pendidikan paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)">
                                    Penundaan pendidikan paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)
                                </option>
                                <option value="Penempatan pada Tempat Khusus paling lama 30 (tiga puluh) hari">
                                    Penempatan pada Tempat
                                    Khusus paling lama 30 (tiga puluh) hari</option>
                                <option value="PTDH">PTDH</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Keputusan Sidang</label>
                        <textarea name="keputusan_sidang" cols="30" id="alamat" rows="9" placeholder="Keputusan Hakim"
                            required class="form-control border-dark"
                            {{ $sidang_banding ? ($sidang_banding->keputusan_sidang ? 'readonly' : '') : '' }}>{{ $sidang_banding ? $sidang_banding->keputusan_sidang : '' }}</textarea>
                        </select>
                    </div>
                </div>
                @if (!$sidang_banding->putusan_sidang)
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                @endif
                <hr>
            </form>
        </div>
        @if ($sidang_banding->putusan_sidang)
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-centered align-middle table-nowrap mb-0" id="data-data">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col"> Nama Kegiatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Laporan Hasil Sidang Banding</td>
                                <td>
                                    <form action="/sidang/lhs/banding" id="form_lhs_banding" method="post"
                                        novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control" name="no_surat_lhs"
                                                    required
                                                    value="{{ $sidang_banding ? $sidang_banding->no_surat_lhs : '' }}"
                                                    placeholder="No Surat Laporan Hasil Sidang"
                                                    {{ $sidang_banding->no_surat_lhs ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control" name="tanggal_lhs"
                                                    required
                                                    value="{{ $sidang_banding ? $sidang_banding->tanggal_lhs ? date('Y-m-d', strtotime($sidang_banding->tanggal_lhs)) : '' : '' }}"
                                                    placeholder="No Surat Laporan Hasil Sidang"
                                                    {{ $sidang_banding->tanggal_lhs ? 'readonly' : '' }}>
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control" name="nomor_putusan"
                                                    required
                                                    value="{{ $sidang_banding ? $sidang_banding->nomor_putusan : '' }}"
                                                    placeholder="No Putusan"
                                                    {{ $sidang_banding->nomor_putusan ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control" name="tanggal_putusan"
                                                    required
                                                    value="{{ $sidang_banding ? $sidang_banding->tanggal_putusan : '' }}"
                                                    placeholder="No Surat Laporan Hasil Sidang"
                                                    {{ $sidang_banding->tanggal_putusan ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $sidang_banding->no_surat_lhs ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif


    @if ($sidang_banding && $sidang_banding->kehadiran == 'Hadir')
        @if (!$sidang_kembali)
            <div class="row mt-2">
                <div class="col-lg-12">
                    <form action="/sidangkeep/pengajuan_ulang" method="post">
                        @csrf
                        <input type="text" class="form-control" value="{{ $kasus->id }}" hidden
                            name="kasus_id">
                        <button class="btn btn-success" name="type_submit" value="update_status">
                            Ajukan Sidang Peninjauan Kembali
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @endif


    @if ($sidang_kembali)
        <div class="row mb-2">
            <form class="row g-3" novalidate id="form_sidang_kembali" method="post" action="/sidang_kembali/save">
                @csrf
                <input type="text" name="data_pelanggar_id" value="{{ $kasus->id }}" hidden>
                <hr>
                <div class="row">
                    <h4>Sidang Peninjauan Kembali</h4>
                    <div class="col-2 mb-4">
                        <label for="inputAddress" class="form-label">Tanggal Usulan Kep Tim Peneliti</label>
                        <input type="date" class="form-control" name="tanggal_usulan_kep" required
                            value="{{ $sidang_kembali ? $sidang_kembali->tanggal_usulan_kep ? date('Y-m-d', strtotime($sidang_kembali->tanggal_usulan_kep)) : '' : '' }}"
                            {{ $sidang_kembali ? ($sidang_kembali->tanggal_usulan_kep ? 'disabled' : '') : '' }}>
                    </div>
                    <hr>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Tanggal Sidang</label>
                        <input type="date" class="form-control" name="tgl_sidang" required
                            value="{{ $sidang_kembali ? $sidang_kembali->tgl_sidang  ? date('Y-m-d', strtotime($sidang_kembali->tgl_sidang)) : '': '' }}"
                            {{ $sidang_kembali ? ($sidang_kembali->tgl_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Jam Sidang</label>
                        <input type="time" class="form-control" name="jam_sidang" required
                            value="{{ $sidang_kembali ? $sidang_kembali->jam_sidang : '' }}"
                            {{ $sidang_kembali ? ($sidang_kembali->jam_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-4">
                        <label for="inputAddress2" class="form-label">Tempat Sidang</label>
                        <input type="text" class="form-control" name="tempat_sidang" required
                            value="{{ $sidang_kembali ? $sidang_kembali->tempat_sidang : '' }}"
                            {{ $sidang_kembali ? ($sidang_kembali->tempat_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Pakaian Sidang</label>
                        <input type="text" class="form-control" name="pakaian_sidang" required
                            value="{{ $sidang_kembali ? $sidang_kembali->pakaian_sidang : '' }}"
                            {{ $sidang_kembali ? ($sidang_kembali->pakaian_sidang ? 'disabled' : '') : '' }}>
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Kehadiran</label>
                        <select class="form-select" aria-label="Default select example" required name="kehadiran"
                            {{ $sidang_kembali ? ($sidang_kembali->kehadiran ? 'disabled' : '') : '' }}>
                            <option selected value="">--> Pilih Kehadiran <-- </option>
                            <option value="Hadir"
                                {{ $sidang_kembali ? ($sidang_kembali->kehadiran == 'Hadir' ? 'selected' : '') : '' }}>
                                Hadir</option>
                            <option
                                value="Tidak Hadir"{{ $sidang_kembali ? ($sidang_kembali->kehadiran == 'Tidak Hadir' ? 'selected' : '') : '' }}>
                                Tidak Hadir</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row putusan_sidang_row">
                    <h4>Putusan Sidang</h4>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Putusan Sidang</label>
                        <select class="form-select" aria-label="Default select example" name="putusan_sidang"
                            required id="putusan_sidang_kembali" onchange="check_putusan_sidangkembali()"
                            {{ $sidang_kembali ? ($sidang_kembali->putusan_sidang ? 'disabled' : '') : '' }}>
                            <option selected value="" disable>--> Pilih Putusan Sidang <-- </option>
                            <option value="Terbukti"
                                {{ $sidang_kembali ? ($sidang_kembali->putusan_sidang == 'Terbukti' ? 'selected' : '') : '' }}>
                                Terbukti
                            </option>
                            <option value="Tidak Terbukti"
                                {{ $sidang_kembali ? ($sidang_kembali->putusan_sidang == 'Tidak Terbukti' ? 'selected' : '') : '' }}>
                                Tidak
                                Terbukti</option>
                        </select>
                    </div>
                    <div class="col-md-4 keputusan_sidang_3">
                        <label for="inputCity" class="form-label">Keputusan Etik</label>
                        @if ($sidang_kembali && count($sidang_kembali->keputusan_etiks) > 0)
                            <ul>
                                @foreach ($sidang_kembali->keputusan_etiks as $value)
                                    <li>{{ $value->keputusan }}</li>
                                @endforeach
                            </ul>
                        @else
                            <select class="form-select" aria-label="Default select example" name="keputusan_etik[]"
                                multiple="multiple" required id="keputusan_etik_sidang_kembali">
                                <option value=""cdisable>--> Pilih Keputusan <-- </option>
                                <option value="Perilaku Pelanggar dinyatakan sebagai perbuatan tercela">Perilaku
                                    Pelanggar
                                    dinyatakan sebagai perbuatan tercela
                                </option>
                                <option
                                    value="Kewajiban Pelanggar untuk meminta maaf secara lisan dihadapan Sidang KKEP dan secara tertulis kepada pimpinan Polri dan pihak yang dirugikan">
                                    Kewajiban Pelanggar untuk meminta maaf secara lisan dihadapan Sidang KKEP dan secara
                                    tertulis kepada pimpinan Polri dan pihak yang dirugikan
                                </option>
                                <option
                                    value="Kewajiban Pelanggar untuk mengikuti pembinaan rohani, mental dan pengetahuan profesi selama 1 (satu) bulan">
                                    Kewajiban Pelanggar untuk mengikuti pembinaan rohani, mental dan pengetahuan profesi
                                    selama
                                    1 (satu) bulan
                                </option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-4 keputusan_sidang_3">
                        <label for="inputCity" class="form-label">Keputusan Administratif</label>
                        @if ($sidang_kembali && count($sidang_kembali->administratif) > 0)
                            <ul>
                                @foreach ($sidang_kembali->administratif as $value)
                                    <li>{{ $value->keputusan }}</li>
                                @endforeach
                            </ul>
                        @else
                            <select class="form-select" aria-label="Default select example"
                                name="keputusan_administratif[]" multiple="multiple" required
                                id="keputusan_administratif_sidang_kembali"
                                {{ $sidang_kembali ? ($sidang_kembali->keputusan_etik || $sidang_kembali->keputusan_administratif ? 'disabled' : '') : '' }}>
                                <option value="">--> Pilih Keputusan <-- </option>
                                <option value="Mutasi Bersifat Demosi paling singkat 1 (satu) tahun">Mutasi Bersifat
                                    Demosi
                                    paling singkat 1 (satu) tahun</option>
                                <option
                                    value="Penundaan kenaikan pangkat paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)">
                                    Penundaan kenaikan pangkat paling singkat 1 (satu) tahun dan paling lama 3 (tiga
                                    tahun)
                                </option>
                                <option
                                    value="Penundaan pendidikan paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)">
                                    Penundaan pendidikan paling singkat 1 (satu) tahun dan paling lama 3 (tiga tahun)
                                </option>
                                <option value="Penempatan pada Tempat Khusus paling lama 30 (tiga puluh) hari">
                                    Penempatan pada Tempat
                                    Khusus paling lama 30 (tiga puluh) hari</option>
                                <option value="PTDH">PTDH</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Keputusan Sidang</label>
                        <textarea name="keputusan_sidang" cols="30" id="alamat" rows="9" placeholder="Keputusan Hakim"
                            required class="form-control border-dark"
                            {{ $sidang_kembali ? ($sidang_kembali->keputusan_sidang ? 'readonly' : '') : '' }}>{{ $sidang_kembali ? $sidang_kembali->keputusan_sidang : '' }}</textarea>
                        </select>
                    </div>
                </div>
                @if (!$sidang_kembali->putusan_sidang)
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                @endif
                <hr>
            </form>
        </div>
        @if ($sidang_kembali->putusan_sidang)
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-centered align-middle table-nowrap mb-0" id="data-data">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col"> Nama Kegiatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Laporan Hasil Sidang Banding</td>
                                <td>
                                    <form action="/sidang/lhs/kembali" id="form_lhs_kembali" method="post"
                                        novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control" name="no_surat_lhs"
                                                    required
                                                    value="{{ $sidang_kembali ? $sidang_kembali->no_surat_lhs : '' }}"
                                                    placeholder="No Surat Laporan Hasil Sidang"
                                                    {{ $sidang_kembali->no_surat_lhs ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control" name="tanggal_lhs"
                                                    required
                                                    value="{{ $sidang_kembali ? $sidang_kembali->tanggal_lhs ? date('Y-m-d', strtotime($sidang_kembali->tanggal_lhs)) : '' : '' }}"
                                                    placeholder="No Surat Laporan Hasil Sidang"
                                                    {{ $sidang_kembali->tanggal_lhs ? 'readonly' : '' }}>
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control" name="nomor_putusan"
                                                    required
                                                    value="{{ $sidang_kembali ? $sidang_kembali->nomor_putusan : '' }}"
                                                    placeholder="No Putusan"
                                                    {{ $sidang_kembali->nomor_putusan ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control" name="tanggal_putusan"
                                                    required
                                                    value="{{ $sidang_kembali ? $sidang_kembali->tanggal_putusan ? date('Y-m-d', strtotime($sidang_kembali->tanggal_putusan)) : '' : '' }}"
                                                    placeholder="No Surat Laporan Hasil Sidang"
                                                    {{ $sidang_kembali->tanggal_putusan ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $sidang_kembali->no_surat_lhs ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif

</div>

<div class="modal fade" id="modal_pembentukan_komisi" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembentukan Komisi Kode Etik</h5>
                <button type="button" class="btn-close btn-tutup" form="form-pembentukan-komisi"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pembentukan-komisi" method="post" id="form-pembentukan-komisi">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Pembentukan Komisi Kode
                                    Etik</label>
                                <input type="text" class="form-control" name="nomor"
                                    aria-describedby="emailHelp" placeholder="Nomor Pembentukan Komisi Kode Etik">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Menimbang Pelanggar</label>
                                @if (isset($perbaikan))
                                    <select name="bp3kepp_id" id="bp3kepp_id" class="form-control">
                                        <option value="">Pilih Pelanggar</option>
                                        @foreach ($perbaikan_data as $perbaikan)
                                            <option value="{{ $perbaikan->id }}">{{ $perbaikan->nama }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Surat DIVKUM</label>
                                <input type="text" class="form-control" name="nomor_surat_divkum"
                                    aria-describedby="emailHelp" placeholder="Nomor Surat DIVKUM">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Surat DIVKUM</label>
                                <input type="date" class="form-control" name="tanggal_surat_divkum">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                                <input type="text" class="form-control" name="pangkat" placeholder="Pangkat">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kesatuan</label>
                                <input type="text" class="form-control" name="kesatuan" placeholder="Kesatuan">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>
                        Susunan Komisi Kode Etik
                    </h5>
                    <hr>
                    <div class="mb-3" id="form_input_susunan">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama_komisi[]"
                                        placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                                    <input type="text" class="form-control" name="pangkat_komisi[]"
                                        placeholder="Pangkat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">NRP</label>
                                    <input type="text" class="form-control" name="nrp_komisi[]"
                                        placeholder="NRP">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_komisi[]"
                                        placeholder="Jabatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="" id="" class="form-control text-center" disabled>
                                        <option value="">Ketua</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-3" class="d-flex justify-content-end">
                        <a href="#" onclick="tambahAnggota()"> <i class="far fa-plus-square"></i>
                            Anggota </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal_pembentukan_komisi">Generate</button>
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-pembentukan-komisi"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.btn-terlapor').on('click', function() {
        $('#modal_terlapor').modal('show');
    })

    function tambahAnggota() {
        let inHtml =
            `<div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_komisi[]" placeholder="Nama">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat_komisi[]" placeholder="Pangkat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NRP</label>
                        <input type="text" class="form-control" name="nrp_komisi[]" placeholder="NRP">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_komisi[]" placeholder="Jabatan">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <select name="" id="" class="form-control text-center" disabled>
                            <option value="">Anggota</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>`;
        $('#form_input_susunan').append(inHtml);
    }

    $('select').select2({
        theme: 'bootstrap-5'
    });

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_lhs_banding')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#status_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_lhs_kepp')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#status_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_sidang_kembali')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_sidangkeep')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        $('.loader-view').show();
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_sidang_banding')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_lhs_kembali')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#status_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();


    $(document).ready(function() {
        check_putusan_sidangkembali()
        check_putusan_sidangbanding()
        check_putusan_sidangkeep()
    })

    function check_putusan_sidangkeep() {
        var putusan_sidang = $('#putusan_sidang').val()
        if (putusan_sidang == 'Terbukti') {
            $('.keputusan_sidang_1').css('display', 'block')
            $('#keputusan_etik').attr('required', 'required')
            $('#keputusan_administratif').attr('required', 'required')
        } else {
            $('.keputusan_sidang_1').css('display', 'none')
            $('#keputusan_etik').removeAttr('required')
            $('#keputusan_administratif').removeAttr('required')
        }
    }

    function check_putusan_sidangbanding() {
        var putusan_sidang = $('#putusan_sidang_banding').val()
        if (putusan_sidang == 'Terbukti') {
            $('.keputusan_sidang_2').css('display', 'block')
            $('#keputusan_etik_sidang_banding').attr('required', 'required')
            $('#keputusan_administratif_sidang_banding').attr('required', 'required')
        } else {
            $('.keputusan_sidang_2').css('display', 'none')
            $('#keputusan_etik_sidang_banding').removeAttr('required')
            $('#keputusan_administratif_sidang_banding').removeAttr('required')
        }
    }

    function check_putusan_sidangkembali() {
        var putusan_sidang = $('#putusan_sidang_kembali').val()
        if (putusan_sidang == 'Terbukti') {
            $('.keputusan_sidang_3').css('display', 'block')
            $('#keputusan_etik_sidang_kembali').attr('required', 'required')
            $('#keputusan_administratif_sidang_kembali').attr('required', 'required')
        } else {
            $('.keputusan_sidang_3').css('display', 'none')
            $('#keputusan_etik_sidang_kembali').removeAttr('required')
            $('#keputusan_administratif_sidang_kembali').removeAttr('required')
        }
    }

    $('.btn-generate').on('click', function() {
        var modal = $(this).attr('modal');
        var kasus_id = $('#kasus_id').val();
        var id = $('#status_id').val();
        $('#' + modal).modal('hide');
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
    });

    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
        $('#' + form).find("input[type=text], input[type=time], input[type=date], textarea").val("");
    })
</script>
