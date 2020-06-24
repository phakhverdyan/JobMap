<?php

namespace App\GraphQL\Query;

use App\Certificate;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use App\GraphQL\OptionalAuth;

class CertificatesQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Certificates'
    ];
    
    public function type()
    {
        return GraphQL::type('Certificates');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search by keywords'
            ],
            'default' => [
                'type' => Type::string(),
                'description' => 'Get default item by ids'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'locale',
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public $idCertificateCustom = 494;

    public function resolve($root, $args)
    {
        $query = Certificate::query();
        
        if (isset($args['keywords'])) {
            if (app()->isLocale('fr')) {
                $query->where('name_fr', 'like', '%' . $args['keywords'] . '%');
            }
            else {
                $query->where('name', 'like', '%' . $args['keywords'] . '%');
            }
        }

        if (app()->isLocale('fr')) {
            $query->orderBy('name_fr', 'asc');
        }

        $query->orderBy('name', 'asc');
        $data['items'] = $query->limit(20)->get()->toArray();
    
        if (isset($args['default'])) {
            $ids = explode(',', $args['default']);
            $default_query = Certificate::whereIn('id', $ids);

            if (app()->isLocale('fr')) {
                $default_query->orderBy('name_fr', 'asc');
            }

            $default_query->orderBy('name', 'asc');
            $data['default'] = $default_query->get()->toArray();
        }

        return $data;
    }
}
