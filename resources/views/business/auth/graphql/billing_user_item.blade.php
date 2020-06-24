<div class="row">

    <div class="card border-0 manager-item  col-lg-12" data-item-id="{{ $args['id'] }}">
        <div class="card-header bg-white border-0 py-3 BobikHoverEffect" role="tab" id="heading{{ $args['id'] }}">
            <h5 class="mb-0 mt-0">
                <a class="" style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 437.955 437.955" style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="22px" class="mr-2"><g><g>
                                <path d="M328.728,64.036h-72.25V10c0-5.522-4.478-10-10-10h-55c-5.522,0-10,4.478-10,10v54.036h-72.25c-27.57,0-50,22.43-50,50   v273.919c0,27.57,22.43,50,50,50h219.5c27.57,0,50-22.43,50-50V114.036C378.728,86.466,356.298,64.036,328.728,64.036z M201.478,20   h35v73.955h-35V20z M358.728,387.955c0,16.542-13.458,30-30,30h-219.5c-16.542,0-30-13.458-30-30V114.036c0-16.542,13.458-30,30-30   h72.25v9.919h-10c-5.522,0-10,4.478-10,10s4.478,10,10,10h95c5.522,0,10-4.478,10-10s-4.478-10-10-10h-10v-9.919h72.25   c16.542,0,30,13.458,30,30V387.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                <path d="M218.978,51c5.79,0,10.5-4.71,10.5-10.5s-4.71-10.5-10.5-10.5s-10.5,4.71-10.5,10.5S213.188,51,218.978,51z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                <path d="M290.978,357.955h-144c-5.522,0-10,4.478-10,10s4.478,10,10,10h144c5.522,0,10-4.478,10-10S296.5,357.955,290.978,357.955z   " data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                <path d="M176.978,267.955c0,5.522,4.478,10,10,10h64c5.522,0,10-4.478,10-10s-4.478-10-10-10h-64   C181.455,257.955,176.978,262.433,176.978,267.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                <path d="M248.978,217.955c0-16.542-13.458-30-30-30s-30,13.458-30,30s13.458,30,30,30S248.978,234.497,248.978,217.955z    M208.978,217.955c0-5.514,4.486-10,10-10s10,4.486,10,10s-4.486,10-10,10S208.978,223.469,208.978,217.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                <path d="M290.978,153.955h-144c-5.522,0-10,4.478-10,10v144c0,5.522,4.478,10,10,10h144c5.522,0,10-4.478,10-10v-31.892   c0-5.522-4.478-10-10-10s-10,4.478-10,10v21.892h-124v-124h124v68.001c0,5.522,4.478,10,10,10s10-4.478,10-10v-78.001   C300.978,158.433,296.5,153.955,290.978,153.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                            </g></g>
                </svg>
                    {{ $args['first_name'].' '.$args['last_name'].' '.$args['email']}}
                    <span class="pull-right"><strong style="font-size: 16px;">Period: {{ $period_start.' - '.$period_end }}<br/> {{$amount_due}} {{$contract_type}}</strong></span>
                </a>

            </h5>
        </div>
    </div>
</div>

<!-- ONE LOCATION EOF -->

