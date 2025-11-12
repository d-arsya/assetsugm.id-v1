<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ColorPallete;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class dataMahasiswaController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $dataMahasiswa = Mahasiswa::latest()->paginate(500);
        return view('admin.dataMahasiswa', compact('dataMahasiswa', 'admin'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'namaMahasiswa' => 'required',
                'fotoMhs' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:100',
            ],
            // Error message:
            [
                'fotoMhs.image' => 'File harus berupa gambar.',
                'fotoMhs.mimes' => 'Gambar harus berformat jpg, jpeg, svg, atau png.',
                'fotoMhs.max' => 'Gambar maximal 100KB.',
            ]
        );

        // Jika validasi berhasil, simpan data mahasiswa
        $data = [
            'nama_mhs' => $validatedData['namaMahasiswa'],
        ];

        if ($request->hasFile('fotoMhs')) {
            $file = $request->file('fotoMhs');
            $path = $file->store('datamahasiswa', 'public');
            $data['foto_profil_mhs'] = basename($path);
        }

        Mahasiswa::create($data);

        return redirect()->route('admin.datamahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }



    public function update(Request $request, string $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($mahasiswa);
        $request->validate(
            [
                'namaMhs' => 'nullable',
                'fotoMhs' => 'nullable|image|mimes:jpeg,png,jpg,svg',
            ],
            // Error message:
            [
                'fotoMhs.image' => 'File harus berupa gambar.',
                'fotoMhs.mimes' => 'Gambar harus berformat jpg, jpeg, svg, atau png.',
            ]
        );

        // Cek jika nama baru berbeda dari yang ada di database
        if ($request->namaMhs !== $mahasiswa->nama_mhs) {
            $mahasiswa->nama_mhs = $request->namaMhs;
        }

        // Cek jika ada upload foto baru
        if ($request->hasFile('fotoMhsEdit')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto_profil_mhs) {
                Storage::disk('public')->delete('datamahasiswa/' . $mahasiswa->foto_profil_mhs);
            }


            // Simpan foto baru
            $file = $request->file('fotoMhsEdit');
            $path = Storage::disk('public')->put('datamahasiswa', $file);
            $mahasiswa->foto_profil_mhs = basename($path);
        }

        // Simpan perubahan hanya jika ada perubahan data
        if ($mahasiswa->isDirty()) {
            $mahasiswa->save();
            Staff::where('id_mhs', $mahasiswa->id_mhs)
                ->update(['foto_pose_staff' => $mahasiswa->foto_profil_mhs]);

            return redirect()->route('admin.datamahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
        }

        return redirect()->route('admin.datamahasiswa.index')->with('info', 'Tidak ada perubahan pada data mahasiswa.');
    }


    public function destroy(string $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($mahasiswa);
        if ($mahasiswa->foto_profil_mhs) {
            Storage::disk('public')->delete('datamahasiswa/' . $mahasiswa->foto_profil_mhs);
        }

        $mahasiswa->delete();

        return redirect()->route('admin.datamahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
