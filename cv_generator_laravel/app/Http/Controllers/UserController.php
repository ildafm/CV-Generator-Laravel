<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\PortfolioUser;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            try {
                $validateData = $request->validate([
                    'name' => 'string|required|max:255',
                    'phone' => 'required|numeric|digits_between:12,20',
                    'about_me' => 'required|max:800|string',
                    'address' => 'required|max:255|string',
                    'role' => 'required|max:255|string',
                    // 'abilities_1' => 'required|max:100|string',
                    // 'abilities_2' => 'max:100|string',
                    // 'abilities_3' => 'max:100|string',
                    'instagram_url' => 'max:255|string|regex:/https:\/\/www\.instagram\.com\//',
                    'facebook_url' => 'max:255|string|regex:/https:\/\/www\.facebook\.com\//',
                    'twitter_url' => 'max:255|string|regex:/https:\/\/www\.x\.com\//|regex:/https:\/\/www\.twitter\.com\//',
                    'linkedin_url' => 'max:255|string|regex:/https:\/\/www\.linkedin\.com\/in\//',
                ], [
                    'instagram_url.regex' => 'The :attribute must contain the phrase "https://www.instagram.com/".',
                    'facebook_url.regex' => 'The :attribute must contain the phrase "https://www.facebook.com/".',
                    'twitter_url.regex' => 'The :attribute must contain the phrase "https://www.x.com/" or "https://www.twitter.com/".',
                    'linkedin_url.regex' => 'The :attribute must contain the phrase "https://www.linkedin.com/in/".',
                ]);

                // $abilities = $validateData['abilities_1'];

                // if (isset($validateData['abilities_2'])) {
                //     $abilities .= '&&' . $validateData['abilities_2'];
                // }

                // if (isset($validateData['abilities_3'])) {
                //     $abilities .= '&&' . $validateData['abilities_3'];
                // }

                $detail_user = DetailUser::where('user_id', $user->id);

                $user->update([
                    'name' => $validateData['name'],
                    // 'abilitiies' => $abilities,
                ]);

                $detail_user->update([
                    'phone' => $validateData['phone'],
                    'about_me' => $validateData['about_me'],
                    'address' => $validateData['address'],
                    'role' => $validateData['role'],
                    // 'abilitiies' => $abilities,
                ]);

                if (isset($validateData['instagram_url'])) {
                    $detail_user->update([
                        'instagram_url' => $validateData['instagram_url'],
                    ]);
                }

                if (isset($validateData['facebook_url'])) {
                    $detail_user->update([
                        'facebook_url' => $validateData['facebook_url'],
                    ]);
                }
                if (isset($validateData['twitter_url'])) {
                    $detail_user->update([
                        'twitter_url' => $validateData['twitter_url'],
                    ]);
                }
                if (isset($validateData['linkedin_url'])) {
                    $detail_user->update([
                        'linkedin_url' => $validateData['linkedin_url'],
                    ]);
                }

                $request->session()->flash('pesan_success', 'Your datas has been successfully changed');
                return redirect()->back();
            }
            // Jika terjadi kesalahan validasi, tambahkan pesan error
            catch (ValidationException $e) {
                $request->session()->flash('pesan_error', 'Something is wrong, please try again');
                return redirect()->back()->withInput()->withErrors($e->validator->errors());
            }
        } else if ($request->name) {
            try {
                $validateData = $request->validate([
                    'name' => 'string|required|max:255',
                ]);

                $user->update([
                    'name' => $validateData['name'],
                ]);

                $request->session()->flash('pesan_success', 'Your data name has been successfully changed');
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
