<?php

use App\Business;
use App\Business\Administrator;
use App\Business\Permit;
use Illuminate\Database\Seeder;

class BuildRolesPermitsManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //---build roles
        $businesses = Business::with([
                'admins' => function ($query){
                    $query->where('role', 'admin');
                }
            ])
            ->get();
        foreach ($businesses as $business) {
            $first = true;
            foreach ($business->admins as $admin) {
                if ($first) {
                    $first = false;
                } else {
                    Administrator::where('id', $admin->id)->update(['role' => 'manager']);
                }
            }
        }

        //---build roles
        DB::table('business_admin_permit')->delete();
        DB::statement('ALTER TABLE business_admin_permit AUTO_INCREMENT = 1');
        $permits = Permit::get();
        $permits_manager = $permits->where('type', Permit::MANAGER_TYPE);
        $permits_franchisee = $permits->where('type', Permit::FRANCHISEE_TYPE);
        $permits_attach_manager = [];
        $permits_attach_franchise = [];
        foreach ($permits_manager as $permit) {
            $permits_attach_manager[$permit->id] = [ 'value' => 1 ];
        }
        foreach ($permits_franchisee as $permit) {
            $permits_attach_franchise[$permit->id] = [ 'value' => 1 ];
        }

        $administrators = Administrator::has('user')->get();

        foreach ($administrators as $administrator) {
            if ($administrator->role == Administrator::FRANCHISE_ROLE) {
                $administrator->permits()->attach($permits_attach_franchise);
            } else {
                $administrator->permits()->attach($permits_attach_manager);
            }
        }
    }
}
