<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-warning" onclick="getViewProcess(4)">Sebelumnya</button>
            </div>

            <div>
                {{-- @if ($kasus->status_id > 2)
                    <button type="button" class="btn btn-info" onclick="getViewProcess(3)">Selanjutnya</button>
                @endif --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="100" data-number-of-steps="4" style="width: 100%;">
                    </div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-home" onclick="getViewProcess(3)"></i></div>
                    <p>Audit Investigasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>Gelar Investigasi</p>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Limpah Polda</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <h4>Limpah Ke Polda</h4>
        <form action="/surat-limpah-polda" method="post">
        <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
            @csrf
            <div>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Polda / Sederajat</label>
                        <input type="text" class="form-control" id="polda_limpah" readonly
                            value="{{ $limpahPolda->polda->name }}">
                    </div>
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Limpah</label>
                        <input type="text" class="form-control" readonly value="{{ $limpahPolda->tanggal_limpah }}">
                    </div>
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Pelimpah</label>
                        <input type="text" class="form-control" readonly value="{{ $limpahPolda->user->name }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Nomor Laporan Limpah</label>
                        <input type="text" class="form-control" id="nomor_limpah" name="nomor_limpah"
                            value="{{ $limpahPolda->nomor_limpah }}" placeholder="Nomor Laporan Limpah">
                    </div>
                    <div class="col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Alamat Polda</label>
                        <input type="text" class="form-control" id="alamat_polda" name="alamat_polda"
                                value="{{ $limpahPolda->alamat_polda }}" placeholder="Alamat Polda">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Nota Dinas Laporan Hasil Klarifikasi</label>
                        <input type="text" class="form-control" id="nomor_klarifikasi" name="nomor_klarifikasi"
                            value="{{ $limpahPolda->nomor_klarifikasi }}" placeholder="Nota Dinas Laporan Hasil Klarifikasi">
                    </div>
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Hasil Klarifikasi</label>
                        <input type="date" class="form-control" id="tanggal_klarifikasi" name="tanggal_klarifikasi" value="{{ $limpahPolda->tanggal_klarifikasi }}">
                    </div>
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1" class="form-label">Perihal Hasil Klarifikasi</label>
                        <input type="text" class="form-control" id="perihal_klarifikasi" name="perihal_klarifikasi" value="{{ $limpahPolda->perihal_klarifikasi }}" placeholder="Perihal Hasil Klarifikasi">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Generate Surat
                    Limpah</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#editControls a').click(function(e) {
            e.preventDefault();
            switch ($(this).data('role')) {
                case 'h1':
                case 'h2':
                case 'h3':
                case 'p':
                    document.execCommand('formatBlock', false, $(this).data('role'));
                    break;
                default:
                    document.execCommand($(this).data('role'), false, null);
                    break;
            }

            var textval = $("#editor").html();
            $("#editorCopy").val(textval);
        });

        $("#editor").keyup(function() {
            var value = $(this).html();
            $("#editorCopy").val(value);
        }).keyup();

        $('#checkIt').click(function(e) {
            e.preventDefault();
            alert($("#editorCopy").val());
        });
    });
</script>
