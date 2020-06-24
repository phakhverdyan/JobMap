<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;

class PostToGoogleJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google_jobs:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post jobs to Google jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (app()->environment() !== 'production') {
            return false;
        }

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
                Log::info($content);
            } else {
                echo 'Wrong status code: ' . $status_code . '.' . "\n";
                print_r($response->getBody()->getContents());
                echo "\n";
                break;
            }
        }

        echo 'Done.' . "\n";
    }
}
