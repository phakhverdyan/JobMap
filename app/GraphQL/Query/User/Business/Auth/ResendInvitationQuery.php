<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Mail\SendInvitationATS;
use App\Business\Administrator;
use App\Business\Billing;
use App\Business\Import;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResendInvitationQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Resend invitation'
    ];

    public function type()
    {
        return GraphQL::type('Ats');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the invitation'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ]

        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        $this->checkBusinessAccess($args['business_id'], [
            \App\Business\Administrator::MANAGER_ROLE,
            \App\Business\Administrator::BRANCH_ROLE,
        ]);

        $business = \App\Business::where('id', $args['business_id'])->first();
        
        if (!$import = Import::where('business_id', $business->id)->where('id', $args['id'])->first()) {
            throw new \Exception('Import does not exist');
        }

        $import->affiliate_token = md5(str_random(24));
        ++$import->send_count;
        $import->sended_at = new \DateTime;
        $import->save();
        Mail::to($import->email)->queue(new SendInvitationATS($business, $import, 'INITIAL', $this->auth->language_prefix));
        $import->token = $this->token;
        return $import;
    }
}
