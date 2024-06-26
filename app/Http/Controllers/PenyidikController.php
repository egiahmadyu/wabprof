<?php

namespace App\Http\Controllers;

use App\Models\Penyidik;
use App\Models\Pangkat;
use App\Models\DataPelanggar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class PenyidikController extends Controller
{
    public function index()
    {
        $data['penyidiks'] = Penyidik::get();
        return view('pages.data_penyidik.index', $data);
    }

    public function inputPenyidik()
    {
        $pangkat = Pangkat::get();
        $tim = ['A','B','C','D','E','F'];
        $data = [
            'pangkats' => $pangkat,
            'tims' => $tim,
        ];

        return view('pages.data_penyidik.input_penyidik.input',$data);
    }

    public function editPenyidik($id)
    {
        $pangkat = Pangkat::get();
        $penyidik = Penyidik::where('id', $id)->first();
        $tim = ['A','B','C','D','E','F'];
        $data = [
            'pangkats' => $pangkat,
            'penyidik' => $penyidik,
            'tims' => $tim,
        ];

        return view('pages.data_penyidik.input_penyidik.input',$data);
    }

    public function storePenyidik(Request $request)
    {
        $DP = Penyidik::create([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'id_pangkat' => $request->id_pangkat,
            'jabatan' => $request->jabatan,
            'tim' => $request->tim,
            'unit' => $request->unit,
            'kesatuan' => $request->kesatuan,
            'fungsional' => $request->fungsional,
        ]);
        
        return redirect()->action([PenyidikController::class, 'index']);
    }

    public function data(Request $request)
    {
        $query = Penyidik::select('*')->orderBy('id','desc')->with('pangkat')->get();

        return Datatables::of($query)->addColumn('action', function ($row) {
            return '<a href="' . route('penyidik.edit', [$row->id]) . '" class="btn btn-info btn-circle"
                  data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    
                  <button type="button" onclick="hapus('.$row->id.')" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-user-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></button>';
        })->make(true);
    }

    public function updateData(Request $request)
    {
        $data_penyidik = Penyidik::where('id', $request->id)->first();
        $data_penyidik->update([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'id_pangkat' => $request->id_pangkat,
            'jabatan' => $request->jabatan,
            'tim' => $request->tim,
            'unit' => $request->unit,
            'kesatuan' => $request->kesatuan,
            'fungsional' => $request->fungsional,
        ]);

        return redirect()->action([PenyidikController::class, 'index']);

    }

    public function hapusData($id)
    {
      Penyidik::where('id', $id)
            ->delete();
    }
}