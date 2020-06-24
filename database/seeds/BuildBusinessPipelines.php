<?php

use Illuminate\Database\Seeder;
use App\Business\Pipeline;
use App\Candidate\Candidate;

class BuildBusinessPipelines extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::where('pipeline','import')->update(['pipeline' => 'invited']);
        Candidate::where('pipeline','interested')->update(['pipeline' => 'new']);
        Candidate::where('pipeline','employees')->update(['pipeline' => 'hired']);
        Candidate::where('pipeline','archived')->update(['pipeline' => 'rejected']);

        DB::table('candidate_histories')->where('pipeline','import')->update(['pipeline' => 'invited']);
        DB::table('candidate_histories')->where('pipeline','interested')->update(['pipeline' => 'new']);
        DB::table('candidate_histories')->where('pipeline','employees')->update(['pipeline' => 'hired']);
        DB::table('candidate_histories')->where('pipeline','archived')->update(['pipeline' => 'rejected']);

        //-1
        Pipeline::where('type','ats')->update([
            'type_new' => 'invited',
            'name' => trans('db.pipelines.invited', [], 'en'),
            'name_fr' => trans('db.pipelines.invited', [], 'fr'),
        ]);
        //-2
        Pipeline::where('type','new')->update([
            'type_new' => 'new',
            'name' => trans('db.pipelines.new', [], 'en'),
            'name_fr' => trans('db.pipelines.new', [], 'fr'),
        ]);
        //-3
        Pipeline::where('name','Viewed')->delete();
        //-4
        Pipeline::where('name','Contacted')->update([
            'name_fr' => trans('db.pipelines.contacted', [], 'fr'),
        ]);
        //-5
        Pipeline::where('name','To Interview')->delete();
        //-6
        Pipeline::where('name','Interviewed')->update([
            'name_fr' => trans('db.pipelines.interviewed', [], 'fr'),
        ]);
        //-7
        Pipeline::where('name','Moved')->update([
            'name' => trans('db.pipelines.offer_made', [], 'en'),
            'name_fr' => trans('db.pipelines.offer_made', [], 'fr'),
        ]);
        //-8
        Pipeline::where('name','Employees')->update([
            'type' => 'hired',
            'type_new' => 'hired',
            'name' => trans('db.pipelines.hired', [], 'en'),
            'name_fr' => trans('db.pipelines.hired', [], 'fr'),
        ]);
        //-9
        Pipeline::where('name','Archived')->update([
            'type' => 'rejected',
            'type_new' => 'rejected',
            'name' => trans('db.pipelines.rejected', [], 'en'),
            'name_fr' => trans('db.pipelines.rejected', [], 'fr'),
        ]);
        Pipeline::where('name','Contacté')->update([
            'name' => 'Contacted',
        ]);
        Pipeline::where('name','Interviewé')->update([
            'name' => 'Interviewed',
        ]);
        Pipeline::where('name','Déplacé')->update([
            'name' => 'Offer made',
        ]);
        Pipeline::where('name','Employés')->update([
            'name' => 'Hired',
        ]);
        Pipeline::where('name','Archivé')->update([
            'name' => 'Archive',
        ]);
        Pipeline::where('name','À interviewer')->update([
            'name' => 'Interviewed',
        ]);

        $pipelineNames = [
            'Waiting permit',
            'Pending',
            'db.pipelines.to_interview',
            'Vu',
            'Archive',
        ];

        foreach ($pipelineNames as $name) {
            Pipeline::where('name', $name)->delete();
        }

    }
}
