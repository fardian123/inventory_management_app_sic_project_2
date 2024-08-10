<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Barang;
use Carbon\Carbon;


class SupervisorController extends Controller 
{
    public function supervisorDashboard(){
        $barang_keluar = (Barang::whereNotNull('tanggal_keluar')->count())- (Barang::where('tanggal_keluar','<=',Carbon::now())->count());
        $barang_menetap = Barang::whereNull('tanggal_keluar')->count();
        $total_barang = (Barang::get()->count()) - (Barang::where('tanggal_keluar','<=',Carbon::now())->count());
        $barang_out = Barang::where('tanggal_keluar','<=',Carbon::now())->count();
       
        return view('supervisor.supervisor_index',compact('barang_keluar','barang_menetap','total_barang','barang_out'));
    }

    public function supervisorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function supervisorProfile()
    {
        return view('supervisor.supervisor_profile');
    }

    public function supervisorProfileStore(Request $request)
    {
        
        $data = User::find(Auth::user()->id);
       
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();
        $notification = array(
            'message' => 'supervisor Profile Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function supervisorChangePassword(){
        $data = User::find(Auth::user()->id);
        return view('supervisor.supervisor_change_password',compact('data'));
    }


    public function supervisorPasswordUpdate(Request $request){
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


    // supervisor barang management


}
