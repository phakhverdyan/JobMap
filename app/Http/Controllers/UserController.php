<?php

namespace App\Http\Controllers;

use App\Http\GraphQLClient;
use App\Http\Requests\LandingSignupAcademyRequest;
use App\Http\Requests\LandingSignupRequest;
use App\User;
use App\User\Resume\Reference;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

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
     * @param LandingSignupRequest $request
     * @return string
     */
    public function landingFormAcademy(LandingSignupAcademyRequest $request)
    {
        $type = explode('/',$request->path())[1];
        return json_encode(['url' => route('landing.'.$type.'.signup')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signup(Request $request)
    {
        Log::info($request->all());
        $userName = $request->input('username') ?? false;
        if (!$userName) {
            $firstName = $request->input('first_name') ?? "";
            $lastName = $request->input('last_name') ?? "";
            $userName = strtolower($firstName . $lastName);
        }
        $inputData = $request->input();
        $inputData['username'] = $userName;

        return view('common.signup', [
            'data' => $inputData,
        ]);
    }

    public function signupAcademy(Request $request)
    {
        $type = explode('/',$request->path())[0];
        $userName = $request->input('username') ?? false;
        if (!$userName) {
            $firstName = $request->input('first_name') ?? "";
            $lastName = $request->input('last_name') ?? "";
            $userName = strtolower($firstName . $lastName);
        }
        $inputData = $request->input();
        $inputData['username'] = $userName;

        return view('common.academy.'.$type, [
            'data' => $inputData,
            'no_signup_js' => 1,
        ]);
    }

    public function changePassword (Request $request)
    {
        //dd($request->all());
        if (!isset($request->rt)) {
            abort(404);
        }
        $user = User::where('remember_token',$request->rt)->firstOrFail();

        return view('common.change_password', [
            'user' => $user,
        ]);
    }

    public function publicProfile ($username)
    {

        $user = User::where('username', $username)->firstOrFail();

        $data = $this->buildDataForProfileShow($user);

        //dd($data,$user);
        return view('user.public_profile', compact('data','user'));
    }

    protected function buildDataForProfileShow ($user)
    {
        $client = new GraphQLClient();
        $client->setParams("profile");
        $client->addRequest(['id' => $user->id]);
        if (!App::isLocale('en')) {
            $client->addRequest(['locale' => App::getLocale()]);
        }
        $client->addResponse([
            'preference{id, looking_job, current_type, current_job, interested_jobs, new_job, new_opportunities,
                distance, distance_type, industries, sub_industries, salary, hours_from,
                hours_to, is_complete, first_job, not_education, not_certification, not_distinction,industry{name},
                sub_industry{name}, category{name}, sub_category{name}}',
            'availability{full_time, part_time, internship, contractual, summer_positions, recruitment,
                field_placement, volunteer, time_1, time_2, time_3, time_4, is_complete}',
            'basic{headline, website, about, is_complete, facebook, instagram, linkedin, twitter }',
            'education{id, school_name, city, region, country, country_code, year_from, year_to, grade, current, degree,
                study, activities, description, achievement_title, achievement_description, html}',
            'experience{id, title, company, city, region, country, country_code, date_from, date_to, year_from, year_to,
                month_from, month_to, current, industry_id, industry{name}, sub_industry_id, sub_industry{name}, description, additional_info, html}',
            'reference{id, email, phone, full_name, company, html}',
            'skill{id, title, description, level, html}',
            'languages{id, title, level, html}',
            'certification{id,, title, type, year, html}',
            'distinction{id, title, year, html}',
            'hobby{id, title, description, html}',
            'interest{id, title, description, html}',
            'user_pic_options',
            //'is_complete',
            //'overview',
            //'token',
            'updated_at',
        ]);

        $data = (array)$client->request();

        //---build user info
        $picture = asset('img/profilepic2.png');
        if ($user->user_pic_custom == 1) {
            $picture = Storage::disk('user_resume')->url('/' . $user->id . '/200.200.') . $user->user_pic . '?v=' . rand(11111, 99999);
        }
        $street = $user->street ? $user->street . ", " : "";
        $city = $user->city . ", ";
        $region = $user->city ? $user->region . ", " : "";
        $country = $user->city ? $user->country : "";
        //$location = $street . $city . $region . $country;
        $location = $city . $region . $country;
        $data = array_merge($data, [
            'picture' => $picture,
            'location' => $location
        ]);

        switch ($data['preference']->current_type) {
            case 1:
                $current_type_name = trans('resume_builder.print.student');
                break;
            case 2:
                $current_type_name = trans('resume_builder.print.professional');
                break;
            default:
                $current_type_name = '';
        }
        $data['preference']->current_type_name = $current_type_name;
        switch ($data['preference']->current_job) {
            case 1:
                $current_job_name = trans('resume_builder.print.employed');
                break;
            case 2:
                $current_job_name = trans('resume_builder.print.unemployed');
                break;
            default:
                $current_job_name = '';
        }
        //---preference info build
        $data['preference']->current_job_name = $current_job_name;
        $interested_jobs_name = '';
        foreach (explode(',',$data['preference']->interested_jobs) as $item) {
            if ($interested_jobs_name) {
                $interested_jobs_name .= ', ';
            }
            switch ($item) {
                case 1:
                    $interested_jobs_name .= trans('resume_builder.print.specialized');
                    break;
                case 2:
                    $interested_jobs_name .= trans('resume_builder.print.student');
                    break;
                case 3:
                    $interested_jobs_name .= trans('resume_builder.print.professional');
                    break;
                case 4:
                    $interested_jobs_name .= trans('resume_builder.print.specialized');
                    break;
                case 5:
                    $interested_jobs_name .= trans('resume_builder.print.freelance');
                    break;
            }
        }
        $data['preference']->interested_jobs_name = $interested_jobs_name;

        return $data;
    }

    public function sendReference (Request $request)
    {
        //dd($request->all());
        if (!isset($request->t)) {
            //abort(404);
            return redirect('/');
        }
        //$reference = Reference::where('remember_token',$request->t)->firstOrFail();
        $reference = Reference::with('user')->where('remember_token', $request->t)->first();

        if (!$reference) {
            return redirect('/');
        }

        if (!$reference->clicked) {
            $reference->clicked = true;
            $reference->count_of_sent_mails = 0;
            $reference->save();
        }

        $user = $reference->user;
        $picture = asset('img/profilepic2.png');

        if ($user->user_pic_custom == 1) {
            $picture = Storage::disk('user_resume')->url('/' . $user->id . '/200.200.') . $user->user_pic . '?v=' . rand(11111, 99999);
        }

        $street = $user->street ? $user->street . "," : "";
        $city = $user->city . ",";
        $region = $user->city ? $user->region . "," : "";
        $country = $user->city ? $user->country : "";
        $location = $street . $city . $region . $country;

        $your_date = $reference->created_at->timestamp;
        $datediff = time() - $your_date;
        $days = round($datediff / (60*60*24));

        $dt = Carbon::now();
        $date = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();

        return view('user.send_reference', [
            'reference' => $reference,
            'user' => $user,
            'picture' => $picture,
            'location' => $location,
            'date' => $date,
        ]);
    }

    public function verificationCode(Request $request)
    {
        if (!isset($request->vc)) {
            abort(404);
        }

        $user = User::where('verification_code', $request->vc)->first();

        if (!$user) {
            abort(404);
        }

        $user->verification_code = null;
        $user->verification_date = null;
        $user->save();
        Mail::to($user->email)->queue(new \App\Mail\VerificationUser($user, $user->language_prefix, 'CONFIRMED'));

        if ($request->cookie('api-token')) {
            $request->session()->put('verification', 'update');
        }
        else {
            $request->session()->put('verification', 'message');
            $token = JWTAuth::fromUser($user);
            header("Set-Cookie: api-token=" . $token . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
        }

        return redirect()->route('user.dashboard');
    }

    public function getSessionValue(Request $request)
    {
        $data = [
            'success' => false,
            'value' => $request->session_name,
        ];

        if ($request->session()->has($request->session_name)) {
            $data = [
                'success' => true,
                'value' => $request->session()->pull($request->session_name),
            ];
        }

        return $data;
    }

    public function pdfPrintPreview(Request $request)
    {
        if ($request->cookie('language')) {
            App::setLocale($request->cookie('language'));
        }

//dd(1,$request->cookie('language'),App::getLocale());
        $user = Auth::user();
        $data = $this->buildDataForProfileShow($user);
//dd($data);
        $data_new = [];
        $data_new['updated_at'] = $data['updated_at'];
        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
                foreach ($data[$key] as $item) {
                    if (in_array($item->id,array_keys($value))) {
                        $data_new[$key][] = $item;
                    }
                }
            } else {
                switch ($key) {
                    case 'headline':
                        $data_new[$key] = $data['basic']->headline;
                        break;
                    case 'website':
                        $data_new[$key] = $data['basic']->website;
                        break;
                    case 'about':
                        $data_new[$key] = $data['basic']->about;
                        $style = ' line-height: 1.4;';
                        if (strlen($data_new[$key]) > 1000) {
                            $style = ' line-height: 1.4; font-size: 15px';
                        }
                        if (strlen($data_new[$key]) > 1500) {
                            $style = ' line-height: 1.4; font-size: 15px';
                            $data_new[$key] = substr($data_new[$key],0,1497) . '...';
                        }
                        $data_new['style'] = $style;
                        break;
                    case 'availability':
                        $data_new[$key] = $data[$key];
                        break;
                    case 'availabilities':
                        $data_new[$key] = $data['availability'];
                        break;
                    case 'phone':
                        $data_new[$key] = $user->mobile_phone;
                        break;
                    case 'email':
                        $data_new[$key] = $user->email;
                        break;
                    case 'facebook':
                    case 'instagram':
                    case 'linkedin':
                    case 'twitter':
                        $data_new[$key] = $data['basic']->$key;
                        break;
                    default:
                        $data_new[$key] = $data[$key];
                        break;
                }
            }
        };
        $pdf = PDF::loadView('user.resume.printeble_resume_pdf', [
            'data' => $data_new,
            'user' => $user,
        ]);
        /*
        return view('user.resume.printeble_resume_pdf', [
            'data' => $data_new,
            'user' => $user,
        ]);
        */
        return $pdf->stream();
        //return $pdf->download('filepdf' . '.pdf');
    }

    public function referenceUser ($id, Request $request)
    {
        if (isset($request->r)) {
            $client = new GraphQLClient();
            $client->setParams("getUserForReference");
            $client->addRequest([
                'id' => (int)$id,
                'reference_id' => (int)$request->r
            ]);
            $client->addResponse([
                'id',
                'email',
                'username',
                'first_name',
                'last_name',
                'user_pic(origin: true)',
                'user_pic_options(width: 200, height: 200)',
                'user_pic_options_md(width: 100, height: 100)',
                'user_pic_options_sm(width: 50, height: 50)',
                'user_pic_filter',
                'reference{id, email, phone, full_name}',
            ]);
            $data = $client->request();

            if (!$data) { return abort(404); }

            return view('common.reference_user',[
                'data' => $data ]);
        }

        return abort(404);
    }

    public function confirmNewEmail(Request $request) {
        if (!$request->input('code')) {
            abort(404);
        }

        $user = Auth::user();

        if (!$user_confirming_email = \App\User::where('new_email_confirmation_code', $request->input('code'))->first()) {
            abort(404);
        }

        if ($user->id != $user_confirming_email->id) {
            abort(403);
        }

        $previous_user_email = $user_confirming_email->email;
        $user_confirming_email->email = $user_confirming_email->new_email;
        $user_confirming_email->new_email = null;
        $user_confirming_email->new_email_confirmation_code = null;
        $user_confirming_email->remember_token = null;
        $user_confirming_email->save();

        //$token = JWTAuth::fromUser($user_confirming_email);
       // Cookie::queue('api-token', $token, 129600, '/', env('SESSION_DOMAIN', 'www.jobmap.co'));

        Mail::to($user->email)->queue(new \App\Mail\UserChangeEmail($user, 'CONFIRMATION', auth()->user()->language_prefix));

        Auth::logout();
        Cookie::queue('api-token', "", 0, '/', env('SESSION_DOMAIN', 'www.jobmap.co'));

        return view('user.email_successfully_confirmed', [
            'previous_user_email' => $previous_user_email,
            'current_user_email' => $user_confirming_email->email,
        ]);
    }

    public function confirmNewPassword(Request $request) {
        if (!$request->input('code')) {
            abort(404);
        }

        $user = Auth::user();

        if (!$user_confirming_password = \App\User::where('new_password_confirmation_code', $request->input('code'))->first()) {
            abort(404);
        }

        if ($user->id != $user_confirming_password->id) {
            abort(403);
        }

        $user_confirming_password->password = $user_confirming_password->new_password;
        $user_confirming_password->new_password = null;
        $user_confirming_password->new_password_confirmation_code = null;
        $user_confirming_password->remember_token = null;
        $user_confirming_password->save();

        Mail::to($user->email)->queue(new \App\Mail\UserChangePassword($user, 'CONFIRMATION', auth()->user()->language_prefix));

        return view('user.password_successfully_confirmed');
    }

    public function downloadPdfPrintPreview(Request $request, $username)
    {
        $language = 'en';
        if (isset($request->lang)) {
            $language = $request->lang;
        }
        if (!$user = User::where('username', $username)->first()) {
            echo 'No user with username = ' . $username;
            return;
        };
        App::setLocale($language);
        $data = $this->buildDataForProfileShow($user);
        $data['updated_at'] = $data['updated_at'];

        $data['headline'] = $data['basic']->headline;
        $data['website'] = $data['basic']->website;
        $data['about'] = $data['basic']->about;
        $style = ' line-height: 1.4;';
        if (strlen($data['about']) > 1000) {
            $style = ' line-height: 1.4; font-size: 15px';
        }
        if (strlen($data['about']) > 1500) {
            $style = ' line-height: 1.4; font-size: 15px';
            $data['about'] = substr($data['about'],0,1497) . '...';
        }
        $data['style'] = $style;
        $data['availability'] = $data['availability'];
        $data['availabilities'] = $data['availability'];
        $data['phone'] = $user->mobile_phone;
        $data['email'] = $user->email;
        $data['facebook'] = $data['basic']->facebook;
        $data['instagram'] = $data['basic']->instagram;
        $data['linkedin'] = $data['basic']->linkedin;
        $data['twitter'] = $data['basic']->twitter;

        $pdf = PDF::loadView('user.resume.printeble_resume_pdf', [
            'data' => $data,
            'user' => $user,
        ]);

        /*return view('user.resume.printeble_resume_pdf', [
            'data' => $data,
            'user' => $user,
        ]);*/

        //return $pdf->stream();
        return $pdf->download($username . '.pdf');
    }

    public function test_run ()
    {
        $data = [];



        dd($data);
    }

}
