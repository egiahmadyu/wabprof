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
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 27.6%;">
                    </div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Time Line Klasifikasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Audit Investigasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>Gelar Investigasi</p>
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
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidang KEPP</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="div col-12">
            <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span> Tambah Terlapor</button>
        </div>
    </div>
    
    <div class="col-lg-12">
        <form action="/timeline/store" method="post">
            @csrf
            <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="no_nota_dinas" class="form-label">Tanggal Klarifikasi</label>
                    <input type="date" name="no_nota_dinas" class="form-control border-dark">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Tim</label>
                    <select name="tim" id="tim" class="form-control" readonly="">
                        <option value="">Pilih Tim</option>
                        @for ($i = 0; $i < count($tims); $i++)
                            
                            <option value="{{ $tims[$i] }}"
                            @if (isset($disposisi))
                                @if($disposisi->tim == $tims[$i])
                                    {{ 'selected' }}
                                @endif
                            @endif
                            >{{ $tims[$i] }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Penyidik</label>
                    <select name="penyidik" id="penyidik" class="form-control">
                    <option value="">Pilih Penyidik</option>
                    @if(isset($penyidiks) && !empty($penyidiks))
                        @foreach($penyidiks as $penyidik)
                            <option value="{{ $penyidik->id }}">{{ $penyidik->name }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Status</label>
                    <select name="status" id="status_time" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="1">Diterima</option>
                        <option value="2">Ditolak</option>
                        <option value="3">Limpah Polda</option>
                    </select>
                </div>
                <div class="col-lg-12 mb-3 saran_pendapat d-none">
                    <label for="perihal_nota_dinas" class="form-label">Saran Pendapat Klasifikasi</label>
                    <select name="saran_pendapat_klasifikasi" id="saran_pendapat_klasifikasi" class="form-control">
                        <option value="">Pilih Saran</option>
                        <option value="1">Terbukti</option>
                        <option value="2">Lanjut ke Riksa</option>
                        <option value="3">Gelar Audit Investigasi</option>
                    </select>
                </div>
                <div class="col-lg-12 mb-3 limpah-polda d-none">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                                <form action="/data-kasus/update" method="post">
                                    @csrf
                                    <input type="text" class="form-control" value="{{ $kasus->id }}" hidden
                                        name="kasus_id">
                                    <input type="text" class="form-control" value="3" hidden
                                        name="disposisi_tujuan" hidden>
                                    <button class="btn btn-success col-12" name="type_submit"
                                        {{ $kasus->status_id > 4 ? 'disabled' : '' }} value="update_status">
                                        Lanjutkan Audit Investigasi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btn-terlapor').on('click', function () {
            $('#modal_terlapor').modal('show');
        })

        $('#status_time').on('change', function () {
            var status = $(this).val();

            if(status == 3){
                getPolda();
                $('.limpah-polda').removeClass('d-none');
                $('.saran_pendapat').addClass('d-none');
            }else if(status == 1){
                $('.saran_pendapat').removeClass('d-none');
                $('.limpah-polda').addClass('d-none');
            }else{
                $('.saran_pendapat').addClass('d-none');
                $('.limpah-polda').addClass('d-none');
            }
        })

        function getPolda() {
            $.ajax({
                url: "/api/all-polda",
                method: "get"
            }).done(function(data) {
                $(".limpah-polda").html(data)
            });
        }

        $('#tim').prop('disabled', true);

        $('#form-disposisi-kabag').validate({
            rules: {
                no_agenda : {
                    required: true,
                },
                tanggal : {
                    required: true,
                },
                nomor_surat : {
                    required: true,
                },
                surat_dari : {
                    required: true,
                },
                klasifikasi : {
                    required: true,
                },
                derajat : {
                    required: true,
                },
                tim : {
                    required: true,
                },
            },
            messages : {
                no_agenda: "Silahkan isi nomor agenda!",
                tanggal: "Silahkan isi tanggal!",
                nomor_surat: "Silahkan isi nomor surat!",
                surat_dari: "Silahkan isi surat dari!",
                klasifikasi: "Silahkan pilih klasifikasi!",
                derajat: "Silahkan pilih derajat!",
                tim: "Silahkan pilih tim!",
            },
            errorElement : 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label,element) {
                label.parent().removeClass('error');
                label.remove(); 
            },
            submitHandler: function (form) { // for demo
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

        $( 'select' ).select2( {
            theme: 'bootstrap-5'
        } );
    });

    $('.btn-tutup').on('click', function () {
        var form = $(this).attr('form');
        $('#no_agenda').val('');
        $('#klasifikasi').val('');
        $('#derajat').val('');
        $('#tim').val('');
    })
</script>
