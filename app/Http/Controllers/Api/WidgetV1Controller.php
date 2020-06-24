<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Business;
use App\JobType;
use App\Business\WebsiteWidget;
use App\Business\JobLocation;

class WidgetV1Controller extends Controller
{
    public function index(Request $request, $business_widget_id)
    {
    	$widget = WebsiteWidget::where('id', $business_widget_id)->firstOrFail();
    	$show_full_response = true;
    	$locale = $request->input('locale', null);
    	$phrase = $request->input('phrase', null);
    	$employment_type = $request->input('employment_type', null);
    	$status = $request->input('status', "open");
    	$order = $request->input('order', null);

    	if ($locale && is_string($locale) && in_array($locale, config('graphql.available_locales'))) {
    		app()->setLocale($locale);
    	}

    	$business = Business::where('id', $widget->brand_id)->firstOrFail();
    	$job_location_query = JobLocation::select('business_job_locations.*');
    	$job_location_query->join('business_jobs', 'business_jobs.id', '=', 'business_job_locations.job_id');
    	$job_location_query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');

        // if ($business->parent_id) {
            $job_location_query->where('business_locations.business_id', $business->id);
        // } else {
            // $job_location_query->where('business_jobs.business_id', $business->id);
        // }

    	if ($phrase && is_string($phrase)) {
    		$phrase_parts = preg_split('/\s+/', $phrase);

    		foreach ($phrase_parts as $phrase_part) {
	    		$job_location_query->where(function ($where) use ($phrase_part) {
	    			$where->orWhere('business_jobs.title', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_jobs.description', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_jobs.title_fr', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_jobs.description_fr', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_locations.country', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_locations.region', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_locations.city', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_locations.street', 'like', '%' . $phrase_part . '%');
	    			$where->orWhere('business_locations.street_number', 'like', '%' . $phrase_part . '%');
	    		});
	    	}
    	}

    	if ($status == 'open') {
    		$job_location_query->where('business_job_locations.status', 1);
    	} elseif ($status == 'closed') {
    		$job_location_query->where('business_job_locations.status', 0);
    	}

    	if ($employment_type) {
    		$job_location_query->where('business_jobs.type_key', $employment_type);
    	}

		if ($order == 'oldest') {
    		$job_location_query->orderByRaw('ISNULL(business_job_locations.opened_at) DESC');
    		$job_location_query->orderBy('business_job_locations.opened_at', 'asc');
    	} else {
    		$job_location_query->orderByRaw('ISNULL(business_job_locations.opened_at) ASC');
    		$job_location_query->orderBy('business_job_locations.opened_at', 'desc');
    	}

    	$job_location_query->with([
    		'job',
    		'job.type',
    		'job.languages',
    		'job.languages.language',
    		'job.careerLevels',
    		'job.careerLevels.careerLevel',
    		'location',
    	]);

    	$job_locations = $job_location_query->paginate(25)->setPath('');

    	if ($request->input('short')) {
	    	return [
	    		'title' => $business->localized_name,
	    		'description' => $business->localized_description,
	    		'search' => __('widget.search'),
	    		'no_jobs' => __('widget.no_jobs'),
	    		'statuses' => __('widget.statuses'),

	    		'employment_types' => collect([
	    			__('widget.employment_types.all_types'),
	    		])->concat(JobType::orderBy('id', 'asc')->get()->pluck('localized_name')),

	    		'orders' => __('widget.orders'),
	    		'apply_to_this_job' => __('widget.apply_to_this_job'),
	    		'languages_spoken' => __('widget.languages_spoken'),
				'hours_a_week' => __('widget.hours_a_week'),
				'hours' => __('widget.hours'),
				'career_level' => __('widget.career_level'),
				'powered_by_jm_visit_full_career_page_of' => __('widget.powered_by_jm_visit_full_career_page_of'),

	    		'data' => $job_locations->map(function ($job_location) {
		    		return view('widget.v1.job_result', [
		    			'job_location_id' => $job_location->id,
		    			'job' => $job_location->job,
		    			'location' => $job_location->location,

		    			'days_ago' => (
		    				$job_location->opened_at
		    				? min(90, floor((time() - $job_location->opened_at->getTimestamp()) / 86400))
		    				: 90
		    			),

		    			'data' => $job_location->widget_data,
		    		])->render();
		    	}),

		    	'pagination' => str_replace('?page=', '#page-', $job_locations->links()),
	    	];
	    }

	    $widget_style_filename = '/css/widget/v1.template.css';
	    $styles = '/* Whoops. No styles. */';

	    if (\File::exists(public_path($widget_style_filename))) {
	    	$styles = \File::get(public_path($widget_style_filename));

	    	$background_color = 'transparent';
	    	if($widget->background_color){
	    	    if(strpos($widget->background_color, "rgba") !== false || strpos($widget->background_color, "rgb") !== false){
                    $background_color = $widget->background_color;
                }else{
                    $background_color = '#'.$widget->background_color;
                }
            }
            $link_one_color = 'inherit';
	    	if($widget->link_one_color){
	    	    if(strpos($widget->link_one_color, "rgba") !== false || strpos($widget->link_one_color, "rgb") !== false){
                    $link_one_color = $widget->link_one_color;
                }else{
                    $link_one_color = '#'.$widget->link_one_color;
                }
            }
	    	$font_color = 'inherit';
	    	if($widget->font_color){
	    	    if(strpos($widget->font_color, "rgba") !== false || strpos($widget->font_color, "rgb") !== false){
                    $font_color = $widget->font_color;
                }else{
                    $font_color = '#'.$widget->font_color;
                }
            }
	    	$button_background_color = 'inherit';
	    	if($widget->button_background_color){
	    	    if(strpos($widget->button_background_color, "rgba") !== false || strpos($widget->button_background_color, "rgb") !== false){
                    $button_background_color = $widget->button_background_color;
                }else{
                    $button_background_color = '#'.$widget->button_background_color;
                }
            }
	    	$button_text_color = 'inherit';
	    	if($widget->button_text_color){
	    	    if(strpos($widget->button_text_color, "rgba") !== false || strpos($widget->button_text_color, "rgb") !== false){
                    $button_text_color = $widget->button_text_color;
                }else{
                    $button_text_color = '#'.$widget->button_text_color;
                }
            }
            //$size_widget = "100%";
	    	switch ($widget->size_widget){
                case "small":
                    $size_widget = "576px";
                    break;
                case "medium":
                    $size_widget = "768px";
                    break;
                case "big":
                    $size_widget = "992px";
                    break;
                case "full":
                default:
                    $size_widget = "100%";
                    break;
            }

	    	$styles_replacements = [
	    		'<size_widget>' => $size_widget,
	    		'<background_color>' => $background_color,
	    		'<link_one_color>' => $link_one_color,
	    		'<font_color>' => $font_color,
	    		'<button_background_color>' => $button_background_color,
	    		'<button_text_color>' => $button_text_color,
	    	];

	    	$styles = str_replace(array_keys($styles_replacements), array_values($styles_replacements), $styles);
	    }

	    return [
			'data' => view('widget.v1.main', [
				'id' => $widget->id,
				'show_background_image' => $widget->show_background_image,

				'background_image_url' => (
					$widget->background_image
					? asset('/business/' . $business->id . '/widgets/' . $widget->background_image)
					: asset('/img/widget_bg.jpg')
				),

				'styles' => $styles,
				'locale' => app()->getLocale(),
				'business' => $business,
				'job_types' => JobType::orderBy('id', 'asc')->get(),

				'job_views' => $job_locations->map(function ($job_location)use($widget) {
		    		return view('widget.v1.job_result', [
		    			'job_location_id' => $job_location->id,
		    			'job' => $job_location->job,
		    			'location' => $job_location->location,
		    			'show_job_posted_date' => $widget->show_job_posted_date,

                        'status' => (bool) $job_location->job->status,

		    			'days_ago' => (
		    				$job_location->opened_at
		    				? min(90, floor((time() - $job_location->opened_at->getTimestamp()) / 86400))
		    				: 90
		    			),

		    			'data' => $job_location->widget_data,
		    		])->render();
		    	}),

		    	'pagination' => str_replace('?page=', '#page-', $job_locations->links()),
			])->render(),
		];
    }
}
