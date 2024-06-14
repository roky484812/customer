<?php
namespace Roky\CustomerUpdate\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class CustomerUpdateController extends Controller{
    public function index(){
        $user = User::where('is_admin', false)->get();
        if(!$user)
            return response()->json([
                'status' => false,
               'message' => 'No user found.'
            ]);
        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'All user fetched successfully.'
        ]);
    }

    public function store(Request $req){
        $validated = $req->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required|min:6'
        ]);
        User::insert($validated);
        return response()->json([
            'status'=> true,
            'message'=> 'Successfuly created a new admin'
        ]);
    }

    public function update($id, Request $req){
        $validated = $req->validate([
            'name' => 'required|string',
            'email' =>'required|email',
            'password' => 'nullable|min:6'
        ]);
        $user = User::where(function($query) use ($id){
            $query->where('id', $id);
            $query->where('is_admin', 0);
        })->firstOrFail();
        $update = $user ? $user->update($validated): false;

        if (!$update)
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user.'
            ], 404);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.'
        ]);
    }
}
