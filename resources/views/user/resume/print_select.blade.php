@extends('layouts.main_user')

@section('content')

<div>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_user') 
            </div>
            <div class="col-12 col-lg-8 mx-auto text-center my-3 pt-4">
                <div class="row">
                    <div class="col-12">
                        <form>
                            <div class="card border-0">
                                <div class="card-header bg-white text-center py-4 border border-bottom-0">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="50px" height="50px" x="0px" y="0px" viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
                                            		<path d="M399.25,98.9h-12.4V71.3c0-39.3-32-71.3-71.3-71.3h-149.7c-39.3,0-71.3,32-71.3,71.3v27.6h-11.3
                                            			c-39.3,0-71.3,32-71.3,71.3v115c0,39.3,32,71.3,71.3,71.3h11.2v90.4c0,19.6,16,35.6,35.6,35.6h221.1c19.6,0,35.6-16,35.6-35.6
                                            			v-90.4h12.5c39.3,0,71.3-32,71.3-71.3v-115C470.55,130.9,438.55,98.9,399.25,98.9z M121.45,71.3c0-24.4,19.9-44.3,44.3-44.3h149.6
                                            			c24.4,0,44.3,19.9,44.3,44.3v27.6h-238.2V71.3z M359.75,447.1c0,4.7-3.9,8.6-8.6,8.6h-221.1c-4.7,0-8.6-3.9-8.6-8.6V298h238.3
                                            			V447.1z M443.55,285.3c0,24.4-19.9,44.3-44.3,44.3h-12.4V298h17.8c7.5,0,13.5-6,13.5-13.5s-6-13.5-13.5-13.5h-330
                                            			c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5h19.9v31.6h-11.3c-24.4,0-44.3-19.9-44.3-44.3v-115c0-24.4,19.9-44.3,44.3-44.3h316
                                            			c24.4,0,44.3,19.9,44.3,44.3V285.3z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"/>
                                            		<path d="M154.15,364.4h171.9c7.5,0,13.5-6,13.5-13.5s-6-13.5-13.5-13.5h-171.9c-7.5,0-13.5,6-13.5,13.5S146.75,364.4,154.15,364.4
                                            			z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"/>
                                            		<path d="M327.15,392.6h-172c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5h171.9c7.5,0,13.5-6,13.5-13.5S334.55,392.6,327.15,392.6z"
                                            			data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"/>
                                            		<path d="M398.95,151.9h-27.4c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5h27.4c7.5,0,13.5-6,13.5-13.5S406.45,151.9,398.95,151.9z"
                                            			data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"/>
                                            </svg>
                                            <h3 class="h3 mb-0 text-secondary"
                                                style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                                                Print resume</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="row no-gutters justify-content-center">
                                        <div class="col-12 border pb-3 pt-5">
                                            <div class="row justify-content-center">
                                                <div class="col-11">
                                                    <h5 class="h5 mb-3">Select resume format to print</h5>
                                                    <div class="d-flex flex-column flex-lg-row">
                                                        <div class="col-12 col-lg-6 mt-1">
                                                            <div class="card text-left mb-0 h-100">
                                                                <div class="card-header">
                                                                    <h6 class="h6 mb-0">Default layout</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-11">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3"  version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="150px" height="150px">
                                                                            		<path d="M431.279,0H80.721c-5.633,0-10.199,4.566-10.199,10.199v491.602c0,5.633,4.566,10.199,10.199,10.199h266.562    c2.705,0,5.298-1.075,7.212-2.987l83.997-83.998c1.912-1.912,2.987-4.506,2.987-7.212V10.199C441.479,4.566,436.912,0,431.279,0z     M357.463,477.196l-0.044-49.257l49.257,0.045L357.463,477.196z M421.081,212.151c-5.565,0.08-10.053,4.609-10.053,10.192    c0,5.583,4.489,10.112,10.052,10.192v175.064l-73.862-0.067c-0.003,0-0.006,0-0.009,0c-2.705,0-5.298,1.075-7.212,2.987    c-1.914,1.915-2.989,4.513-2.987,7.221l0.067,73.862H90.92v-259.06h0.873c5.633,0,10.199-4.566,10.199-10.199    c0-5.633-4.566-10.199-10.199-10.199H90.92V20.398h330.161V212.151z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"/>
                                                                            		<path d="M325.318,66.347h-55.833c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h55.833    c5.632,0,10.199-4.566,10.199-10.199C335.517,70.913,330.95,66.347,325.318,66.347z" fill="#4266ff"/>
                                                                            		<path d="M390.63,113.204H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,117.77,396.261,113.204,390.63,113.204z" fill="#4266ff"/>
                                                                            		<path d="M390.63,160.128H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,164.694,396.261,160.128,390.63,160.128z" fill="#4266ff"/>
                                                                            		<path d="M250.335,268.291H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h120.805    c5.633,0,10.199-4.566,10.199-10.199C260.535,272.857,255.968,268.291,250.335,268.291z" fill="#4266ff"/>
                                                                            		<path d="M391.649,309.543H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,314.109,397.281,309.543,391.649,309.543z" fill="#4266ff"/>
                                                                            		<path d="M391.649,350.853H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,355.419,397.281,350.853,391.649,350.853z" fill="#4266ff"/>
                                                                            		<path d="M239.681,421.227h-8.614c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h8.614    c5.633,0,10.199-4.566,10.199-10.199C249.88,425.793,245.314,421.227,239.681,421.227z" fill="#4266ff"/>
                                                                            		<path d="M195.825,421.227H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h66.295    c5.633,0,10.199-4.566,10.199-10.199C206.024,425.793,201.457,421.227,195.825,421.227z" fill="#4266ff"/>
                                                                            		<path d="M199.196,52.209c-5.223-5.574-12.599-8.771-20.237-8.771c-7.638,0-15.015,3.197-20.237,8.771    c-5.222,5.574-7.933,13.143-7.436,20.766l1.285,19.698c0.553,8.471,5.033,16.225,11.985,20.742    c4.374,2.843,9.389,4.263,14.403,4.263c5.014,0,10.029-1.421,14.403-4.263c6.953-4.517,11.433-12.272,11.985-20.742l1.285-19.698    C207.128,65.351,204.419,57.783,199.196,52.209z M186.276,71.647l-1.285,19.698c-0.136,2.081-1.161,3.935-2.743,4.963    c-1.999,1.298-4.581,1.297-6.581,0c-1.582-1.028-2.607-2.883-2.743-4.963l-1.285-19.698c-0.133-2.045,0.565-3.995,1.966-5.491    s3.302-2.319,5.352-2.319c2.05,0,3.95,0.824,5.352,2.319C185.711,67.651,186.41,69.601,186.276,71.647z" fill="#4266ff"/>
                                                                            		<path d="M244.543,169.528l-2.229-12.302c-3.089-17.054-16.601-30.666-33.624-33.872c-2.57-0.483-5.196-0.728-7.807-0.728h-6.712    c-2.705,0-5.299,1.075-7.212,2.987c-2.137,2.137-4.978,3.314-8,3.314c-3.022,0-5.864-1.177-8-3.314    c-1.912-1.912-4.507-2.987-7.212-2.987h-6.712c-2.611,0-5.237,0.245-7.809,0.729c-17.021,3.206-30.533,16.816-33.623,33.871    l-2.229,12.302c-0.539,2.975,0.269,6.035,2.208,8.356c1.937,2.32,4.804,3.661,7.827,3.661h111.097c3.023,0,5.89-1.341,7.828-3.661    C244.273,175.564,245.082,172.503,244.543,169.528z M135.624,161.147l0.051-0.285c1.593-8.793,8.556-15.81,17.325-17.461    c1.329-0.25,2.685-0.377,4.035-0.377h2.948c11.209,8.383,26.744,8.383,37.953,0h2.948c1.348,0,2.706,0.127,4.034,0.376    c8.77,1.651,15.733,8.669,17.326,17.462l0.052,0.285H135.624z" fill="#4266ff"/>
                                                                            		<path d="M357.875,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C368.074,216.71,363.507,212.143,357.875,212.143z" fill="#4266ff"/>
                                                                            		<path d="M319.862,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C330.062,216.71,325.494,212.143,319.862,212.143z" fill="#4266ff"/>
                                                                            		<path d="M129.804,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C140.003,216.71,135.437,212.143,129.804,212.143z" fill="#4266ff"/>
                                                                            		<path d="M243.84,212.143h-12.671c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.671    c5.633,0,10.199-4.566,10.199-10.199C254.039,216.71,249.473,212.143,243.84,212.143z" fill="#4266ff"/>
                                                                            		<path d="M205.828,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C216.027,216.71,211.461,212.143,205.828,212.143z" fill="#4266ff"/>
                                                                            		<path d="M395.886,212.143h-12.672c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.672    c5.632,0,10.199-4.566,10.199-10.199C406.085,216.71,401.518,212.143,395.886,212.143z" fill="#4266ff"/>
                                                                            		<path d="M281.851,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C292.05,216.71,287.483,212.143,281.851,212.143z" fill="#4266ff"/>
                                                                            		<path d="M167.817,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C178.016,216.71,173.45,212.143,167.817,212.143z" fill="#4266ff"/>
                                                                            	</svg>
                                                                                <h5 class="h5 mb-0 font-weight-bold mb-3">Plain text format</h5>
                                                                                <div class="d-inline-block bg-white">
                                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                                    <button type="button" class="btn btn-lg btn-outline-primary">Print preview</button>
                                                                                    <button class="btn btn-lg btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        Download
                                                                                    </button>
                                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                                        <button class="dropdown-item" type="button">PDF</button>
                                                                                        <button class="dropdown-item" type="button">DOC</button>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6 mt-1">
                                                            <div class="card text-left mb-0 h-100">
                                                                <div class="card-header">
                                                                    <h6 class="h6 mb-0">Coming soon</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-11">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3" fill-opacity="0.2"  version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="150px" height="150px">
                                                                            		<path d="M431.279,0H80.721c-5.633,0-10.199,4.566-10.199,10.199v491.602c0,5.633,4.566,10.199,10.199,10.199h266.562    c2.705,0,5.298-1.075,7.212-2.987l83.997-83.998c1.912-1.912,2.987-4.506,2.987-7.212V10.199C441.479,4.566,436.912,0,431.279,0z     M357.463,477.196l-0.044-49.257l49.257,0.045L357.463,477.196z M421.081,212.151c-5.565,0.08-10.053,4.609-10.053,10.192    c0,5.583,4.489,10.112,10.052,10.192v175.064l-73.862-0.067c-0.003,0-0.006,0-0.009,0c-2.705,0-5.298,1.075-7.212,2.987    c-1.914,1.915-2.989,4.513-2.987,7.221l0.067,73.862H90.92v-259.06h0.873c5.633,0,10.199-4.566,10.199-10.199    c0-5.633-4.566-10.199-10.199-10.199H90.92V20.398h330.161V212.151z" fill="#868e96"/>
                                                                            		<path d="M325.318,66.347h-55.833c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h55.833    c5.632,0,10.199-4.566,10.199-10.199C335.517,70.913,330.95,66.347,325.318,66.347z" fill="#868e96"/>
                                                                            		<path d="M390.63,113.204H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,117.77,396.261,113.204,390.63,113.204z" fill="#868e96"/>
                                                                            		<path d="M390.63,160.128H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,164.694,396.261,160.128,390.63,160.128z" fill="#868e96"/>
                                                                            		<path d="M250.335,268.291H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h120.805    c5.633,0,10.199-4.566,10.199-10.199C260.535,272.857,255.968,268.291,250.335,268.291z" fill="#868e96"/>
                                                                            		<path d="M391.649,309.543H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,314.109,397.281,309.543,391.649,309.543z" fill="#868e96"/>
                                                                            		<path d="M391.649,350.853H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,355.419,397.281,350.853,391.649,350.853z" fill="#868e96"/>
                                                                            		<path d="M239.681,421.227h-8.614c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h8.614    c5.633,0,10.199-4.566,10.199-10.199C249.88,425.793,245.314,421.227,239.681,421.227z" fill="#868e96"/>
                                                                            		<path d="M195.825,421.227H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h66.295    c5.633,0,10.199-4.566,10.199-10.199C206.024,425.793,201.457,421.227,195.825,421.227z" fill="#868e96"/>
                                                                            		<path d="M199.196,52.209c-5.223-5.574-12.599-8.771-20.237-8.771c-7.638,0-15.015,3.197-20.237,8.771    c-5.222,5.574-7.933,13.143-7.436,20.766l1.285,19.698c0.553,8.471,5.033,16.225,11.985,20.742    c4.374,2.843,9.389,4.263,14.403,4.263c5.014,0,10.029-1.421,14.403-4.263c6.953-4.517,11.433-12.272,11.985-20.742l1.285-19.698    C207.128,65.351,204.419,57.783,199.196,52.209z M186.276,71.647l-1.285,19.698c-0.136,2.081-1.161,3.935-2.743,4.963    c-1.999,1.298-4.581,1.297-6.581,0c-1.582-1.028-2.607-2.883-2.743-4.963l-1.285-19.698c-0.133-2.045,0.565-3.995,1.966-5.491    s3.302-2.319,5.352-2.319c2.05,0,3.95,0.824,5.352,2.319C185.711,67.651,186.41,69.601,186.276,71.647z" fill="#868e96"/>
                                                                            		<path d="M244.543,169.528l-2.229-12.302c-3.089-17.054-16.601-30.666-33.624-33.872c-2.57-0.483-5.196-0.728-7.807-0.728h-6.712    c-2.705,0-5.299,1.075-7.212,2.987c-2.137,2.137-4.978,3.314-8,3.314c-3.022,0-5.864-1.177-8-3.314    c-1.912-1.912-4.507-2.987-7.212-2.987h-6.712c-2.611,0-5.237,0.245-7.809,0.729c-17.021,3.206-30.533,16.816-33.623,33.871    l-2.229,12.302c-0.539,2.975,0.269,6.035,2.208,8.356c1.937,2.32,4.804,3.661,7.827,3.661h111.097c3.023,0,5.89-1.341,7.828-3.661    C244.273,175.564,245.082,172.503,244.543,169.528z M135.624,161.147l0.051-0.285c1.593-8.793,8.556-15.81,17.325-17.461    c1.329-0.25,2.685-0.377,4.035-0.377h2.948c11.209,8.383,26.744,8.383,37.953,0h2.948c1.348,0,2.706,0.127,4.034,0.376    c8.77,1.651,15.733,8.669,17.326,17.462l0.052,0.285H135.624z" fill="#868e96"/>
                                                                            		<path d="M357.875,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C368.074,216.71,363.507,212.143,357.875,212.143z" fill="#868e96"/>
                                                                            		<path d="M319.862,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C330.062,216.71,325.494,212.143,319.862,212.143z" fill="#868e96"/>
                                                                            		<path d="M129.804,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C140.003,216.71,135.437,212.143,129.804,212.143z" fill="#868e96"/>
                                                                            		<path d="M243.84,212.143h-12.671c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.671    c5.633,0,10.199-4.566,10.199-10.199C254.039,216.71,249.473,212.143,243.84,212.143z" fill="#868e96"/>
                                                                            		<path d="M205.828,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C216.027,216.71,211.461,212.143,205.828,212.143z" fill="#868e96"/>
                                                                            		<path d="M395.886,212.143h-12.672c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.672    c5.632,0,10.199-4.566,10.199-10.199C406.085,216.71,401.518,212.143,395.886,212.143z" fill="#868e96"/>
                                                                            		<path d="M281.851,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C292.05,216.71,287.483,212.143,281.851,212.143z" fill="#868e96"/>
                                                                            		<path d="M167.817,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C178.016,216.71,173.45,212.143,167.817,212.143z" fill="#868e96"/>
                                                                            	</svg>
                                                                                <h5 class="h5 mb-0 font-weight-bold mb-3">More resume layouts coming soon</h5>
                                                                                <div class="dropdown">
                                                                                    <!-- <button class="btn btn-lg btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        Download
                                                                                    </button>
                                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                                        <button class="dropdown-item" type="button">PDF</button>
                                                                                        <button class="dropdown-item" type="button">DOC</button>
                                                                                    </div> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection