@extends('layouts.main_business')

@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 text-center my-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-header bg-white text-center py-4 border border-bottom-0">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <svg height="50px" viewBox="0 0 1792 1792" width="50px"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1216 1568v192q0 14-9 23t-23 9h-256q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h256q14 0 23 9t9 23zm-480-128q0 12-10 24l-319 319q-10 9-23 9-12 0-23-9l-320-320q-15-16-7-35 8-20 30-20h192v-1376q0-14 9-23t23-9h192q14 0 23 9t9 23v1376h192q14 0 23 9t9 23zm672-384v192q0 14-9 23t-23 9h-448q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h448q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-640q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h640q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-832q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h832q14 0 23 9t9 23z"
                                                  fill="#4266ff"/>
                                        </svg>
                                        <h3 class="h3 mb-0 text-secondary"
                                            style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                                            Edit candidate pipeline</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-12 border pb-3 pt-5">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <h6 class="h6 mb-3 text-left">Add new candidate pipeline
                                                    section</h6>
                                                <div class="input-group mb-3">
                                                        <span class="input-group-addon" id="basic-addon1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </span>
                                                    <input type="text" class="form-control bg-light"
                                                           placeholder="Enter pipeline">
                                                    <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                        </span>
                                                    <span class="input-group-btn">
                                                            <button class="btn btn-outline-primary"
                                                                    type="button">Add</button>
                                                        </span>
                                                </div>
                                                <h6 class="h6 mb-3 text-left">Drag pipeline sections to adjust the
                                                    order</h6>
                                                <div id="pipeline-sortable" class="p-0 m-0">
                                                    <div class="ui-state-default d-flex align-items-center mb-3">
                                                        <svg version="1.1" class="mx-2"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="25px" height="25px" viewBox="0 0 16 16">
                                                            <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
                                                            <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
                                                            <path fill="#B7B7B7"
                                                                  d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
                                                        </svg>
                                                        <div class="input-group mb-0">
                                                            <input type="text" class="form-control bg-light"
                                                                   value="New" readonly>
                                                            <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0 mx-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																			 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            <span class="input-group-btn">
                                                                    <button class="btn mx-0" type="button"
                                                                            style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="ui-state-default d-flex align-items-center mb-3">
                                                        <svg version="1.1" class="mx-2"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="25px" height="25px" viewBox="0 0 16 16">
                                                            <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
                                                            <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
                                                            <path fill="#B7B7B7"
                                                                  d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
                                                        </svg>
                                                        <div class="input-group mb-0">
                                                            <input type="text" class="form-control bg-light"
                                                                   value="Viewed" readonly>
                                                            <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0 mx-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            <span class="input-group-btn">
                                                                    <button class="btn mx-0" type="button"
                                                                            style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="ui-state-default d-flex align-items-center mb-3">
                                                        <svg version="1.1" class="mx-2"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="25px" height="25px" viewBox="0 0 16 16">
                                                            <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
                                                            <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
                                                            <path fill="#B7B7B7"
                                                                  d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
                                                        </svg>
                                                        <div class="input-group mb-0">
                                                            <input type="text" class="form-control bg-light"
                                                                   value="Contacted" readonly>
                                                            <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0 mx-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            <span class="input-group-btn">
                                                                    <button class="btn mx-0" type="button"
                                                                            style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="ui-state-default d-flex align-items-center mb-3">
                                                        <svg version="1.1" class="mx-2"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="25px" height="25px" viewBox="0 0 16 16">
                                                            <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
                                                            <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
                                                            <path fill="#B7B7B7"
                                                                  d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
                                                        </svg>
                                                        <div class="input-group mb-0">
                                                            <input type="text" class="form-control bg-light"
                                                                   value="Interview" readonly>
                                                            <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0 mx-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            <span class="input-group-btn">
                                                                    <button class="btn mx-0" type="button"
                                                                            style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="ui-state-default d-flex align-items-center mb-3">
                                                        <svg version="1.1" class="mx-2"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="25px" height="25px" viewBox="0 0 16 16">
                                                            <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
                                                            <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
                                                            <path fill="#B7B7B7"
                                                                  d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
                                                        </svg>
                                                        <div class="input-group mb-0">
                                                            <input type="text" class="form-control bg-light"
                                                                   value="Moved" readonly>
                                                            <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0 mx-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            <span class="input-group-btn">
                                                                    <button class="btn mx-0" type="button"
                                                                            style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="ui-state-default d-flex align-items-center mb-3">
                                                        <svg version="1.1" class="mx-2"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             width="25px" height="25px" viewBox="0 0 16 16">
                                                            <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
                                                            <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
                                                            <path fill="#B7B7B7"
                                                                  d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
                                                        </svg>
                                                        <div class="input-group mb-0">
                                                            <input type="text" class="form-control bg-light"
                                                                   value="Employees" readonly>
                                                            <span class="input-group-btn">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-outline-primary dropdown-toggle rounded-0 mx-0"
                                                                                type="button"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																				 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                        </button>
                                                                        <div class="dropdown-menu w-100"
                                                                             style="min-width: 0">
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                            <button class="dropdown-item text-center px-2"
                                                                                    type="button">
                                                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" x="0px" y="0px"
																					 viewBox="0 0 482.5 482.5" style="enable-background:new 0 0 482.5 482.5;" xml:space="preserve">
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
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            <span class="input-group-btn">
                                                                    <button class="btn mx-0" type="button"
                                                                            style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
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
</div>
@endsection