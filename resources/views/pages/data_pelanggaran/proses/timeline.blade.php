<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <div>
                    <button type="button" class="btn btn-info" onclick="getViewProcess(1)"><i
                            class="far fa-arrow-left"></i>
                        Sebelumnya</button>
                </div>
            </div>
            <div>

                @if ($kasus->status_id > 1)
                    <button type="button" class="btn btn-primary" onclick="getViewProcess(3)">Selanjutnya <i
                            class="far fa-arrow-right"></i></button>
                @endif

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 23.6%;">
                    </div>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Klarifikasi </p>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table>
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
                                    <td>{{ $kasus->perihal_nota_dinas }}</td>
                                </tr>
                                <tr>
                                    <td>Unit Pelaksana</td>
                                    <td>:</td>
                                    <td>{{ $disposisi->tim ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

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


    <form action="/klarifikasi/store" id="form_timeline" method="post" novalidate>
        <div class="col-lg-12">
            @csrf
            <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="tanggal_klasifikasi" class="form-label">Tanggal Klarifikasi</label>
                    <input type="date" name="tanggal_klarifikasi" id="tanggal_klarifikasi" required
                        class="form-control border-dark" {{ $data_klarifikasi ? 'disabled' : '' }}
                        value="{{ $data_klarifikasi ? $data_klarifikasi->tanggal_klasifikasi : '' }}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Tim</label>
                    @if (isset($disposisi))
                        <input type="text" name="tim" id="" value="{{ $disposisi->tim }}" hidden>
                        <select id="tim" class="form-control" {{ isset($disposisi) ? 'disabled' : '' }}>
                            <option value="">Pilih Tim</option>
                            @for ($i = 0; $i < count($tims); $i++)
                                <option value="{{ $tims[$i] }}"
                                    @if (isset($disposisi)) @if ($disposisi->tim == $tims[$i])
                                    {{ 'selected' }} @endif
                                    @endif
                                    >{{ $tims[$i] }}</option>
                            @endfor
                        </select>
                    @else
                        <select id="tim" name="tim" class="form-control">
                            <option value="">Pilih Tim</option>
                            @for ($i = 0; $i < count($tims); $i++)
                                <option value="{{ $tims[$i] }}"
                                    @if (isset($disposisi)) @if ($disposisi->tim == $tims[$i])
                                {{ 'selected' }} @endif
                                    @endif
                                    >{{ $tims[$i] }}</option>
                            @endfor
                        </select>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Penyidik</label>
                    <select name="penyidik" id="penyidik" class="form-control" required
                        {{ $data_klarifikasi ? 'disabled' : '' }}>
                        <option value="">Pilih Penyidik</option>
                        @if (isset($penyidiks) && !empty($penyidiks))
                            @foreach ($penyidiks as $penyidik)
                                <option value="{{ $penyidik->id }}"
                                    {{ $data_klarifikasi ? ($data_klarifikasi->penyidik_id == $penyidik->id ? 'selected' : '') : '' }}>
                                    {{ $penyidik->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Status</label>
                    <select name="status" id="status_time" class="form-control" required
                        {{ $data_klarifikasi ? 'disabled' : '' }}>
                        <option value="">Pilih Status</option>
                        <option value="Diterima"
                            {{ $data_klarifikasi ? ($data_klarifikasi->status == 'Diterima' ? 'selected' : '') : '' }}>
                            Lanjut</option>
                        <option value="Ditolak"
                            {{ $data_klarifikasi ? ($data_klarifikasi->status == 'Ditolak' ? 'selected' : '') : '' }}>
                            Tidak Lanjut</option>
                    </select>
                </div>
                @if ($data_klarifikasi && $data_klarifikasi->status == 'Diterima')
                    <div class="col-lg-12 mb-3 saran_pendapat">
                        <label for="perihal_nota_dinas" class="form-label" disabled>Saran Pendapat Klarifikasi</label>
                        <select name="saran_pendapat_klarifikasi" id="saran_pendapat_klarifikasi" disabled
                            class="form-control">
                            <option value="">Pilih Saran</option>
                            <option value="5" {{ $data_klarifikasi->next_status == 5 ? 'selected' : '' }}>
                                Diterima dengan Bukti Permulaan Cukup -> Riksa</option>
                            <option value="3" {{ $data_klarifikasi->next_status == 3 ? 'selected' : '' }}>
                                Diterima untuk dilakukan Audit Investigasi</option>
                        </select>
                    </div>
                @endif
                @if ($data_klarifikasi && $data_klarifikasi->status == 'Ditolak')
                    <div class="saran_pendapat_ditolak">
                        <div class="col-lg-12 mb-3">
                            <label for="perihal_nota_dinas" class="form-label">Saran Pendapat Tidak Lanjut</label>
                            <select name="saran_ditolak" id="saran_ditolak" class="form-control" disabled>
                                <option value="">Pilih Saran</option>
                                <option value="8" {{ $data_klarifikasi->next_status == 8 ? 'selected' : '' }}>
                                    Disatukan Penanganannya Pada Polda/Polres</option>
                                <option value="9" {{ $data_klarifikasi->next_status == 9 ? 'selected' : '' }}>
                                    Tidak Perlu dilanjutkan dengan catatan</option>
                                <option value="10" {{ $data_klarifikasi->next_status == 10 ? 'selected' : '' }}>
                                    Ditolak</option>
                            </select>
                        </div>
                        @if ($data_klarifikasi->next_status == 10 || $data_klarifikasi->next_status == 9)
                            <div class="col-lg-12 mb-3 catatan_berhenti">
                                <label for="kronologis" class="form-label">Catatan</label>
                                <textarea name="catatan_berhenti" cols="30" id="catatan_berhenti" rows="5" disabled
                                    class="form-control border-dark" placeholder="Catatan">{{ $data_klarifikasi->dihentikan->note }}</textarea>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="col-lg-12 mb-3 saran_pendapat d-none">
                    <label for="perihal_nota_dinas" class="form-label">Saran Pendapat Klasifikasi</label>
                    <select name="saran_pendapat_klarifikasi" id="saran_pendapat_klarifikasi" class="form-control">
                        <option value="">Pilih Saran</option>
                        <option value="5">Diterima dengan Bukti Permulaan Cukup -> Riksa</option>
                        <option value="3">Diterima untuk dilakukan Audit Investigasi</option>
                    </select>
                </div>
                <div class="saran_pendapat_ditolak d-none">
                    <div class="col-lg-12 mb-3">
                        <label for="perihal_nota_dinas" class="form-label">Saran Pendapat Tidak Lanjut</label>
                        <select name="saran_ditolak" id="saran_ditolak" class="form-control">
                            <option value="">Pilih Saran</option>
                            <option value="8">Disatukan Penanganannya Pada Polda/Polres</option>
                            <option value="9">Tidak Perlu dilanjutkan dengan catatan</option>
                            <option value="10">Ditolak</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mb-3 catatan_berhenti d-none">
                        <label for="kronologis" class="form-label">Catatan</label>
                        <textarea name="catatan_berhenti" cols="30" id="catatan_berhenti" rows="5"
                            class="form-control border-dark" placeholder="Catatan"></textarea>
                    </div>
                </div>

                <div class="col-lg-12 mb-3 limpah-polda d-none">

                </div>
                @if ($kasus->status_dihentikan == 0)
                    <button class="btn btn-success btn-lanjut col-12" name="type_submit" value="update_status"
                        type="submit" {{ $data_klarifikasi ? 'disabled' : '' }}>
                        Simpan Data & Update Status
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.btn-terlapor').on('click', function() {
            $('#modal_terlapor').modal('show');
        })

        $('#status_time').on('change', function() {
            var status = $(this).val();

            if (status == 3) {
                getPolda();
                $('.limpah-polda').removeClass('d-none');
                $('.saran_pendapat').addClass('d-none');
                $('.saran_pendapat_ditolak').addClass('d-none');
            } else if (status == 'Diterima') {
                $('.saran_pendapat').removeClass('d-none');
                $('.limpah-polda').addClass('d-none');
                $('.saran_pendapat_ditolak').addClass('d-none');
                $('#saran_pendapat_klarifikasi').attr('required', 'required')
                $('#saran_ditolak').removeAttr('required')
                $('#catatan_berhenti').removeAttr('required')
            } else if (status == 'Ditolak') {
                $('.saran_pendapat_ditolak').removeClass('d-none');
                $('.limpah-polda').addClass('d-none');
                $('.saran_pendapat').addClass('d-none');
                $('#saran_ditolak').attr('required', 'required')
                $('#catatan_berhenti').attr('required', 'required')
                $('#saran_pendapat_klarifikasi').removeAttr('required')
            }
        })

        $('#saran_ditolak').on('change', function() {
            var status = $('#saran_ditolak').val()
            console.log(status)
            if (status == 10 || status == 9) {
                $('.catatan_berhenti').removeClass('d-none')
            } else {
                $('.catatan_berhenti').addClass('d-none')
            }
        });

        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = $('#form_timeline')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            $('.loader-view').show();
                            setTimeout(async function() {
                                let process_id = $('#process_id').val()
                                await getViewProcess(process_id)

                            }, 3000);
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();


        function getPolda() {
            $.ajax({
                url: "/api/all-polda",
                method: "get"
            }).done(function(data) {
                $(".limpah-polda").html(data)
            });
        }

        // $('#tim').prop('disabled', true);

        $('#form-timeline').validate({
            rules: {
                tanggal_klasifikasi: {
                    required: true,
                },
                penyidik: {
                    required: true,
                },
                status: {
                    required: true,
                },
            },
            messages: {
                tanggal_klasifikasi: "Silahkan isi tanggal klasifikasi!",
                penyidik: "Silahkan isi penyidik!",
                status: "Silahkan isi status!",
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    var element_after = element.next();
                    error.insertAfter(element_after);
                } else {
                    error.insertAfter(element);
                }
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
                $('.loader-view').show();
                $('#viewProses').hide();
                // setTimeout(function() {
                //     $.ajax({
                //         type: 'get',
                //         url: `/data-kasus/view/${kasus_id}/${id}`,
                //         success: function(data) {
                //             $('#viewProses').html(data);
                //             $('.loader-view').hide();
                //             $('#viewProses').show();
                //         }
                //     });
                // }, 3000);
            }
        });

        $('select').select2({
            theme: 'bootstrap-5'
        });
    });

    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
        $('#no_agenda').val('');
        $('#klasifikasi').val('');
        $('#derajat').val('');
        $('#tim').val('');
    })
    $(document).ready(function() {
        try {
            $("input").each(function() {
                $(this).attr("autocomplete", "off");
            });
        } catch (e) {}
    });
</script>
