<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*
            - sending reference emails
        */

        $schedule->call(function () {
            \App\User\Resume\Reference::where('status', 'requested')->chunk(100, function($references) {
                foreach ($references as $reference) {
                    if ($reference->clicked) {
                        if ($reference->count_of_sent_mails / 3 < 5) {
                            if ($reference->count_of_sent_mails % 3 == 0) {
                                if (time() - $reference->updated_at->getTimestamp() > 1 * 86400) {
                                    // echo 'sending first CLICKED email';
                                    Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 3));
                                    ++$reference->count_of_sent_mails;
                                    $reference->save();
                                }
                            }
                            elseif ($reference->count_of_sent_mails % 3 == 1) {
                                if (time() - $reference->updated_at->getTimestamp() > 1 * 86400) {
                                    // echo 'sending second CLICKED email';
                                    Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 4));
                                    ++$reference->count_of_sent_mails;
                                    $reference->save();
                                }
                            }
                            elseif ($reference->count_of_sent_mails % 3 == 2) {
                                if (time() - $reference->updated_at->getTimestamp() > 1 * 86400) {
                                    // echo 'sending third CLICKED email';
                                    Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 5));
                                    ++$reference->count_of_sent_mails;
                                    $reference->save();
                                }
                            }
                        }
                    }
                    else {
                        if ($reference->count_of_sent_mails == 0) {
                            if (time() - $reference->updated_at->getTimestamp() > 1 * 86400) {
                                // echo 'sending first email';
                                Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 1));
                                ++$reference->count_of_sent_mails;
                                $reference->save();
                            }
                        }
                        elseif ($reference->count_of_sent_mails == 1) {
                            if (time() - $reference->updated_at->getTimestamp() > 2 * 86400) {
                                // echo 'sending second email';
                                Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 2));
                                ++$reference->count_of_sent_mails;
                                $reference->save();
                            }
                        }
                    }
                }
            });
        })->everyMinute(); // dailyAt('08:00');

        /*
            - sending business invitation emails
        */

        $schedule->call(function () {
            \App\Business\Import::where('status', 'Pending')->chunk(100, function($imports) {
                foreach ($imports as $import) {
                    if (!$business = \App\Business::where('id', $import->business_id)->first()) {
                        continue;
                    }

                    if ($import->count_of_sent_email_reminders / 2 < 4) {
                        if ($import->count_of_sent_email_reminders % 2 == 0) {
                            if (time() - $import->updated_at->getTimestamp() > 2 * 86400) {
                                // echo 'sending third email';
                                Mail::to($import->email)->queue(new \App\Mail\SendInvitationATS($business, $import, 'FOLLOW_UP1'));
                                ++$import->count_of_sent_email_reminders;
                                $import->save();
                            }
                        }
                        elseif ($import->count_of_sent_email_reminders % 1 == 0) {
                            if (time() - $import->updated_at->getTimestamp() > 2 * 86400) {
                                // echo 'sending third email';
                                Mail::to($import->email)->queue(new \App\Mail\SendInvitationATS($business, $import, 'FOLLOW_UP2'));
                                ++$import->count_of_sent_email_reminders;
                                $import->save();
                            }
                        }
                    }
                }
            });
        })->everyMinute(); // dailyAt('08:00');

        /*
            - sending email confirmation reminder email
        */

        $schedule->call(function () {
            \App\User::whereNotNull('verification_code')->where('verification_reminder_sent', 0)->chunk(100, function($users) {
                foreach ($users as $user) {
                    if (time() - $user->verification_date->getTimestamp() > 1 * 86400) {
                        Mail::to($user->email)->queue(new \App\Mail\VerificationUser($user, $user->language_prefix, 'REMINDER'));
                        $user->verification_reminder_sent = true;
                        $user->save();
                    }
                }
            });
        })->everyMinute(); // dailyAt('08:00')

        /*
            - sending comlete resume reminder
        */

        $schedule->call(function () {
            \App\User::where(function($query) {
                $query->where('resume_is_completed', 0);
                $query->where('count_of_complete_resume_reminders', '<', 4);
            })->chunk(100, function($users) {
                foreach ($users as $user) {
                    $last_time = max($user->created_at->getTimestamp(), $user->last_complete_resume_reminder_sent_at->getTimestamp());

                    if ($user->count_of_complete_resume_reminders == 0) {
                        if (time() - $last_time > 1 * 86400) {
                            Mail::to($user->email)->queue(new \App\Mail\ResumeCompleted($user, 'FOLLOW_UP1'));
                            ++$user->count_of_complete_resume_reminders;
                            $user->last_complete_resume_reminder_sent_at = new \DateTime;
                            $user->save();
                        }
                    }
                    elseif ($user->count_of_complete_resume_reminders == 1) {
                        if (time() - $last_time > 1 * 86400) {
                            Mail::to($user->email)->queue(new \App\Mail\ResumeCompleted($user, 'FOLLOW_UP2'));
                            ++$user->count_of_complete_resume_reminders;
                            $user->last_complete_resume_reminder_sent_at = new \DateTime;
                            $user->save();
                        }
                    }
                    elseif ($user->count_of_complete_resume_reminders == 2) {
                        if (time() - $last_time > 1 * 86400) {
                            Mail::to($user->email)->queue(new \App\Mail\ResumeCompleted($user, 'FOLLOW_UP3'));
                            ++$user->count_of_complete_resume_reminders;
                            $user->last_complete_resume_reminder_sent_at = new \DateTime;
                            $user->save();
                        }
                    }
                    elseif ($user->count_of_complete_resume_reminders == 3) {
                        if (time() - $last_time > 1 * 86400) {
                            Mail::to($user->email)->queue(new \App\Mail\ResumeCompleted($user, 'FOLLOW_UP4'));
                            ++$user->count_of_complete_resume_reminders;
                            $user->last_complete_resume_reminder_sent_at = new \DateTime;
                            $user->save();
                        }
                    }
                }
            });
        })->everyMinute(); // dailyAt('08:00');

        /*
            - sending interview request reminder
        */

        $schedule->call(function () {
            \App\InterviewRequest::where(function($query) {
                $query->where('state', 'sent');
                $query->where('count_of_sent_reminders', '<', 1);
                $query->where('sender_type', 'Business');
            })->chunk(100, function($interview_requests) {
                foreach ($interview_requests as $interview_request) {
                    $last_interview_request = \App\InterviewRequest::query()
                        ->where('business_id', $interview_request->business_id)
                        ->where('user_id', $interview_request)
                        ->where('id', '<', $interview_request->id)
                        ->orderBy('id', 'desc')
                        ->first();

                    $previous_interview_request = null;

                    if ($last_interview_request && $last_interview_request->state == 'changed') {
                        $previous_interview_request = $last_interview_request;
                    }

                    if ($interview_request->count_of_sent_reminders == 0) {
                        if (time() - $interview_request->updated_at->getTimestamp() > 1 * 86400) {
                            if ($previous_interview_request) {
                                if ($interview_request->user) {
                                    Mail::to($interview_request->user->email)->queue(new \App\Mail\UserInterview(
                                        $interview_request,
                                        $interview_request->user,
                                        $interview_request->business,
                                        'CHANGE_FOLLOW_UP1'
                                    ));
                                }
                            }
                            else {
                                if ($interview_request->user) {
                                    Mail::to($interview_request->user->email)->queue(new \App\Mail\UserInterview(
                                        $interview_request,
                                        $interview_request->user,
                                        $interview_request->business,
                                        'REMINDER'
                                    ));
                                }
                            }

                            ++$interview_request->count_of_sent_reminders;
                            $interview_request->save();
                        }
                    }
                }
            });
        })->everyMinute(); // dailyAt('08:00');

        /*
            - sending manager invite reminder
        */

        $schedule->call(function () {
            \App\User::whereNotNull('invite_token')->chunk(100, function($users) {
                foreach ($users as $user) {
                    if ($user->count_of_invite_reminders == 0) {
                        if (time() - $user->updated_at->getTimestamp() > 1 * 86400) {
                            $business_creator = \App\User::where('id', $user->invite_user_id)->first();
                            $business = \App\Business::where('id', $user->invite_business_id)->first();

                            Mail::to($user->email)->queue(new \App\Mail\ManagerInvitation(
                                $user,
                                $business_creator,
                                $business,
                                'FOLLOW_UP1'
                            ));

                            ++$user->count_of_invite_reminders;
                            $user->save();
                        }
                    }
                }
            });
        })->everyMinute(); // dailyAt('08:00');

        /*
            - sending user update request mutation
        */

        $schedule->call(function () {
            \App\Candidate\ResumeRequest::where(function($query) {
                $query->where('request', 1);
                $query->where('response', 0);
                $query->where('count_of_sent_email_reminders', 0);
            })->chunk(100, function($resume_requests) {
                foreach ($resume_requests as $resume_request) {
                    if ($resume_request->count_of_sent_email_reminders == 0) {
                        if (time() - $resume_request->updated_at->getTimestamp() > 1 * 86400) {
                            $user = \App\User::where('id', $resume_request->user_id)->first();
                            $business = \App\Business::where('id', $resume_request->business_id)->first();

                            Mail::to($user->email)->queue(new \App\Mail\UserUpdateRequest(
                                $user,
                                $business,
                                'FOLLOW_UP1'
                            ));

                            ++$resume_request->count_of_sent_email_reminders;
                            $resume_request->save();
                        }
                    }
                }
            });
        })->everyMinute();

        /*
            - unconfirmed business applicant applied
        */

        $schedule->call(function () {
            // SELECT * FROM users
            // JOIN business_administrators ON business_administrators.user_id = users.id
            // JOIN businesses ON businesses.id = business_administrators.business_id
            // JOIN candidates ON candidates.business_id = businesses.id
            // WHERE users.verification_code IS NOT NULL
            // AND candidates.pipeline = 'new'
            // GROUP BY users.id

            $user_query = \App\User::select('users.*');
            $user_query->join('business_administrators', 'business_administrators.user_id', '=', 'users.id');
            $user_query->join('businesses', 'businesses.id', '=', 'business_administrators.business_id');
            $user_query->join('candidates', 'candidates.business_id', '=', 'businesses.id');
            $user_query->where('business_administrators.role', 'admin');
            $user_query->where('candidates.pipeline', 'new');
            $user_query->whereNotNull('users.verification_code');
            $user_query->where('users.count_of_business_verification_reminders', '<', 3);
            $user_query->groupBy('users.id');

            $user_query->chunk(100, function($business_creators) {
                foreach ($business_creators as $business_creator) {
                    if ($business_creator->count_of_business_verification_reminders < 3) {
                        if (time() - $business_creator->updated_at->getTimestamp() > 1 * 86400) {
                            Mail::to($business_creator->email)->queue(new \App\Mail\CandidateCreated(
                                $business_creator,
                                null,
                                null,
                                null,
                                null,
                                false,
                                'FOLLOW_UP1'
                            ));

                            ++$business_creator->count_of_business_verification_reminders;
                            $business_creator->save();
                        }
                    }
                }
            });
        })->everyMinute();

        /*
            - closing old job locations
        */

        $schedule->call(function () {
            \App\Business\JobLocation::where('status', 1)->where('opened_at', null)->update([
                'opened_at' => new \DateTime,
            ]);

            $job_locations_query = \App\Business\JobLocation::query();
            $job_locations_query->where('status', 1);
            $job_locations_query->whereRaw('opened_at + 86400 * 30 < ?', [new \DateTime]);
            $job_locations = $job_locations_query->get();

            foreach ($job_locations as $job_location) {
                $job_location->status = 0;
                $job_location->google_jobs_notified = false;
                $job_location->save();
            }
        })->everyMinute();

        /*
            - notify google jobs
        */
        $schedule->command('google_jobs:post')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
