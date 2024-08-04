<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Resi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;


class BarangController extends Controller
{


    public function adminInventoryManagement(Request $request)
    {


        // Menginisialisasi query dengan kondisi awal
        $query = Barang::where(function ($query) {
            $query->where('tanggal_keluar', '>=', Carbon::now())
                ->orWhereNull('tanggal_keluar');
        });

        // Menambahkan kondisi pencarian jika parameter search ada
        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('nama_barang', 'LIKE', "%{$request->search}%")
                    ->orWhere('id', 'LIKE', "%{$request->search}%")
                    ->orWhere('pengirim', 'LIKE', "%{$request->search}%")
                    ->orWhere('penerima', 'LIKE', "%{$request->search}%");
            });
        }

        // Menambahkan kondisi filter jika parameter filter ada
        if ($request->filter) {
            if ($request->filter === 'unscheduled') {
                $query->whereNull('tanggal_keluar');
            } elseif ($request->filter === 'scheduled') {
                $query->whereNotNull('tanggal_keluar');
            }
        }

        // Mendapatkan hasil query dan mengurutkannya berdasarkan tanggal_masuk
        $barangs = $query->orderBy('tanggal_masuk', 'desc')->get();

        // Mengembalikan view dengan data barang
        return view('admin.admin_inventory_management', compact('barangs'));

    }

    public function adminInventoryHistory(Request $request)
    {
        $barangs = Barang::get()->where('tanggal_keluar', '<=', Carbon::now())->sortByDesc('tanggal_keluar');

        if ($request->search) {

            $barangs->where('nama_barang', 'LIKE', "%{$request->search}%")
                ->orWhere('id', 'LIKE', "%{$request->search}%")
                ->orWhere('pengirim', 'LIKE', "%{$request->search}%")
                ->orWhere('penerima', 'LIKE', "%{$request->search}%");
            return view('admin.admin_inventory_history', compact('barangs'));

        }
        return view('admin.admin_inventory_history', compact('barangs'));

    }

    public function adminBarangAdd(Request $request)
    {
        $tanggal_masuk = Carbon::now();


        try {
            // Validator instance
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required|string|max:100|regex:/^[a-zA-Z\s]*$/',
                'jumlah' => 'required|integer',
                'tanggal_keluar' => 'nullable|date|after:' . $tanggal_masuk,
                'pengirim' => 'required|string',
                'penerima' => 'required|string',
            ]);

            if (!$validator->fails()) {
                $barang = Barang::create([
                    'id' => Auth::user()->id . rand(100000, 999999),
                    'nama_barang' => $request->nama_barang,
                    'jumlah' => $request->jumlah,
                    'tanggal_masuk' => $tanggal_masuk,
                    'tanggal_keluar' => $request->tanggal_keluar,
                    'pengirim' => $request->pengirim,
                    'penerima' => $request->penerima,
                ]);

                Resi::create([
                    'nomor_resi' => 'RESI' . rand(100000, 999999),
                    'barang_id' => $barang->id,
                    'tanggal' => Carbon::today(),
                ]);

                return response()->json(['message' => 'Barang Berhasil Ditambahkan', 'alert-type' => 'success'], 200);
            } else {
                // Return error response if validation fails
                return response()->json(['errors' => $validator->errors()], 422);
            }


        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function adminBarangEdit(Request $request)
    {
        try {
            $barang = Barang::find($request->id);
            $tanggal_masuk = $barang->tanggal_masuk;
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required|string|max:100|regex:/^[a-zA-Z\s]*$/',
                'jumlah' => 'required|integer',
                'tanggal_keluar' => 'nullable|date|after:' . $tanggal_masuk,
                'pengirim' => 'required|string',
                'penerima' => 'required|string',
            ]);
            if (!$validator->fails()) {
                $barang->nama_barang = $request->nama_barang;
                $barang->jumlah = $request->jumlah;
                $barang->pengirim = $request->pengirim;
                $barang->penerima = $request->penerima;
                $barang->tanggal_keluar = $request->tanggal_keluar;
                $barang->save();
                return response()->json(['message' => 'Barang Berhasil Diperbarui', 'alert-type' => 'success'], 200);
            } else {
                // Return error response if validation fails
                return response()->json(['errors' => $validator->errors()], 422);
            }

        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'Something went wrong'], 500);
        }


    }

    public function adminBarangDelete(Request $request)
    {
        $barang = Barang::find($request->id);
        $barang->delete();
        $notification = array(
            'message' => 'Barang berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('admin/inventory/management')->with($notification);
    }

    public function adminBarangOutUpdate(Request $request)
    {
        $barang = Barang::find($request->id);
        $barang->tanggal_keluar = Carbon::now();
        $barang->save();
        $notification = array(
            'message' => 'Barang berhasil keluar',
            'alert-type' => 'success'
        );
        return redirect('admin/inventory/management')->with($notification);
    }

    public function supervisorInventoryManagement(Request $request)
    {

        $query = Barang::where(function ($query) {
            $query->where('tanggal_keluar', '>=', Carbon::now())
                ->orWhere('tanggal_keluar', '=', null);
        });

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('nama_barang', 'LIKE', "%{$request->search}%")
                    ->orWhere('id', 'LIKE', "%{$request->search}%")
                    ->orWhere('pengirim', 'LIKE', "%{$request->search}%")
                    ->orWhere('penerima', 'LIKE', "%{$request->search}%");
                $barangs = $query->orderBy('tanggal_keluar', 'desc')->get();
                return view('supervisor.supervisor_inventory_management', compact('barangs'));
            });
        }
        if ($request->filter) {
            if ($request->filter === 'unscheduled') {
                $query->whereNull('tanggal_keluar');
            } elseif ($request->filter === 'scheduled') {
                $query->whereNotNull('tanggal_keluar');
            }
        }


        $query_out = Barang::where(function($query_out){
            $query_out->where('tanggal_keluar', '<', Carbon::now())->get();
        });

        if ($request->search_out) {
            $query_out->where(function ($query_out) use ($request) {
                $query_out->where('nama_barang', 'LIKE', "%{$request->search_out}%")
                    ->orWhere('id', 'LIKE', "%{$request->search_out}%")
                    ->orWhere('pengirim', 'LIKE', "%{$request->search_out}%")
                    ->orWhere('penerima', 'LIKE', "%{$request->search_out}%");
                $barangsOut = $query_out->orderBy('tanggal_keluar', 'desc')->get();
                return view('supervisor.supervisor_inventory_management', compact('barangsOut'));
            });
        }






        $barangsOut = $query_out->get();
        $barangs = $query->get();
        return view('supervisor.supervisor_inventory_management', compact('barangs', 'barangsOut'));
    }

}


