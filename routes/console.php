<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('test_sending', function() {
	Mail::send('emails.layout', [], function($mail) {
		$mail->to('atom-danil@yandex.ru');
		$mail->subject('Hi there!');
	});
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('incoming_email {sender} {recipient} {original_recipient}', function($sender, $recipient, $original_recipient) {
	$content = stream_get_contents(STDIN);

	if (!preg_match('/From: .*?\<(.*?)\>/i', $content, $match)) {
		return;
	}

	$original_sender = explode(' ', $match[1])[0];
	file_put_contents('/var/www/inbox/' . date('Y-m-d_H-i-s'), json_encode([$sender, $original_sender, $recipient, $original_recipient]) . "\n\n\n" . $content);

	if (!preg_match('/^b-([0-9]+)@/i', $original_recipient, $match)) {
		return;
	}

	$business_id = strval($match[1]);

	if (!$business = \App\Business::where('id', $business_id)->first()) {
		return;
	}

	Mail::send('emails.business.incoming_message_from_user', [
		'business' => $business,
	], function($mail) use ($original_sender) {
		$mail->from('noreply@jobmap.co', 'JobMap.co');
		$mail->to($original_sender);
		$mail->subject('{SUBJECT}');
	});
});

/*
Artisan::command('index_google_jobs', function () {
    $job_locations_query = \App\Business\JobLocation::query();
    $job_locations_query->where('google_jobs_notified', 0);
    $job_locations = $job_locations_query->get();

    $google_client = new \Google_Client();
    $google_client->setAuthConfig(base_path('google_service_account_file.json'));
    $google_client->addScope('https://www.googleapis.com/auth/indexing');
    $http_client = $google_client->authorize();
    $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    foreach ($job_locations as $job_location) {
        $content = json_encode([
            'url' => url('/map/view/job/' . $job_location->id),
            'type' => ($job_location->status ? 'URL_UPDATED' : 'URL_DELETED'),
        ]);

        $response = $http_client->post($endpoint, ['body' => $content]);
        $status_code = $response->getStatusCode();

        if ($status_code === 429) {
        	echo 'Quota limit.' . "\n";
        	break;
        }

        if ($status_code === 200) {
            $job_location->google_jobs_notified = true;
            $job_location->save();
        } else {
            echo 'Wrong status code: ' . $status_code . '.' . "\n";
            print_r($response->getBody()->getContents());
            echo "\n";
            break;
        }
    }

    echo 'Done.' . "\n";
});
*/

