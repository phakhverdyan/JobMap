<?php

if (!function_exists('get_svg_content')) {
	function get_svg_contents($svg_path, $svg_class = '') {
		$svg = new \DOMDocument();
        $svg->load(public_path($svg_path));

        if ($svg_class) {
        	if (is_array($svg_class)) {
        		foreach ($svg_class as $attribute_name => $attribute_value) {
        			$svg->documentElement->setAttribute($attribute_name, $attribute_value);
        		}
        	}
        	else {
        		$svg->documentElement->setAttribute("class", $svg_class);
        	}
        }

        return $svg->saveXML($svg->documentElement);
	}
}

if (!function_exists('get_language_array')) {
    function get_language_array($language_prefix = null) {
        if (!$language_prefix) {
            $language_prefix = \Illuminate\Support\Facades\App::getLocale();
        }

        $default_path = resource_path() . '/client_lang/en.php';

        if (!File::exists($default_path)) {
            return null;
        }

        $data = include($default_path);

        if ($language_prefix != 'en') {
            $extra_path = resource_path() . '/client_lang/' . $language_prefix . '.php';

            if (File::exists($extra_path)) {
                $extra_data = include($extra_path);

                $merge = function(&$a, $b) use (&$merge) {
                    foreach ($b as $child => $value) {
                        if (isset($a[$child]) && is_array($a[$child]) && is_array($value)) {
                            $merge($a[$child], $value);
                            continue;
                        }

                        $a[$child] = $value;
                    }
                };

                $merge($data, $extra_data);
            }
        }

        return $data;
    }
}

function get_localized_attribute($root, $attribute_name)
{
    $available_locales = config('graphql.available_locales');
    $current_available_locale_index = array_search(\App::getLocale(), $available_locales);

    if ($current_available_locale_index !== false) {
        unset($available_locales[$current_available_locale_index]);
        array_unshift($available_locales, \App::getLocale());
    }

    if (!$root['title'] && !$root['title_fr']) {
        if ($root['title_id']) {
            $root['title'] = \App\JobCategory::find($root['title_id'])->name;
        } else if ($root['title_fr_id']) {
            $root['title_fr'] = \App\JobCategory::find($root['title_fr_id'])->name;
        }
    }

    return array_reduce($available_locales, function($current_value, $current_locale) use ($root, $attribute_name) {
        return $current_value ?: $root[$attribute_name . ($current_locale == 'en' ? '' : '_' . $current_locale)];
    });
}

function get_localized_attribute_2_0($root, $attribute_name)
{
	if (app()->getLocale() !== 'en' && $root->relevant_translation) {
		return $root->relevant_translation[$attribute_name];
	}

	return $root->getOriginal($attribute_name);
}

if (!function_exists('merge_file_name')) {
    function merge_file_name(string $fileName, string $string): string
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        return str_replace('.' . $extension, '', $fileName) . $string . '.' . $extension;
    }
}

if (!function_exists('jwt_is_auth')) {
    function jwt_is_auth(): bool
    {
        return auth()->check();
    }
}

if (!function_exists('is_business_auth')) {
    function is_business_auth(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $businessID = request()->cookie('business-id');
        if (!$businessID) {
            return false;
        }

        return true;
    }
}

if (!function_exists('is_permit_administrator')) {
    function is_permit_administrator(array $permit): bool
    {
        return \App\Http\GraphQLClient::isPermitAdministrator($permit);
    }
}

if (!function_exists('is_admin')) {
    function is_admin(): bool
    {
        return \App\Http\GraphQLClient::isAdministrator();
    }
}

if (!function_exists('job_type_by_key')) {
    function job_type_by_key($key): string
    {
        if (!$key) {
            $key = 'other';
        }

        $jobType = \App\JobType::where('key', $key)->first();

        if (!$jobType) {
            return '';
        }

        return  \App::isLocale('fr') ? $jobType->name_fr : $jobType->name;

    }
}

if (!function_exists('job_types')) {
    function job_types()
    {
        return  \App\JobType::orderBy('id', 'asc')->get();
    }
}

if (!function_exists('remove_special_chars')) {
    function remove_special_chars(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $string);
    }
}

if (!function_exists('log_info')) {
    function log_info($data)
    {
        Log::info(json_encode($data));
    }
}


if (!function_exists('asset_no_cache')) {
    function asset_no_cache($path, $secure = null)
    {
        if (config('app.env') == 'production') {
            return asset($path, $secure);
        }

        $parsed_url = parse_url($path);
        $new_path = $parsed_url['path'];

        if (isset($parsed_url['query']) && $parsed_url['query']) {
            $new_path .= '?';
            $new_path .= $parsed_url['query'];
            $new_path .= '&' . time();
        } else {
            $new_path .= '?' . time();
        }

        return asset($new_path, $secure);
    }
}

function gmp_base_convert($number, $from_base, $to_base)
{
    return gmp_strval(gmp_init($number, $from_base), $to_base);
}


if (!function_exists('is_email_send')) {
    function is_email_send($is_email_send)
    {
        if(auth()->user()){
            if(auth()->user()->on_email_send == 1){

            }elseif (auth()->user()->on_email_send == 0){

            }
        }
    }
}

function caching_file_headers($response, $file, $timestamp = 0)
{
    if (!$timestamp) {
        $timestamp = filemtime($file);
    }

    $gmt_mtime = gmdate('r', $timestamp);
    $response->header('ETag', '"' . md5($timestamp . $file) . '"');
    $response->header('Last-Modified', $gmt_mtime);
    $response->header('Cache-Control', 'public');

    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime) {
        header('HTTP/1.1 304 Not Modified');
        exit();
    }

    if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
        if (str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp . $file)) {
            header('HTTP/1.1 304 Not Modified');
            exit();
        }
    }
}