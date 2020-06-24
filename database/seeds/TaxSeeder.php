<?php

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('taxes')->delete();
        DB::statement("INSERT INTO `taxes` (`id`, `code`, `province_fr`, `province_en`, `type_1`, `rate_1`, `type_2`, `rate_2`, `created_at`, `updated_at`) VALUES
(1, 'CA-QC', 'Quebec', 'Quebec', 'GST', '5.00', 'QST', '9.98', NULL, NULL),
(2, 'CA-ON', 'Ontario', 'Ontario', 'HST', '13.00', NULL, '0.00', NULL, NULL),
(3, 'CA-NS', 'Nova Scotia', 'Nova Scotia', 'HST', '15.00', NULL, '0.00', NULL, NULL),
(4, 'CA-NB', 'New Brunswisk', 'New Brunswisk', 'HST', '15.00', NULL, '0.00', NULL, NULL),
(5, 'CA-MB', 'Manitoba', 'Manitoba', 'GST', '5.00', 'PST', '8.00', NULL, NULL),
(6, 'CA-BC', 'British Columbia', 'British Columbia', 'GST', '5.00', 'PST', '7.00', NULL, NULL),
(7, 'CA-PE', 'Prince Edward Island', 'Prince Edward Island', 'GST', '15.00', NULL, '0.00', NULL, NULL),
(8, 'CA-SK', 'Saskatchewan', 'Saskatchewan', 'GST', '5.00', 'PST', '6.00', NULL, NULL),
(9, 'CA-AB', 'Alberta', 'Alberta', 'GST', '5.00', NULL, '0.00', NULL, NULL),
(10, 'CA-NL', 'Newfoundland & Labrador', 'Newfoundland & Labrador', 'HST', '15.00', NULL, '0.00', NULL, NULL),
(11, 'CA-NT', 'Northwest Territories', 'Northwest Territories', 'GST', '5.00', NULL, '0.00', NULL, NULL),
(12, 'CA-YT', 'Yukon', 'Yukon', 'GST', '5.00', NULL, '0.00', NULL, NULL),
(13, 'CA-NU', 'Nunavut', 'Nunavut', 'GST', '5.00', NULL, '0.00', NULL, NULL);");
    }
}
