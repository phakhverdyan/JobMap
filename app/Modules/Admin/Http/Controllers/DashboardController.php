<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Business;
use App\BusinessSize;
use App\Industry;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//use App\Http\Requests;
use App\Modules\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function composeFilters()
    {
        $filters = [];

        $filters['size'] = BusinessSize::all();

        $filters['countries'] = DB::table('businesses')
            ->select('country')
            ->groupBy('country')
            ->get();

        $filters['city'] = DB::table('businesses')
            ->select('city')
            ->groupBy('city')
            ->get();

        $filters['industries'] = Industry::all();

        return $filters;
    }

    public function index()
    {

        $appliedFilters = request()->all();

        $query = DB::table('businesses')
            ->select(
                'businesses.id',
                'businesses.name',
                'businesses.country',
                'businesses.city',
                'businesses.created_at',
                'businesses.updated_at',
                'businesses.type',
                'users.first_name',
                'users.last_name',
                DB::raw("(SELECT languages.name FROM languages WHERE business_administrators.user_id = users.id AND users.language = languages.id ) as lang"),
                DB::raw('count(business_administrators.id) as users'),
                DB::raw('count(business_locations.id) as locations'),
                DB::raw("(SELECT count(candidates.id) FROM candidates WHERE candidates.business_id = businesses.id AND candidates.pipeline='viewed' GROUP BY candidates.business_id) as cViewed"),
                DB::raw("(SELECT count(DISTINCT candidates.user_id) FROM candidates WHERE candidates.business_id = businesses.id GROUP BY candidates.business_id) as cReceived"),
                DB::raw("(SELECT count(business_jobs.id) FROM business_jobs WHERE business_jobs.business_id = businesses.id AND business_jobs.status=1 GROUP BY business_jobs.business_id) as openJobs"),
                DB::raw("(SELECT count(business_jobs.id) FROM business_jobs WHERE business_jobs.business_id = businesses.id AND business_jobs.status=0 GROUP BY business_jobs.business_id) as closedJobs"),
                DB::raw('industries.name as industry'),
                DB::raw('business_sizes.name as size'),
                DB::raw("(SELECT count(employees.id) FROM candidates as employees WHERE employees.business_id = businesses.id AND employees.pipeline='employees' GROUP BY employees.business_id) as employees")
//                DB::raw("(SELECT count(chat_messages.id) FROM chat_messages  WHERE chat_messages.business_id = businesses.id GROUP BY chat_messages.business_id) as messages")
            );

        if (count($appliedFilters)) {
            $query = $this->composeConditions($query, $appliedFilters);
        }

        $data = $query->leftJoin('business_administrators', 'businesses.id', '=', 'business_administrators.business_id')
            ->leftJoin('users', 'users.id', '=', 'business_administrators.user_id')
            ->leftJoin('business_locations', 'businesses.id', '=', 'business_locations.business_id')
            ->leftJoin('candidates', 'businesses.id', '=', 'candidates.business_id')
            ->leftJoin('business_jobs', 'businesses.id', '=', 'business_jobs.business_id')
            ->leftJoin('industries', 'industries.id', '=', 'businesses.industry_id')
            ->leftJoin('business_sizes', 'business_sizes.id', '=', 'businesses.size_id')
            ->groupBy('businesses.id')
            ->paginate(15)
            ->appends(request()->query());


        $filters = $this->composeFilters();

        return view('admin::dashboard.index', compact('data', 'filters'));
    }

    public function client($id)
    {
//        $appliedFilters = request()->all();

        $query = DB::table('businesses')
            ->select(
                'businesses.id',
                'businesses.name',
                'businesses.country',
                'businesses.city',

                DB::raw("DATE_FORMAT(businesses.created_at, '%Y-%m-%d') as created_at"),
                DB::raw("DATEDIFF(CURDATE(),STR_TO_DATE(businesses.created_at, '%Y-%m-%d')) as diff_date"),
                'businesses.type',
                'businesses.phone',
                'businesses.phone_code',
                'businesses.updated_at',
                'users.first_name',
                'users.last_name',
                'users.email',
                DB::raw("(SELECT languages.name FROM languages WHERE business_administrators.user_id = users.id AND users.language = languages.id ) as lang"),
                DB::raw('count(business_administrators.id) as users'),
                DB::raw('count(business_locations.id) as locations'),
                DB::raw("(SELECT count(candidates.id) FROM candidates WHERE candidates.business_id = businesses.id AND candidates.pipeline='viewed' GROUP BY candidates.business_id) as cViewed"),
                DB::raw("(SELECT count(DISTINCT candidates.user_id) FROM candidates WHERE candidates.business_id = businesses.id GROUP BY candidates.business_id) as cReceived"),
                DB::raw("(SELECT count(business_jobs.id) FROM business_jobs WHERE business_jobs.business_id = businesses.id AND business_jobs.status=1 GROUP BY business_jobs.business_id) as openJobs"),
                DB::raw("(SELECT count(business_jobs.id) FROM business_jobs WHERE business_jobs.business_id = businesses.id AND business_jobs.status=0 GROUP BY business_jobs.business_id) as closedJobs"),
                DB::raw('industries.name as industry'),
                DB::raw('business_sizes.name as size'),
                DB::raw("(SELECT count(employees.id) FROM candidates as employees WHERE employees.business_id = businesses.id AND employees.pipeline='employees' GROUP BY employees.business_id) as employees")
//                DB::raw("(SELECT count(chat_messages.id) FROM chat_messages  WHERE chat_messages.business_id = businesses.id GROUP BY chat_messages.business_id) as messages")
            )
            ->leftJoin('business_administrators', 'businesses.id', '=', 'business_administrators.business_id')
            ->leftJoin('users', 'users.id', '=', 'business_administrators.user_id')
            ->leftJoin('business_locations', 'businesses.id', '=', 'business_locations.business_id')
            ->leftJoin('candidates', 'businesses.id', '=', 'candidates.business_id')
            ->leftJoin('business_jobs', 'businesses.id', '=', 'business_jobs.business_id')
            ->leftJoin('industries', 'industries.id', '=', 'businesses.industry_id')
            ->leftJoin('business_sizes', 'business_sizes.id', '=', 'businesses.size_id')
            ->where('businesses.id', '=', $id);
        $data['business'] = $query->first();
        $data['invoices'] = DB::table('billings')
            ->select(
                'billings.id',
                'billings.business_id',
                'billings.charge_id',
                'billings.invoice_id',
                'billings.plan_id',
                'billings.package_id',
                'billings.status',
                'billings.total',
                'billings.coupon_id',
                DB::raw("DATE_FORMAT(billings.created_at, '%Y-%m-%d') as created_at"),
                DB::raw('discounts.code as coupon'),
                DB::raw('addon_packages.plan_name as package'),
                DB::raw('monthly_plans.plan_name as plan')
            )
            ->leftJoin('discounts', 'discounts.id', '=', 'billings.coupon_id')
            ->leftJoin('addon_packages', 'addon_packages.id', '=', 'billings.package_id')
            ->leftJoin('monthly_plans', 'monthly_plans.id', '=', 'billings.plan_id')
            ->where('billings.business_id', '=', $id)
            ->get()->all();

//        dd($data);


        return response()->json($data);
    }


    function composeConditions($query, $appliedFilters)
    {
        if (isset($appliedFilters['country'])) {
            $query->where('businesses.country', 'like', '%' . $appliedFilters['country'] . '%');
        }

        if (isset($appliedFilters['city'])) {
            $query->where('businesses.city', 'like', '%' . $appliedFilters['city'] . '%');
        }

        if (isset($appliedFilters['size'])) {
            $query->where('business_sizes.id', $appliedFilters['size']);
        }

        if (isset($appliedFilters['industry'])) {
            $query->where('industries.id', $appliedFilters['industry']);
        }

        return $query;
    }
}
