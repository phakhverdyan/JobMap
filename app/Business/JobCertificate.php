<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobCertificate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_job_certificates';
    
    /**
     * Get the certificate
     */
    public function certificate()
    {
        return $this->hasOne('App\Certificate', 'id', 'certificate_id');
    }
}
