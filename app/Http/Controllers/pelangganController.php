<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    public function pelanggan()
    {
        $pelanggan = new pelanggan();

        $data = pelanggan::paginate(10);

        $id_pelanggan = $pelanggan->all()->last();

        $id = $id_pelanggan->id_pelanggan;

        $no = substr($id, offset : 2);
        $no = intval($no) + 1;  

        switch(true) {
            case ($no < 10):
                $no = 'P-00'.$no;
                break;
            case ($no < 100):
                    $no = 'P-0'.$no;
                    break;
            default;
                $no = 'P-'.$no;
                break;
            }

        return view('pelanggan',[
            'pelanggan' => $data,
            'id_pelanggan' => $no
        ]);
    }

    public function simpan(Request $request)
    {
        Request()->validate([
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'no_telp_pelanggan' => 'required',
        ], [
                'nama_pelanggan.required' => 'Nama Pelanggan tidak boleh kosong',
                'alamat_pelanggan.required' => 'Alamat Pelanggan tidak boleh kosong',
                'no_telp_pelanggan.required' => 'No Telp Pelanggan tidak boleh kos'
        ]);

        $pelanggan = new pelanggan();

        $data = [
            'id_pelanggan' => $request->id_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            ];

        if ($pelanggan->create($request->all())) {
            return redirect()->route('pelanggan')->with('success', 'Data Berhasil Disimpan');
         } else {
            return redirect()->route('pelanggan')->with('error', 'Data Gagal Disimpan');
         }

        
    }

    public function edit($id) {
        $pelanggan = pelanggan::all();
        $edit_pelanggan = $pelanggan->find($id);
        $data = $pelanggan->paginate(10);

        return view('pelanggan',[
            'pelanggan' => $data,
            'edit' => $edit_pelanggan
        ]);
    }
}
