<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Business\WebsiteWidget;

class WidgetController extends Controller
{
    public function javascript(Request $request, $business_website_widget_id)
    {
    	if (!$business_website_widget = WebsiteWidget::where('id', $business_website_widget_id)->first()) {
    		return json_encode('The widget does not exist. Sorry.') . ';';
    	}

    	if (!$business = Business::where('id', $business_website_widget->business_id)->first()) {
    		return json_encode('The business for this widget does not exist. Sorry.') . ';';
    	}

    	$widget_javascript_filename = '/js/widget/v1.template.js';

    	if (!\File::exists(public_path($widget_javascript_filename))) {
    		return json_encode('The widget JS does not exist. Sorry. Please contact to our support. Thank you.');
    	}

    	$widget_javascript_code = \File::get(public_path($widget_javascript_filename));
        $javascript_code = '';
        $javascript_code .= '(' . preg_replace('/;+$/', '', $widget_javascript_code) . ')';
    	$javascript_code .= '(';
        
    	$javascript_code .= json_encode([
    		'id' => $business_website_widget->id,
            'business_id' => $business->id,
            'main_url' => url('/'),
            'locale' => app()->getLocale(),
    	]);

    	$javascript_code .= ');';

    	return response($javascript_code)->header('Content-Type', 'application/javascript');
    }

    public function resumeUploader(Request $request, $business_website_widget_id)
    {
        if ($request->input('locale')) {
            app()->setLocale($request->input('locale'));
        }

        if (!$business_website_widget = WebsiteWidget::where('id', $business_website_widget_id)->first()) {
            return 'The widget does not exist. Sorry.';
        }

        if (!$business = Business::where('id', $business_website_widget->business_id)->first()) {
            return 'The business for this widget does not exist. Sorry.';
        }
        
        return view('widget.v1.resume_uploader', [
            'business' => $business,
        ]);
    }

    public function preview(Request $request, $business_website_widget_id)
    {
        if ($request->input('locale')) {
            app()->setLocale($request->input('locale'));
        }

        $business_website_widget = WebsiteWidget::where('id', $business_website_widget_id)->firstOrFail();
        $business = Business::where('id', $business_website_widget->business_id)->firstOrFail();
        
        return view('widget.v1.preview', [
            'id' => $business_website_widget->id,
            'business' => $business,
        ]);
    }
}
