<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandingSignupRequest;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * @param LandingSignupRequest $request
     * @return string
     */
    public function landingForm(LandingSignupRequest $request)
    {
        return json_encode(['url' => route('user.signup')]);
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signup(Request $request)
    {
        $userName = $request->input('username') ?? false;
        if (!$userName) {
            $firstName = $request->input('first_name') ?? "";
            $lastName = $request->input('last_name') ?? "";
            $userName = strtolower($firstName . $lastName);
        }
        $inputData = $request->input();
        $inputData['username'] = $userName;
        
        //if signup with social media
        if ($request->input('social')) {
            $inputData['first_name'] = session('social_signup_first_name');
            $inputData['last_name'] = session('social_signup_last_name');
            $inputData['email'] = session('social_signup_email');
            $inputData['gender'] = session('social_signup_gender');
            $inputData['birthdate'] = (session('social_signup_birthday')) ? strtotime(session('social_signup_birthday')) : null;
            $inputData['userpic'] = session('social_signup_userpic');
            $inputData['userpic_original'] = session('social_signup_userpic_original');
            $inputData['social'] = $request->input('social');
            $inputData['social_id'] = session('social_signup_social_id');
            $inputData['social_token'] = session('social_signup_token');
            $inputData['username'] = strtolower($inputData['first_name'] . $inputData['last_name']);
        }
        return view('common.jobmap.signup', [
            'data' => $inputData,
        ]);
    }
    
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        //clear social info
        session()->forget('social_signup_social_id');
        session()->forget('social_signup_email');
        session()->forget('social_signup_first_name');
        session()->forget('social_signup_last_name');
        session()->forget('social_signup_gender');
        session()->forget('social_signup_userpic');
        session()->forget('social_signup_token');
        session()->forget('social');
        session()->forget('social_signup_birthday');
        
        switch ($provider) {
            case 'facebook':
                $user = Socialite::driver($provider)->fields([
                    'name',
                    'first_name',
                    'last_name',
                    'email',
                    'gender',
                    'verified',
                    'birthday'
                ])->user();
                $data = $this->findUser($user['id']);
                if ($data) {
                    if (isset($data['token'])) {
                        $cookie = cookie()->make('jt', $data['token'], 129600, "/", null, null, false, false);
                        $param = (isset($data['b_id'])) ? '?b_id=' . $data['b_id'] : '';
                        return redirect(route($data['redirect']) . $param)->withCookie($cookie);
                    } else {
                        $param = '?i=' . $data['i'];
                        return redirect(route($data['redirect']) . $param);
                    }
                }
                
                $firstName = $user['first_name'] ?? "";
                $lastName = $user['last_name'] ?? "";
                $birthday = $user['birthday'] ?? "";
                $email = $user['email'] ?? "";
                session(['social_signup_birthday' => $birthday]);
                break;
            case 'google':
                $user = Socialite::driver($provider)->user();
                $data = $this->findUser($user['id']);
                if ($data) {
                    if (isset($data['token'])) {
                        $cookie = cookie()->make('jt', $data['token'], 129600, "/", null, null, false, false);
                        $param = (isset($data['b_id'])) ? '?b_id=' . $data['b_id'] : '';
                        return redirect(route($data['redirect']) . $param)->withCookie($cookie);
                    } else {
                        $param = '?i=' . $data['i'];
                        return redirect(route($data['redirect']) . $param);
                    }
                }
                $firstName = $user->user['name']['givenName'] ?? "";
                $lastName = $user->user['name']['familyName'] ?? "";
                $email = $user->email;
                break;
        }
        //save all social info to session
        session(['social_signup_social_id' => $user['id'] ?? ""]);
        session(['social_signup_email' => $email]);
        session(['social_signup_first_name' => $firstName]);
        session(['social_signup_last_name' => $lastName]);
        session(['social_signup_gender' => $user['gender'] ?? ""]);
        session(['social_signup_userpic' => $user->avatar ?? ""]);
        session(['social_signup_userpic_original' => $user->avatar_original ?? ""]);
        session(['social_signup_token' => $user->token]);
        session(['social' => $provider]);
        
        //redirect to signup page
        return redirect(route('user.signup', ['social' => $provider]));
    }
    
    protected function findUser($id)
    {
        $user = User::where('social_id', $id)->first();
        if ($user) {
            if ($user['invite_token'] != null) {
                return [
                    'redirect' => 'user.signup',
                    'i' => $user['invite_token']
                ];
            } else {
                $token = JWTAuth::fromUser($user);
                if ($token) {
                    if ($user['last_active_business']) {
                        return [
                            'redirect' => 'business.dashboard',
                            'token' => $token,
                            'b_id' => $user['last_active_business']
                        ];
                    } else if (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
                            && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
                        && !$user['attach_file']) {
                        return [
                            'redirect' => 'user.resume.create',
                            'token' => $token
                        ];
                    } else {
                        return [
                            'redirect' => 'user.dashboard',
                            'token' => $token
                        ];
                    }
                }
            }
        }

        return false;
    }
}
