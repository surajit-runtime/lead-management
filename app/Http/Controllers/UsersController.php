<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die();
        $validatedData = $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
          
            'role_id' => 'required',
            'zone_id' => 'nullable',
          
            'email' => 'required|email', // Email pattern validation
            
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/',
            'cpassword' => 'required|same:password', // Ensure cpassword is the same as password
           
            'profile_image' => 'image|mimes:jpg,jpeg,png|max:2048',
           
        ]);
        // dd($validatedData);
        
        try{

            //   $existingUser = SigninLogin::where('email', $validatedData['email'])->first();
              $existingUser = DB::table('tbl_users')->where('email', $validatedData['email'])->first();
            if (!$existingUser) {
               
               
                
                if ($request->hasFile('profile_image')) {
                    $imageName = time().'.'.$request->file('profile_image')->getClientOriginalExtension();
                    $request->file('profile_image')->move(public_path('images1'), $imageName);
                   
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'Image not uploaded to this path');
                }
                
                $ins_user = DB::table('tbl_users')->insert(['login_enable'=>1,
                'first_name'=>$validatedData['first_name'],
                'last_name'=>$validatedData['last_name'],
                
                'role_id'=>$validatedData['role_id'],
                'zone_id'=>isset($validatedData['zone_id'])?$validatedData['zone_id']:1,
                'status'=>1,
                'email'=>$validatedData['email'],
                'mobile'=>0,
                'password'=>Hash::make($validatedData['password']),
              
                'profile_image'=>$imageName]);
                
             
    
                return redirect()
                    ->back()
                    ->with('success', 'User is inserted');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'User is already existed');
            }

        }
        catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
        $user_details = DB::table('tbl_users')->where('id',$id)->first();
        $roles = DB::table('tbl_roles')->get();
        $zones = DB::table('tbl_callCenter')->get();
        $states = DB::table('tbl_state')->get();
       return view('frontend.edit_manage_page',['roles'=>$roles,'zones'=>$zones,'states'=>$states,'user_details'=>$user_details]);
        }
        catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validatedData = $request->validate([
        'first_name' => 'required|alpha',
        'last_name' => 'required|alpha',
       
        'role_id' => 'required',
        'zone_id' => 'nullable',
       
        'email' => 'required|email'
        
        
      
       
        
    ]);

    try {
        // Check if the user with the given ID exists
        $existingUser = DB::table('tbl_users')->where('id', $id)->first();

        if ($existingUser) {
            if ($request->hasFile('profile_image')) {
                    $validatedimg = $request->validate([
                    
                    'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

                ]);
                if ($existingUser->profile_image) {
                    Storage::delete('images1/' . $existingUser->profile_image);
                }

                $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
                $request->file('profile_image')->move(public_path('images1'), $imageName);
                // Update the user's profile image
                DB::table('tbl_users')
                    ->where('id', $id)
                    ->update(['profile_image' => $imageName]);
            }

            // Update the user's information
            $updateData = [
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
               
                'role_id' => $validatedData['role_id'],
                'zone_id'=>isset($validatedData['zone_id'])?$validatedData['zone_id']:1,
                'mobile'=>0,
                'email' => $validatedData['email'],
              
               
               
            ];
            
            // if (array_key_exists('login_enable', $validatedData)) {
            //     $updateData['login_enable'] = $validatedData['login_enable'];
            // }
            
           $userupdate = DB::table('tbl_users')
                ->where('id', $id)
                ->update($updateData);
                if($userupdate){
                    return redirect()->back()->with('success', 'User information has been updated');
                }else{ 
                    return redirect()
                    ->back()
                    ->with('error', 'User information is not updated');
                }
            
        } else {
            return redirect()
                ->back()
                ->with('error', 'User not found');
        }
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = DB::table('tbl_users')->where('id', $id)->delete();
    
            if ($deleted) {
                return redirect()
                    ->back()
                    ->with('success', 'User is deleted');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'User could not be deleted');
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
