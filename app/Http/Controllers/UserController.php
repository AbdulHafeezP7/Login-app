<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserPasswordResetRequest;
use Illuminate\Support\Facades\Hash;

// Controller for managing user-related actions
class UserController extends Controller
{
    /**
     * Display the user index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.users');
    }

    /**
     * Fetch user data for DataTables.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
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

    /**
     * Show the form for adding a new user.
     *
     * @return \Illuminate\View\View
     */
    public function addUsers()
    {
        return view('backend.usersAdd');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.user-edit', compact('user', 'id'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => true, 'message' => 'User deleted successfully']);
    }

    /**
     * Display the specified user.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('backend.user-show', compact('user'));
    }

    /**
     * Show the password reset form for the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showPasswordResetForm($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user-passwordreset', compact('user'));
    }

    /**
     * Reset the password for the specified user.
     *
     * @param UserPasswordResetRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
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
