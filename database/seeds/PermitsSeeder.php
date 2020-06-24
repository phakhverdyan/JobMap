<?php

use Illuminate\Database\Seeder;

class PermitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permits')->delete();
        DB::statement('ALTER TABLE permits AUTO_INCREMENT = 1');

        $data = [
            [ 'type' => 'manager', 'slug' => 'locations', 'title' => "Can create/edit Locations", 'title_fr' => "Peut créer/éditer des emplacements" ],
            [ 'type' => 'manager', 'slug' => 'jobs', 'title' => "Can create/edit Jobs", 'title_fr' => "Peut créer/éditer des emplois" ],
            [ 'type' => 'manager', 'slug' => 'managers', 'title' => "Can create/edit Managers/Franchisees", 'title_fr' => "Peut créer/éditer des gestionnaires/franchisés" ],
            [ 'type' => 'manager', 'slug' => 'brands', 'title' => "Can Create/edit Brands", 'title_fr' => "Peut créer/éditer des marques" ],
            [ 'type' => 'manager', 'slug' => 'departments', 'title' => "Can create/edit Departments", 'title_fr' => "Peut créer/éditer des départements" ],
            // [ 'type' => 'manager', 'slug' => 'franchisees', 'title' => "Can create/edit Franchisees", 'title_fr' => "Peut créer/éditer des franchisés" ],
            [ 'type' => 'manager', 'slug' => 'career_page', 'title' => "Can edit Career page", 'title_fr' => "Peut modifier la page de carrière" ],
            [ 'type' => 'manager', 'slug' => 'connect_jobmap', 'title' => "Have access to connect JobMap section", 'title_fr' => "Avoir accès pour connecter la section JobMap" ],
            // [ 'type' => 'manager', 'slug' => 'interviews_managers', 'title' => "Can change information of interviews by other managers", 'title_fr' => "Peut changer les informations sur les entretiens avec d'autres managers" ],
            // [ 'type' => 'manager', 'slug' => 'notes_managers', 'title' => "Can delete notes of other managers in note system", 'title_fr' => "Peut supprimer des notes d'autres gestionnaires dans le système de notes" ],

            [ 'type' => 'franchisee', 'slug' => 'locations', 'title' => "Can create/edit Locations", 'title_fr' => "Peut créer/éditer des emplacements" ],
            [ 'type' => 'franchisee', 'slug' => 'jobs', 'title' => "Can create/edit Jobs", 'title_fr' => "Peut créer/éditer des emplois" ],
            // [ 'type' => 'franchisee', 'slug' => 'franchisees', 'title' => "Can create/edit Franchisees", 'title_fr' => "Peut créer/éditer des franchisés" ],
            [ 'type' => 'franchisee', 'slug' => 'departments', 'title' => "Can create/edit Departments", 'title_fr' => "Peut créer/éditer des départements" ],
        ];
        DB::table('permits')->insert($data);
    }
}
