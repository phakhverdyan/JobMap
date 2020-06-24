<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Business\JobLocation;

class NotifyGoogleAboutJobUpdates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $job_location_id;
    protected $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $job_location_id, string $event = 'UPDATED')
    {
        $this->job_location_id = $job_location_id;
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Google_Client();
        $client->setAuthConfig(base_path('google_service_account_file.json'));
        $client->addScope('https://www.googleapis.com/auth/indexing');
        $httpClient = $client->authorize();
        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

        $content = json_encode([
            'url' => env('/map/view/job/' . $this->job_location_id),
            'type' => 'URL_' . $this->event,
        ]);

        $response = $httpClient->post($endpoint, ['body' => $content]);
        $status_code = $response->getStatusCode();
    }
}
