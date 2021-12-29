<?php

namespace App\Http\Controllers;

use Cache;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index() {
        
        $user = $this->getUserCount(['user', 'admin']);
        $admin = $this->getUserCount(['admin']);
        $lastSeen = $this->lastSeen();
        $onlineUser = $this->countOnlineUser();
        $suspended = $this->getSuspendedUser();


        return view('admin.main', compact('user', 'lastSeen', 'onlineUser', 'admin', 'suspended'));

    }
    protected function getUserCount( $array ) {
        
        return User::whereRoleIs( $array) 
                    ->count();

    }

    protected function lastSeen() {

        return User::select('*')
                    ->whereNotNull('last_seen')
                    ->orderBy('last_seen', 'DESC')
                    ->count();
    }

    protected function countOnlineUser() {

        $users = User::all();
        $count = 0;

        foreach($users as $user) {
            if($user->isOnline()) {
                $count++;
            }
        }

        return $count;


    }

    protected function userList() {

        $allUsers = User::whereRoleIs('user')->orderBy('last_seen', 'desc')->get();
        // $allUsers = DB::table('users')->orderBy('last_seen', 'desc')->get();
        return view('admin.table', compact('allUsers'));

    }

    public function show($id) {

        $profile = User::findOrFail($id);
        return view('admin.profile', compact('profile'));

    }

    public function pendingUser() {

        $users = DB::table('users')
                ->where('isApprove', '0')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.table2', compact('users'));

    }

    public function isBlock( $id, $status ) {

        $user = DB::table('users')
                ->select('isBlock')
                ->where('id', $id)
                ->update(['isBlock' => $status]);

        if( $user ) {

            return redirect()
                    ->route('userList')
                    ->with('message', 'User Status update successfully.');
        }
        else {
            return redirect()
            ->route('userList')
            ->with('message', 'User failed to update.');
        }

      

    }

    public function isBlockFromProfile( $id, $status ) {

        $user = DB::table('users')
                ->select('isBlock')
                ->where('id', $id)
                ->update(['isBlock' => $status]);

        if( $user ) {
            return redirect()
                    ->route('profile', $id)
                    ->with('message', 'User has been updated!');
            }
            return redirect()
                    ->route('profile', $id)
                    ->with('message', 'User failed to update.');

    }

    public function isApprove( $id, $status ) {

        $user = DB::table('users')
                    ->select('isApprove')
                    ->where('id', $id)
                    ->update(['isApprove' => $status]);

        if( $user ) {
            return redirect()
                    ->route('pendingUser')
                    ->with('message', 'User Status update successfully.');
        }
        return redirect()
                    ->route('pendingUser')
                    ->with('message', 'User Status update successfully.');
    }
    
    public function getSuspendedUser() {

        $user = DB::table('users')
                ->select('*')
                ->where('isBlock', '1')
                ->count();

        return $user;

    }

    public function update(Request $request, $id) {

        $user = DB::table('users')
                    ->select('*')
                    ->where('id', $id)
                    ->update(
                        [
                            'name' => $request->input('name'),
                            'address' => $request->input('address'),
                            'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                        ]
                    );
        if($user) {
            return redirect()
                    ->route('profile', $id)
                    ->with('message', 'Update successfully');
        }
    }
}
