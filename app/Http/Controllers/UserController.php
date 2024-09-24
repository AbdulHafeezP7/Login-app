<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserPasswordResetRequest;
use Illuminate\Support\Facades\Hash;

// Controller For User
class UserController extends Controller
{
    // View User Index
    public function index()
    {
        return view('backend.users');
    }
    // Datatable For User
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
    // Add User
    public function addUsers()
    {
        return view('backend.usersAdd');
    }
    // Store User
    public function store(UserRequest $request)
    {
        try {
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
    // Edit User
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.user-edit', compact('user', 'id'));
    }
    // Update User
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
    // Delete User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => true, 'message' => 'User deleted successfully']);
    }
    // View User
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return view('backend.user-show', compact('user'));
    }
    // View User Passwordreset
    public function showPasswordResetForm($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user-passwordreset', compact('user'));
    }
    // Passwordreset Function For User
    public function resetPassword(UserPasswordResetRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Password reset successfully!']);
            } else {
                return redirect()->route('users.index')->with('success', 'Password reset successfully!');
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
}
