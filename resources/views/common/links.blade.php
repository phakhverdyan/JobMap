@extends('layouts.common_user')

@section('content')
    <ul>
        <li>*   - no wireframes</li>
        <li>#td - to design</li>
        <li>#ti - to integrate</li>
        <li>#!  - important changes before integration</li>
        <li>#improve  - improve</li>
        <li>#rethink  - rethink</li>
    </ul>
    <ul>
        <li>common</li>
        <li><a href="{!! url('/') !!}">/</a></li>
        <li><a href="{!! url('/site_map') !!}">/site_map*</a></li>
        <li><a href="{!! url('/about') !!}">/about*</a></li>
        <li><a href="{!! url('/contact') !!}">/contact*</a></li>
        <li><a href="{!! url('/privacy-policy') !!}">/privacy-policy #td</a></li>
        <li><a href="{!! url('/terms-of-service') !!}">/terms-of-service #td</a></li>
        <li><a href="{!! url('/faq') !!}">/faq #ti</a></li>
        <li><a href="{!!  url('/how-it-works') !!}">/how-it-works #td andrey</a></li>
        <li><a href="{!! url('/how-it-works-together') !!}">/how-it-works-together #td Kolya</a></li>
        <li><a href="{!! url('/scan/business') !!}">/scan/business #ti</a></li>
        <li><a href="{!! url('/scan/business/new') !!}">/scan/business/new #ti</a></li>
        <li><a href="{!! url('/scan/business/exist') !!}">/scan/business/exist #ti</a></li>
        <li><a href="{!! url('/refrer') !!}">/refrer</a></li>
        
        <li><a href="{!! url('/signup') !!}">/signup #td!</a></li>
        <li><a href="{!! url('/candidate/profile/url') !!}">/candidate/profile/url #td!</a></li>
        <li><a href="{!! url('/candidate/profile/url/edit') !!}">/candidate/profile/url/edit #td!</a></li>
        <li><a href="#" class="show-sign-up" data-toggle="modal" data-target="#signUpModal">/modal_signup</a></li>
        <li><a href="#" class="show-sign-in" data-toggle="modal" data-target="#signInModal">/modal_signin</a></li>
        <li><a href="#" class="show-reset-password" data-toggle="modal" data-target="#resetPasswordModal">/modal_show-reset-password</a></li>
        <li><a href="#" class="show-contact-form"   data-toggle="modal" data-target="#contactFormModal">/modal_show-contact-form</a></li>
        <li>user</li>
        <li><a href="{!! url('/user/feedback') !!}">/user/feedback</a></li>
        <li><a href="{!! url('/user/landing') !!}">/user/landing #improve</a></li>
        <li><a href="{!! url('/user/career') !!}">/user/career #rethink</a></li>
        <li><a href="{!! url('/user/references') !!}">/user/references #ti</a></li>
        <!-- <li><a href="{!! url('/job/position') !!}">/job/position</a></li> -->
        <li><a href="{!! url('/user/resume/create') !!}">/user/resume/create #ti</a></li>
        <li><a href="{!! url('/user/resume/manage') !!}">/user/resume/manage #td!</a></li>
        <li><a href="{!! url('/user/resume/view') !!}">/user/resume/view  #td!</a></li>
        <li><a href="{!! url('/user/resume/congratulations') !!}">/user/resume/congratulations #rethink</a></li>
        <li><a href="{!! url('/user/dashboard') !!}">/user/dashboard  #ti</a></li>
        <li><a href="{!! url('/user/messages') !!}">/user/messages #td! Max</a></li>
        <li><a href="{!! url('/user/settings') !!}">/user/settings #fix</a></li>
        <li><a href="{!! url('/user/resume/sent') !!}">/user/resume/sent * Ced</a></li>
        <li><a href="{!! url('/user/resume/print-select') !!}">/user/resume/print-select #td!</a></li>
        <li><a href="{!! url('/user/resume/print-preview') !!}">/user/resume/print-preview * Ced</a></li>
        <li>business</li>
        <li><a href="{!! url('/business/signup') !!}">/business/signup  #td!</a></li>
        <li><a href="{!! url('/business-landing') !!}">/business-landing #ti</a></li>
        <li><a href="{!! url('/business/pricing') !!}">/business/pricing #td</a></li>
        <li><a href="{!! url('/business/pricing/features') !!}">/business/pricing/features #td</a></li>
        <li><a href="{!! url('/business/billing') !!}">/business/billing #ti</a></li>
        <li><a href="{!! url('/business/billing/modify') !!}">/business/billing/modify #ti</a></li>
        <li><a href="{!! url('/business/billing/pdf-ca') !!}">/business/billing/pdf-ca</a></li>
        <li><a href="{!! url('/business/billing/pdf-not-ca') !!}">/business/billing/pdf-not-ca</a></li>
        <li><a href="{!! url('/business/dashboard') !!}">/business/dashboard #ti</a></li>
        <li><a href="{!! url('/business/dashboard/incomplete') !!}">/business/incomplete</a></li>
        <li><a href="{!! url('/business/dashboard/no-business') !!}">/business/dashboard/no-business #add to routes</a></li>
        <li><a href="{!! url('/business/dashboard/no-button') !!}">/business/dashboard/no-button #add to routes</a></li>
        <li><a href="{!! url('/business/candidate/edit') !!}">/business/candidate/edit #td!</a></li>

        <li><a href="{!! url('/business/candidate/list/profie/view') !!}">/business/candidate/list/profie/view</a></li>
        <li><a href="{!! url('/business/candidate/from/url') !!}">/business/candidate/from/url</a></li>

        <li><a href="{!! url('/business/branch/locations') !!}">/business/branch/locations #td!</a></li>
        <li><a href="{!! url('/business/branch/add') !!}">/business/branch/add #td!</a></li>
        <li><a href="{!! url('/business/job/add') !!}">/business/job/add #td!</a></li>
        <li><a href="{!! url('/business/job/manage') !!}">/business/job/manage #td!</a></li>
        <li><a href="{!! url('/business/messages') !!}">/business/messages #td! Max</a></li>
        <!-- <li><a href="{!! url('/business/departments/edit') !!}">/business/department/edit</a></li> -->
        <li><a href="{!! url('/business/department/edit') !!}">/business/department/edit</a></li>
        <li><a href="{!! url('/business/department/add') !!}">/business/department/add</a></li>
        
        <li><a href="{!! url('/business/profile/edit') !!}">/business/profile/edit #td! Ced</a></li>
        <li><a href="{!! url('/business/settings') !!}">/business/settings #td!</a></li>
        <li><a href="{!! url('/business/integrations') !!}">/business/integrations * Ced</a></li>
        <li><a href="{!! url('/business/button/manager') !!}">/business/button/manager #td! Andrey</a></li>
        <li><a href="{!! url('/business/button/all') !!}">/business/button/all #td! Andrey</a></li>
        <li><a href="{!! url('/business/manage/manager') !!}">/business/manage/manager #td!</a></li>
        <li><a href="{!! url('/business/manage/manager/add') !!}">/business/manage/manager/add  #td!</a></li>
        <li><a href="{!! url('/business/integrated-tools') !!}">/business/integrated-tools</a></li>
        <!-- Same pages on manage/manager -->
        <!-- <li><a href="{!! url('/business/manage/job') !!}">/business/manage/job</a></li>
        <li><a href="{!! url('/business/manage/job/add') !!}">/business/manage/job/add</a></li> -->

        <li><a href="{!! url('/business/candidate/manage') !!}">/business/candidate/manage  #td!</a></li>
        <li><a href="{!! url('/business/candidate/manage-ats') !!}">/business/candidate/manage-ats  #td!</a></li>
        <li><a href="{!! url('/business/employee/manage') !!}">/business/employee/manage</a></li>
        <li><a href="{!! url('/business/view/career/page') !!}">/business/view/career/page #td!</a></li>
        <li><a href="{!! url('/jobmap/view/location') !!}">/jobmap/view/location #td!</a></li>
        <li><a href="{!! url('/jobmap/country') !!}">/jobmap/country</a></li>
        <li><a href="{!! url('/jobmap/region') !!}">/jobmap/region</a></li>
        <li><a href="{!! url('/jobmap/city') !!}">/jobmap/city</a></li>
        <li><a href="{!! url('/jobmap/street') !!}">/jobmap/street</a></li>
        <li><a href="{!! url('/jobmap/address') !!}">/jobmap/address</a></li>
        <li><a href="{!! url('/jobmap/view/job') !!}">/jobmap/view/job</a></li>
        <li><a href="{!! url('/jobmap/landing') !!}">/jobmap/landing</a></li>
        <li><a href="{!! url('/jobmap/how-jobmap-cloudresume-work') !!}">/jobmap/how-jobmap-cloudresume-work</a></li>
    </ul>
    <hr>
    <ul>
        <li><a href="{!! url('/uikit') !!}">UIkit</a></li>
        <li><a href="{!! url('/ifsendfullpage') !!}">ifsendfullpage</a></li>
    </ul>


@endsection