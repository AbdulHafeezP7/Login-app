<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users');
    }
    public function dataTablesForUsers()
    {

        $query = User::query();
        return DataTables::of($query)
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i:s');
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->filterColumn('email', function ($query, $keyword) {
                $query->where('email', 'like', "%{$keyword}%");
            })
            ->make(true);
    }
    public function addUsers()
    {
        return view('backend.usersAdd');
    }
    public function store(UserRequest $request)
    {
        try {
            $totalUsers = User::count();
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['status' => true, 'message' => 'User created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function edit($id)
    {
        $user = User::find($id);

        return view('backend.user-edit', compact('user', 'id'));
    }
    public function update(UserUpdateRequest $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'User updated successfully.']);
            } else {
                return redirect()->route('users.index')->with('success', 'User updated successfully.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->validator->errors()->first()], 422);
            } else {
                return back()->with('error', $e->validator->errors()->first());
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
            } else {
                return back()->with('error', $e->getMessage());
            }
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => true, 'message' => 'User deleted successfully']);
    }
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return view('backend.user-show', compact('user'));
    }
    public function showPasswordResetForm($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user-passwordreset', compact('user'));
    }

    // Handle the password reset
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Password reset successfully!');
    }
}
