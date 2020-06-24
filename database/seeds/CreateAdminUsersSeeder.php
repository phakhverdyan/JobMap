<?php

use App\Modules\Admin\Models\AdminPermission;
use App\Modules\Admin\Models\AdminRole;
use App\Modules\Admin\Models\AdminUser;
use Illuminate\Database\Seeder;

class CreateAdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert Admin
        DB::table('admin_users')->delete();
        DB::table('permissions')->delete();
        DB::table('permission_role')->delete();
        $this->importRoleAndPermissions();
    }

    protected function createSuperAdmin()
    {
        $superAdminId = DB::table('admin_users')->insertGetId([
            'name' => 'superadmin',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('1111'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
        ]);

        return $superAdminId;
    }

    protected function createSulesAndSupport()
    {
        $salessupportId = DB::table('admin_users')->insertGetId([
            'name' => 'salessupport',
            'email' => 'salessupport@test.com',
            'password' => bcrypt('1111'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
        ]);

        return $salessupportId;
    }

    protected function createAssociates()
    {
        $associateId = DB::table('admin_users')->insertGetId([
            'name' => 'associate',
            'email' => 'associate@test.com',
            'password' => bcrypt('1111'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
        ]);

        return $associateId;
    }

    protected function createMapManager()
        {
            $mapmanagerId = DB::table('admin_users')->insertGetId([
                'name' => 'mapmanager',
                'email' => 'mapmanager@test.com',
                'password' => bcrypt('1111'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ]);

            return $mapmanagerId;
        }

    protected function importRoleAndPermissions()
    {
        $superAdminId = $this->createSuperAdmin();


        $admin = new AdminRole();
        $admin->name         = 'superadmin';
        $admin->display_name = 'Admin'; // optional
        $admin->description  = 'Super-admin role'; // optional
        $admin->save();

        AdminUser::find($superAdminId)->attachRole($admin);

        /* add permission Stats Dush */
        $addStatsDush = new AdminPermission();
        $addStatsDush->name         = 'stats-dash';
        $addStatsDush->display_name = 'Stats Dash'; // optional
        $addStatsDush->description  = 'Stats Dash'; // optional
        $addStatsDush->save();

        $admin->attachPermission($addStatsDush);

        /* add permission Clients */
        $addClients = new AdminPermission();
        $addClients->name         = 'clients';
        $addClients->display_name = 'Clients'; // optional
        $addClients->description  = 'Here is the list of all available clients'; // optional
        $addClients->save();

        $admin->attachPermission($addClients);

        /* add permission Orders */
        $addOrders = new AdminPermission();
        $addOrders->name         = 'orders';
        $addOrders->display_name = 'Orders'; // optional
        $addOrders->description  = 'Here you can apply global discount'; // optional
        $addOrders->save();

        $admin->attachPermission($addOrders);

        /* add permission Billing */
        $addBilling = new AdminPermission();
        $addBilling->name         = 'billing';
        $addBilling->display_name = 'Billing'; // optional
        $addBilling->description  = 'Here you can see and modify invoices'; // optional
        $addBilling->save();

        $admin->attachPermission($addBilling);

        /* add permission Tickets */
        $addTickets = new AdminPermission();
        $addTickets->name         = 'tickets';
        $addTickets->display_name = 'Tickets'; // optional
        $addTickets->description  = 'Here are the tickets'; // optional
        $addTickets->save();

        $admin->attachPermission($addTickets);

        /* add permission Map & Stats */
        $addMapAndStats = new AdminPermission();
        $addMapAndStats->name         = 'map-and-stats';
        $addMapAndStats->display_name = 'Map and Stats'; // optional
        $addMapAndStats->description  = 'This shows global map tracking stats'; // optional
        $addMapAndStats->save();

        $admin->attachPermission($addMapAndStats);

        /* add permission Manager Layer selection */
        $addManagerLayerSelection = new AdminPermission();
        $addManagerLayerSelection->name         = 'manager-layer-selection';
        $addManagerLayerSelection->display_name = 'Manager Layer Selection'; // optional
        $addManagerLayerSelection->description  = 'The manager layer allows managers to draw the wanted section'; // optional
        $addManagerLayerSelection->save();

        $admin->attachPermission($addManagerLayerSelection);

        /* add permission Agent Layer selection */
        $addAgentLayerSelection = new AdminPermission();
        $addAgentLayerSelection->name         = 'agent-layer-selection';
        $addAgentLayerSelection->display_name = 'Agent Layer Selection'; // optional
        $addAgentLayerSelection->description  = 'The agent layer shows where the agent prospected with cold walk-ins, emails and cold calls'; // optional
        $addAgentLayerSelection->save();

        $admin->attachPermission($addAgentLayerSelection);

        /* add permission Users & Roles */
        $addUsersAndRoles = new AdminPermission();
        $addUsersAndRoles->name         = 'user-roles';
        $addUsersAndRoles->display_name = 'User and Roles'; // optional
        $addUsersAndRoles->description  = 'Here you can add modify and delete users'; // optional
        $addUsersAndRoles->save();

        $admin->attachPermission($addUsersAndRoles);

        /* add permission modify Admins */
        $addModifyAdmins = new AdminPermission();
        $addModifyAdmins->name         = 'modify-admin';
        $addModifyAdmins->display_name = 'Modify Admin'; // optional
        $addModifyAdmins->description  = 'Here you can add modify and delete users Admins'; // optional
        $addModifyAdmins->save();

        $admin->attachPermission($addModifyAdmins);

        /* add permission modify Sales and Support */
        $addModifySalesAndSupport = new AdminPermission();
        $addModifySalesAndSupport->name         = 'modify-sales-support';
        $addModifySalesAndSupport->display_name = 'Modify Sales and Support'; // optional
        $addModifySalesAndSupport->description  = 'Here you can add modify and delete users Sales and Support'; // optional
        $addModifySalesAndSupport->save();

        $admin->attachPermission($addModifySalesAndSupport);

        /* add permission modify Admins */
        $addModifyAssociates = new AdminPermission();
        $addModifyAssociates->name         = 'modify-associates';
        $addModifyAssociates->display_name = 'Modify Associates'; // optional
        $addModifyAssociates->description  = 'Here you can add modify and delete users Associates'; // optional
        $addModifyAssociates->save();

        $admin->attachPermission($addModifyAssociates);

        /* add permission Product & Pricing */
        $addProductAndPricing = new AdminPermission();
        $addProductAndPricing->name         = 'product-pricing';
        $addProductAndPricing->display_name = 'Product and Pricing'; // optional
        $addProductAndPricing->description  = 'Product names [per seat price, per location price]'; // optional
        $addProductAndPricing->save();

        $admin->attachPermission($addProductAndPricing);

        /* add permission Discount Coupons/Codes */
        $addDiscountCouponsCodes = new AdminPermission();
        $addDiscountCouponsCodes->name         = 'discount-coupons-codes';
        $addDiscountCouponsCodes->display_name = 'Discount Coupons Codes'; // optional
        $addDiscountCouponsCodes->description  = 'Here you can create specific discount codes for xyz customers'; // optional
        $addDiscountCouponsCodes->save();

        $admin->attachPermission($addDiscountCouponsCodes);

        /* add permission BMI */
        $addBMI = new AdminPermission();
        $addBMI->name         = 'bmi';
        $addBMI->display_name = 'BMI'; // optional
        $addBMI->description  = 'Big mac pricing setup per country'; // optional
        $addBMI->save();

        $admin->attachPermission($addBMI);

        /* add permission BMI */
        $addAffiliateStats = new AdminPermission();
        $addAffiliateStats->name         = 'affiliate-stats';
        $addAffiliateStats->display_name = 'Affiliate Stats'; // optional
        $addAffiliateStats->description  = 'Here you can see affiliate performance'; // optional
        $addAffiliateStats->save();

        $admin->attachPermission($addAffiliateStats);

        /* add permission Pricing & Tier Management */
        $addPricingAndTierManagement = new AdminPermission();
        $addPricingAndTierManagement->name         = 'pricing-tier-management';
        $addPricingAndTierManagement->display_name = 'Pricing and Tier Management'; // optional
        $addPricingAndTierManagement->description  = 'Pricing and Tier Management'; // optional
        $addPricingAndTierManagement->save();

        $admin->attachPermission($addPricingAndTierManagement);

        /* add permission Assets */
        $addAssets = new AdminPermission();
        $addAssets->name         = 'assets';
        $addAssets->display_name = 'Assets'; // optional
        $addAssets->description  = 'Assets'; // optional
        $addAssets->save();

        $admin->attachPermission($addAssets);

        /* add permission Languages */
        $addLanguages = new AdminPermission();
        $addLanguages->name         = 'languages';
        $addLanguages->display_name = 'Languages'; // optional
        $addLanguages->description  = 'Languages'; // optional
        $addLanguages->save();

        $admin->attachPermission($addLanguages);

        /* add permission Job type, career levels, amenities */
        $addJobTypes = new AdminPermission();
        $addJobTypes->name         = 'job-type';
        $addJobTypes->display_name = 'Job type, career levels, amenities'; // optional
        $addJobTypes->description  = ''; // optional
        $addJobTypes->save();

        $admin->attachPermission($addJobTypes);

        /* add permission Pipeline icons */
        $addPipelineIcons = new AdminPermission();
        $addPipelineIcons->name         = 'pipeline-icons';
        $addPipelineIcons->display_name = 'Pipeline icons'; // optional
        $addPipelineIcons->description  = ''; // optional
        $addPipelineIcons->save();

        $admin->attachPermission($addPipelineIcons);

        /* add role  Sales and Support*/
        $salessupportId = $this->createSulesAndSupport();

        $salessupport = new AdminRole();
        $salessupport->name         = 'salessupport';
        $salessupport->display_name = 'Sales and Support'; // optional
        $salessupport->description  = 'Sales and Support role'; // optional
        $salessupport->save();

        AdminUser::find($salessupportId)->attachRole($salessupport);

        $salessupport->attachPermission($addClients);
        $salessupport->attachPermission($addOrders);
        $salessupport->attachPermission($addBilling);
        $salessupport->attachPermission($addTickets);
        $salessupport->attachPermission($addDiscountCouponsCodes);

        /* add role  Associates*/
        $associateId = $this->createAssociates();

        $associate = new AdminRole();
        $associate->name         = 'associates';
        $associate->display_name = 'Associates'; // optional
        $associate->description  = ''; // optional
        $associate->save();

        AdminUser::find($associateId)->attachRole($associate);

        $associate->attachPermission($addMapAndStats);
        $associate->attachPermission($addClients);
        $associate->attachPermission($addDiscountCouponsCodes);


        /* add role  Map Manager*/
        $mapmanagerId = $this->createMapManager();

        $mapmanager = new AdminRole();
        $mapmanager->name         = 'map-manager';
        $mapmanager->display_name = 'Map Manager'; // optional
        $mapmanager->description  = ''; // optional
        $mapmanager->save();

        AdminUser::find($mapmanagerId)->attachRole($mapmanager);
        $mapmanager->attachPermission($addMapAndStats);

    }
}
