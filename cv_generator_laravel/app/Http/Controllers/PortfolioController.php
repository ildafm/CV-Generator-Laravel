<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\ProjectUser;
use App\Models\ServiceUser;
use App\Models\SkillUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PortfolioController extends Controller
{

    private $active_page, $title_page;

    public function __construct()
    {
        $this->active_page = 'portfolio';
        $this->title_page = 'Portfolio';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $detail_user = DetailUser::where('user_id', $user->id)->first();

        if (isset($detail_user)) {
            return redirect()->route('portfolio_show', [
                'id_detail_user' => $detail_user->id,
                'name_user' => Str::slug($user->name),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $detail_user = DetailUser::where('user_id', $user->id)->first();

        if (isset($detail_user)) {
            return redirect()->route('portfolio_show', [
                'id_detail_user' => $detail_user->id,
                'name_user' => Str::slug($user->name),
            ]);
        }

        return view('portfolio.create')
            ->with('active_page', 'create_portfolio')
            ->with('user', $user)
            ->with('title_page', $this->title_page);
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
        try {
            $validateData = $request->validate([
                'phone' => 'required|numeric|digits_between:12,20',
                'about_me' => 'required|max:800|string',
                'address' => 'required|max:255|string',
                'role' => 'required|max:255|string',
                'abilities_1' => 'required|max:100|string',
                'abilities_2' => 'max:100|string',
                'abilities_3' => 'max:100|string',
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

            $abilities = $validateData['abilities_1'];

            if (isset($validateData['abilities_2'])) {
                $abilities .= '&&' . $validateData['abilities_2'];
            }

            if (isset($validateData['abilities_3'])) {
                $abilities .= '&&' . $validateData['abilities_3'];
            }

            $portfolio = new DetailUser();

            $portfolio->user_id = Auth::user()->id;
            $portfolio->about_me = $validateData['about_me'];
            $portfolio->address = $validateData['address'];
            $portfolio->role = $validateData['role'];
            $portfolio->abilities = $abilities;
            $portfolio->about_me = $validateData['about_me'];
            $portfolio->phone = $validateData['phone'];
            if (isset($validateData['instagram_url'])) {
                $portfolio->instagram_url = $validateData['instagram_url'];
            }
            if (isset($validateData['facebook_url'])) {
                $portfolio->facebook_url = $validateData['facebook_url'];
            }
            if (isset($validateData['twitter_url'])) {
                $portfolio->twitter_url = $validateData['twitter_url'];
            }
            if (isset($validateData['linkedin_url'])) {
                $portfolio->linked_in_url = $validateData['linkedin_url'];
            }

            $portfolio->save();

            $getPortfolio = DetailUser::where('user_id', Auth::user()->id)->first();
            return redirect()->route('portfolios.show', $getPortfolio->id);
        }
        // Jika terjadi kesalahan validasi, tambahkan pesan error
        catch (ValidationException $e) {
            $request->session()->flash('pesan_error', 'Something is wrong, please try again');
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        }
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
        $user = User::findOrFail(Auth::user()->id);
        $detail_user = DetailUser::where('user_id', $user->id)->first();

        if (isset($detail_user)) {
            return redirect()->route('portfolio_show', [
                'id_detail_user' => $detail_user->id,
                'name_user' => Str::slug($user->name),
            ]);
        }
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
        $user = User::findOrFail(Auth::user()->id);
        $detail_user = DetailUser::where('user_id', $user->id)->first();

        if (isset($detail_user)) {
            return redirect()->route('portfolio_show', [
                'id_detail_user' => $detail_user->id,
                'name_user' => Str::slug($user->name),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $detail_user = DetailUser::where('user_id', $user->id)->first();

        if (isset($detail_user)) {
            return redirect()->route('portfolio_show', [
                'id_detail_user' => $detail_user->id,
                'name_user' => Str::slug($user->name),
            ]);
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
        $user = User::findOrFail(Auth::user()->id);
        $detail_user = DetailUser::where('user_id', $user->id)->first();

        if (isset($detail_user)) {
            return redirect()->route('portfolio_show', [
                'id_detail_user' => $detail_user->id,
                'name_user' => Str::slug($user->name),
            ]);
        }
    }

    public function portfolio($id_detail_user, $name_user)
    {
        $detail_user = DetailUser::findOrFail($id_detail_user);
        $user = User::where('id', $detail_user->user_id)->first();
        $skills = SkillUser::where('detail_user_id', $id_detail_user)->get();
        $services = ServiceUser::where('detail_user_id', $id_detail_user)->get();
        $projects = ProjectUser::where('detail_user_id', $id_detail_user)->get();

        return view('portfolio.show')
            ->with('user', $user)
            ->with('skills', $skills)
            ->with('services', $services)
            ->with('projects', $projects)
            ->with('detail_user', $detail_user);
    }
}
