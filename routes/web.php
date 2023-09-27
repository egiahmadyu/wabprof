<?php

use App\Http\Controllers\AuditInvestigasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiterimaController;
use App\Http\Controllers\GelarPerkaraController;
use App\Http\Controllers\GelarInvestigasiController;
use App\Http\Controllers\PemberkasanController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\PenyidikController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\WujudPerbuatanController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\LimpahPoldaController;
use App\Http\Controllers\ProvostWabprofController;
use App\Http\Controllers\PulbaketController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SidikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('partials.master');
// });

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/pdf-test', [LimpahPoldaController::class, 'generateDocumen']);
// Route::get('/lembar-disposisi', [LimpahPoldaController::class, 'generateDisposisi']);
Route::post('login', [AuthController::class, 'loginAction'])->name('login-action');


Route::middleware(['auth'])->group(function () {
    // Route::get('/', function () {
    //     return view('pages.dashboard.index');
    // });

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // View Kasus
    Route::get('data-kasus', [KasusController::class, 'index'])->name('kasus.index');
    Route::post('data-kasus/data', [KasusController::class, 'data'])->name('kasus.data');
    Route::post('data-kasus/update', [KasusController::class, 'updateData'])->name('kasus.update');
    Route::get('data-kasus/detail/{id}', [KasusController::class, 'detail'])->name('kasus.detail');
    Route::post('data-kasus/status/update', [KasusController::class, 'updateStatus'])->name('kasus.update.status');
    // End View Kasus

    // Create Kasus
    Route::get('input-data-kasus', [KasusController::class, 'inputKasus'])->name('kasus.input');
    Route::post('input-data-kasus/store', [KasusController::class, 'storeKasus'])->name('kasus.store.kasus');
    // End View Kasus

    // Start Penyidik
    Route::get('data-penyidik', [PenyidikController::class, 'index'])->name('penyidik.index');
    Route::post('data-penyidik/data', [PenyidikController::class, 'data'])->name('penyidik.data');

    Route::get('input-data-penyidik', [PenyidikController::class, 'inputPenyidik'])->name('penyidik.input');
    Route::post('input-data-penyidik/store', [PenyidikController::class, 'storePenyidik'])->name('penyidik.store.penyidik');

    Route::get('edit-data-penyidik/{id}', [PenyidikController::class, 'editPenyidik'])->name('penyidik.edit');
    Route::post('data-penyidik/update', [PenyidikController::class, 'updateData'])->name('penyidik.update');

    Route::get('data-penyidik/hapus/{id}', [PenyidikController::class, 'hapusData'])->name('penyidik.hapus');
    // End Penyidik

    // Start Pangkat
    Route::get('data-pangkat', [PangkatController::class, 'index'])->name('pangkat.index');
    Route::post('data-pangkat/data', [PangkatController::class, 'data'])->name('pangkat.data');

    Route::get('input-data-pangkat', [PangkatController::class, 'inputPangkat'])->name('pangkat.input');
    Route::post('input-data-pangkat/store', [PangkatController::class, 'storePangkat'])->name('pangkat.store.pangkat');

    Route::get('edit-data-pangkat/{id}', [PangkatController::class, 'editPangkat'])->name('pangkat.edit');
    Route::post('data-pangkat/update', [PangkatController::class, 'updateData'])->name('pangkat.update');

    Route::get('data-pangkat/hapus/{id}', [PangkatController::class, 'hapusData'])->name('pangkat.hapus');
    // End Pangkat

    // Start Wujud Perbuatan
    Route::get('data-wujud-perbuatan', [WujudPerbuatanController::class, 'index'])->name('wujud-perbuatan.index');
    Route::post('data-wujud-perbuatan/data', [WujudPerbuatanController::class, 'data'])->name('wujud-perbuatan.data');

    Route::get('input-data-wujud-perbuatan', [WujudPerbuatanController::class, 'inputWujudPerbuatan'])->name('wujud-perbuatan.input');
    Route::post('input-data-wujud-perbuatan/store', [WujudPerbuatanController::class, 'storeWujudPerbuatan'])->name('wujud-perbuatan.store.pangkat');

    Route::get('edit-data-wujud-perbuatan/{id}', [WujudPerbuatanController::class, 'editWujudPerbuatan'])->name('wujud-perbuatan.edit');
    Route::post('data-wujud-perbuatan/update', [WujudPerbuatanController::class, 'updateData'])->name('wujud-perbuatan.update');

    Route::get('data-wujud-perbuatan/hapus/{id}', [WujudPerbuatanController::class, 'hapusData'])->name('wujud-perbuatan.hapus');
    // End Wujud Perbuatan


    // Tambah Saksi
    Route::post('/tambah-saksi/{id}', [PulbaketController::class, 'tambahSaksi'])->name('tambah.saksi');

    // View Kasus
    Route::get('data-kasus/view/{kasus_id}/{id}', [KasusController::class, 'viewProcess'])->name('kasus.proses.view');
    Route::get('pulbaket/view/next-data/{id}', [PulbaketController::class, 'viewNextData'])->name('kasus.pulbaket.next');

    // End View Kasus

    //SPRIN
    Route::get('data-penyidik/{tim}', [AuditInvestigasiController::class, 'viewPenyidik']);
    Route::get('get-data-penyidik/{tim}', [TimelineController::class, 'viewPenyidik']);
    Route::get('get-data-pangkat', [AuditInvestigasiController::class, 'viewPangkat']);
    //END SPRIN

    //Store Time Line
    Route::post('/timeline/store', [TimelineController::class, 'store']);
    // Generate
    Route::post('/lembar-disposisi-kabag', [DiterimaController::class, 'generateDisposisiKabag']);
    Route::get('/lembar-disposisi-kabag/{id}', [DiterimaController::class, 'disposisiKabag']);
    Route::post('/lembar-disposisi-karo', [DiterimaController::class, 'generateDisposisiKaro']);
    Route::get('/lembar-disposisi-karo/{id}', [DiterimaController::class, 'disposisiKaro']);
    Route::post('/lembar-disposisi-sesro', [DiterimaController::class, 'generateDisposisiSesro']);
    Route::get('/lembar-disposisi-sesro/{id}', [DiterimaController::class, 'disposisiSesro']);
    // Route::get('/lembar-disposisi/{type}', [LimpahPoldaController::class, 'downloadDisposisi']);
    // Route::post('/surat-limpah-polda', [LimpahPoldaController::class, 'generateLimpahPolda']);
    Route::post('/surat-perintah/{id}', [AuditInvestigasiController::class, 'printSuratPerintah']);
    Route::post('/surat-undangan-wawancara', [AuditInvestigasiController::class, 'generateWawancara']);
    Route::get('/surat-undangan-wawancara/{id}', [AuditInvestigasiController::class, 'undanganWawancara']);
    Route::post('/laporan-hasil-audit', [AuditInvestigasiController::class, 'generateLaporanHasilAudit']);
    Route::get('/laporan-hasil-audit/{id}', [AuditInvestigasiController::class, 'laporanHasilAudit']);
    Route::post('/gelar-perkara-undangan', [GelarInvestigasiController::class, 'generateUndanganGelar']);
    Route::get('/gelar-perkara-undangan/{id}', [GelarInvestigasiController::class, 'undanganGelar']);
    Route::post('/laporan-gelar-perkara', [GelarInvestigasiController::class, 'generateLaporanGelar']);
    Route::get('/laporan-gelar-perkara/{id}', [GelarInvestigasiController::class, 'LaporanGelar']);
    Route::get('/nota-dinas-laporan/{id}', [GelarInvestigasiController::class, 'notaDinasLaporanGelarPerkara']);
    Route::get('/surat-nota-wawancara/{id}', [AuditInvestigasiController::class, 'notaWawancara']);
    Route::post('/surat-penghadapan', [AuditInvestigasiController::class, 'generateSuratPenghadapan']);
    Route::get('/surat-penghadapan/{id}', [AuditInvestigasiController::class, 'suratPenghadapan']);
    Route::post('/surat-limpah-polda', [LimpahPoldaController::class, 'generateLimpahPolda']);
    Route::get('/surat-limpah-polda/{id}', [LimpahPoldaController::class, 'limpahPolda']);
    Route::post('/administrasi-sidang', [PemberkasanController::class, 'generateAdmistrasiSidang']);
    Route::get('/administrasi-sidang/{id}', [PemberkasanController::class, 'AdmistrasiSidang']);
    Route::post('/nota-dinas-penyerahan', [PemberkasanController::class, 'generateNotaDinasPenyerahan']);
    Route::get('/nota-dinas-penyerahan/{id}', [PemberkasanController::class, 'notaDinasPenyerahan']);
    Route::post('/nota-dinas-perbaikan', [PemberkasanController::class, 'generateNotaDinasPerbaikan']);
    Route::get('/nota-dinas-perbaikan/{id}', [PemberkasanController::class, 'notaDinasPerbaikan']);
    Route::post('/permohonan-pendapat', [PemberkasanController::class, 'generatePermohonanPendapat']);
    Route::get('/permohonan-pendapat/{id}', [PemberkasanController::class, 'permohonanPendapat']);
    Route::post('/pembentukan-komisi', [SidangController::class, 'generatePembentukanKomisi']);
    Route::get('/pembentukan-komisi/{id}', [SidangController::class, 'pembentukanKomisi']);
    Route::get('/usulan-pembentukan-komisi/{id}', [SidangController::class, 'usulanPembentukanKomisi']);
    Route::get('/pendamping-divkum/{id}', [SidangController::class, 'pendampingDivkum']);
    Route::get('/panggilan-pelanggar/{id}', [SidangController::class, 'panggilanPelanggar']);
    Route::get('/panggilan-pelanggar-satker/{id}', [SidangController::class, 'panggilanPelanggarSatker']);
    Route::get('/panggilan-saksi-anggota/{id}', [SidangController::class, 'panggilanSaksiAnggota']);
    Route::get('/panggilan-saksi-sdm/{id}', [SidangController::class, 'panggilanSaksiSdm']);
    Route::get('/surat-daftar-nama-terlampir/{id}', [SidangController::class, 'suratDaftarNamaTerlampir']);
    Route::get('/putusan-sidang-kepp/{id}', [SidangController::class, 'putusanSidang']);
    Route::get('/pengiriman-putusan-sidang/{id}', [SidangController::class, 'pengirimanPutusanSidang']);
    Route::post('/bap', [SidikController::class, 'generateBap']);
    Route::get('/bap/{id}', [SidikController::class, 'bap']);
    Route::get('/lpa/{id}', [SidikController::class, 'lpa']);
    Route::get('/sprin/{id}', [SidikController::class, 'sprin']);


    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('user', [UserController::class, 'index']);
        Route::post('user/save', [UserController::class, 'store']);
        Route::get('role', [RoleController::class, 'index']);
        Route::get('role/permission/{id}', [RoleController::class, 'permission']);
        Route::get('role/permission/{id}/save', [RoleController::class, 'savePermission']);
    });
});
