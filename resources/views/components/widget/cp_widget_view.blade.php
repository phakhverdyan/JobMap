<style type="text/css">
	.widget_view_job{
	    position: absolute;
	    right: 15px;
	    bottom: 0;
	    width: 620px;
	    z-index: 1;
	    background: #fff;
	    height: 500px;
	    overflow-y: auto;
	    -webkit-box-shadow: 0px 0px 19px -1px rgba(0,0,0,0.31);
		-moz-box-shadow: 0px 0px 19px -1px rgba(0,0,0,0.31);
		box-shadow: 0px 0px 19px -1px rgba(0,0,0,0.31);
		padding: 15px;
		box-sizing: border-box;
		display: none;
	}
</style>
<div class="widget_view_job">
	<div class="w-100 text-left mb-2">
        <button type="button" class="close close_crWidget-job" style="float: none; cursor: pointer;">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <p><button class="btn btn-primary btn-block">Apply to this Job</button></p>
    {{--<div class="d-flex justify-content-between">
    	<div class="align-self-center">
    		<p class="mb-1"><a href="#">View all location that this job is available</a></p>
			<p><a href="#">View all available jobs of this location</a></p>
    	</div>
    	<div class="align-self-center">
    		<a data-toggle="modal" data-target="#ShareModal">
                @svg('/img/share.svg',[
                    'class' => 'sharebutton_svg_class',
                ])
            </a>
    	</div>
    </div>--}}
	
    <div class="text-left">
    	<p class="mb-0 align-self-center mxa-0 business_name_color" style="font-size: 25px;">
    	  Scheduler
    	</p>
    	<p class="mb-1 align-self-center mxa-0 business_name_color" id="job_title" style="font-size: 20px;">Administrative</p>
    	<p class="mb-3"><i class="glyphicon bfh-flag-US"></i>
            <strong>Old Meadow Road 1760, McLean, United States</strong>
        </p>
        <div class="mb-3">
            <p class="mb-0"><strong>Languages Spoken</strong> English,français</p>
            <p class="mb-0" id="job-hours"><strong>Hours a week</strong> 40 Hours</p>
            <p class="mb-0"><strong>Career Level</strong> Intermediate</p>
        </div>
        <p class="mb-0">
        	Join a team rich in diversity, respect, and growth to make the world a safer place for families, communities, and businesses. At GardaWorld, we take our security responsibility seriously and strive to inspire trust. GardaWorld offers personal growth and advancement opportunities, fosters a collaborative environment, and encourages team cooperation. You can make a difference in a company that gives you latitude to deliver the best customer service. Interested in an enriching and meaningful career? Join our ranks!
        </p>
    </div>
    <hr>
    <p class="mb-0 text-center">
        Powered By JobMap, visit Full Career Page of <a href="#"><strong>Name of business</strong></a>
    </p>
</div>