<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function adminDashboard()
    {
        $barang_keluar = (Barang::whereNotNull('tanggal_keluar')->count())- (Barang::where('tanggal_keluar','<=',Carbon::now())->count());
        $barang_menetap = Barang::whereNull('tanggal_keluar')->count();
        $total_barang = (Barang::get()->count()) - (Barang::where('tanggal_keluar','<=',Carbon::now())->count());
        $barang_out = Barang::where('tanggal_keluar','<=',Carbon::now())->count();
        return view('admin.admin_index',compact('barang_keluar','barang_menetap','total_barang','barang_out'));
    }
    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function adminProfile()
    {
        return view('admin.admin_profile');
    }

    public function adminProfileStore(Request $request)
    {
        
        $data = User::find(Auth::user()->id);
       
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();
        $notification = array(
            'message' => 'admin Profile Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function adminChangePassword()
    {
        $profileData = User::find(Auth::user()->id);

        return view('admin.admin_change_password', compact('profileData'));
    }

    public function adminPasswordUpdate(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed|',

        ]);
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old password Doesnt match',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // update new password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Succes',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

   

   




}
