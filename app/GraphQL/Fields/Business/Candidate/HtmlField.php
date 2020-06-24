<?php

namespace App\GraphQL\Fields\Business\Candidate;

use App\Business\Administrator;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\Candidate\Note;
use App\JobCategory;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HtmlField extends Field
{

    protected $attributes = [
        'description' => 'Business candidate'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [];
    }

    protected function resolve($root, $args)
    {
        if ($root['user']['user_pic']) {
            $userPicture = Storage::disk('user_resume')->url('/' . $root['user']['id'] . '/100.100.') . $root['user']['user_pic'] . '?v=' . rand(11111, 99999);
        } else {
            $userPicture = asset('img/profilepic2.png');
        }
        $lastBusiness = Administrator::where([
            'user_id' => $root['user_id']
        ])->orderBy('created_at', 'desc')->limit(1)->first();

        $picture = false;
        if ($lastBusiness) {
            if ($lastBusiness['business']['picture']) {
                $picture = Storage::disk('business')->url('/' . $lastBusiness['business']['id'] . '/50.50.') . $lastBusiness['business']['picture'] . '?v=' . rand(11111, 99999);
            } else {
                $picture = asset('img/business-logo-small.png');
            }
        }

        $location = $root['business']['name'];
        if ($root['location_id']) {
            $location = $root['location']['name'];
        }

        // Applied to array
        $appliedTo = [];

        // Brand
        $appliedTo[] = $root['business']['name'];

        // Location
        if ($root['location_id']) {
            $address = [];

            if (isset($root['location']['street'])) {
                $street = $root['location']['street'];

                if (isset($root['location']['street_number'])) {
                    $street = $root['location']['street_number'] . ' ' . $street;
                }
                $address[] = $street;
            }
            if (isset($root['location']['city'])) {
                $address[] = $root['location']['street'];
            }
            if (isset($root['location']['region'])) {
                $address[] = $root['location']['region'];
            }
            if (isset($root['location']['country'])) {
                $address[] = $root['location']['country'];
            }
            $appliedTo[] = implode($address, ', ');
        }

        // Job
        $job = trans('fields.general_headquarter');
        if ($root['job_id']) {
            $job = $root['job']['title'];
            if (App::isLocale('fr') && $root['job']['title_id']) {
                $job = JobCategory::find($root['job']['title_id'])->name_fr;
            }
            if (App::isLocale('fr') && $root['job']['title_fr_id']) {
                $job = JobCategory::find($root['job']['title_fr_id'])->name_fr;
            }
            if ($job) {
                $appliedTo[] = $job;
            }
        }

        // Combine new name
        $nameAppliedTo = implode($appliedTo, ', ');

        $your_date = strtotime($root['updated_at']);
        $datediff = time() - $your_date;
        $days = round($datediff / (60 * 60 * 24));
        Carbon::setLocale( App::getLocale());
        $dt = Carbon::now();
        $your_date = strtotime($root['user']['updated_at']);
        $datediff = time() - $your_date;
        $user_days = round($datediff / (60 * 60 * 24));

        $filters = '';
        if (!empty($root['user']['user_pic_filter'])) {
            $f = $root['user']['user_pic_filter'];
            $filters = ' data-filter="' . $f . '" class="' . $f . '"';
        }

        $city = $root['user']['city'] . ", ";
        $region = ($root['user']['city']) ? $root['user']['region'] . ", " : "";
        $country = ($root['user']['city']) ? $root['user']['country'] : "";

        $locationUser = $city . $region . $country;

        $pipelines = Pipeline::where([
            'business_id' => $root['business_id']
        ])->orderBy('position')->get();

        $current_pipeline = $pipelines->filter(function($pipeline_item) use ($root) {
            return (
                $pipeline_item->id == $root['pipeline']
                ||
                $pipeline_item->type == $root['pipeline']
                ||
                $pipeline_item->type_new == $root['pipeline_item']
            );
        })->first();

        // $notes = Note::where([
        //     'candidate_user_id' => $root['user_id'],
        //     'business_id' => $root['business_id'],
        // ])->get()->all();

        $queryData = [
            'candidate_user_id' => $root['user_id'],
            'business_id' => $root['business_id'],
        ];

        $authManagerRole = get_manager_role($root['business_id']);
        if ($authManagerRole === Administrator::FRANCHISE_ROLE) {
            $queryData['manager_user_id'] = auth()->user()->getKey();
        }
        $notes = Note::where($queryData)->get()->all();

        $notes_rating = [
            'rating' => 0,
            'class_color' => '',
        ];
        $count_notes = 0;
        foreach ($notes as $note) {
            if ($note['rating']) {
                $notes_rating['rating'] += $note['rating'];
                $count_notes++;
            }

        }
        if ($notes_rating['rating']) {
            $notes_rating['rating'] = round($notes_rating['rating'] / $count_notes);
            if ($notes_rating['rating'] < 5) {
                $notes_rating['class_color'] = 'text-danger';
            } elseif ($notes_rating['rating'] < 8) {
                $notes_rating['class_color'] = 'text-warning';
            } else {
                $notes_rating['class_color'] = 'text-success';
            }
        }
        /*$download_resume = '';
        if (!($root['user']['preference']['is_complete'] === 1 && $root['user']['availability']['is_complete'] === 1 && $root['user']['basic']['is_complete'] === 1
            && ($root['user']['preference']['not_education'] || $root['user']['education']->count() > 0) && ($root['user']['preference']['first_job'] !== null || $root['user']['experience']->count() > 0))) {
            $download_resume = !empty($root['user']['attach_file']) ? Storage::disk('user_resume')->url('/' . $root['user']['id'] . '/') . $root['user']['attach_file'] . '?v=' . rand(11111, 99999) : '';
        }*/
        $candidate_import = 0;
        if ($root['user']['is_import']) {
            $candidate_import = 1;
        }

        $view = View('business.auth.graphql.candidate_item', [
            'args' => $root,
            'picture' => $picture,
            'user_picture' => $userPicture,
            'location_user' => $locationUser,
            'location' => $location,
            'applied_to' => $nameAppliedTo,
            'job' => $job,
            //'download_resume' => $download_resume,
            'candidate_import' => $candidate_import,
            'days' => ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans(),
            'user_days' => ($user_days == 0) ? trans('fields.today') : $dt->subDays($user_days)->diffForHumans(),
            'filters' => $filters,
            'pipelines' => $pipelines,
            'read_only' => ($current_pipeline && $current_pipeline->type_new == 'archived'),
            'notes_rating' => $notes_rating,
            'user_video' => $root['user_video']['file_url'],
            'thumbnail_url' => $root['user_video']['thumbnail_url'],

        ])->render();

        return $view;
    }

}









