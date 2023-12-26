<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\PortfolioUser;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $active_page, $title_page;
    public function __construct()
    {
        $active_page = 'user';
        $title_page = 'User';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if ($request->name && $request->about_me) {
            // jika sudah membuat halaman portofolio
            echo "advance edit";
        } else if ($request->name) {
            try {
                $validateData = $request->validate([
                    'name' => 'string|required|max:255',
                ]);

                $user->update([
                    'name' => $validateData['name'],
                ]);

                $request->session()->flash('pesan_success', 'Your data has been successfully changed');
                return redirect()->back();
            }
            // Jika terjadi kesalahan validasi, tambahkan pesan error
            catch (ValidationException $e) {
                $request->session()->flash('pesan_error', 'Something is wrong, please try again');
                return redirect()->back()->withErrors($e->validator->errors());
            }
        } else if ($request->password) {
            echo "password_update";
        } else {
            $request->session()->flash('pesan_error', 'Something is wrong, please try again');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile(User $user)
    {
        //
        $active_page = 'profile';
        $title_page = 'Profile';

        $detail_user = DetailUser::where('user_id', $user->id)->first();

        return view("user.profile")
            ->with('active_page', $active_page)
            ->with('title_page', $title_page)
            ->with('user', $user)
            ->with('detail_user', $detail_user);
    }
}
