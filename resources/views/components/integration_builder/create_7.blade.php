<div class="col-12 pb-3 pt-3 form-tab-content" data-builder-step="job_words">
    <div class="row justify-content-center text-left">
        <div class="col-11">
            <div class="form-group mb-5">
				{!! trans('integration.boards.title') !!}
                <div class="d-flex justify-content-between mb-3 flex-wrap flex-column flex-lg-row mxa-auto">
                	<div class="text-center mt-1"><img src="{{ asset('img//integration-icons/monster.png') }}" style="width: 90px;"></div>
                	<div class="text-center mt-1">
                		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 217.7 46" enable-background="new 0 0 217.7 46" xml:space="preserve" width="90" height="25" style="vertical-align: middle;">
							<path fill-rule="evenodd" clip-rule="evenodd" fill="#EE3551" d="M126.8,34.4c-6.3,0-11.4-5.1-11.4-11.4c0-6.3,5.1-11.4,11.4-11.4  c6.3,0,11.4,5.1,11.4,11.4C138.2,29.3,133.1,34.4,126.8,34.4z M126.8,16.9c-3.4,0-6.1,2.7-6.1,6.1c0,3.4,2.7,6.1,6.1,6.1  c3.4,0,6.1-2.7,6.1-6.1C132.9,19.7,130.1,16.9,126.8,16.9z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="#EE3551" d="M156.7,37.7c-8.1,0-14.6-6.6-14.6-14.7c0-8.1,6.6-14.7,14.6-14.7  c8.1,0,14.7,6.6,14.7,14.7C171.4,31.1,164.8,37.7,156.7,37.7z M156.7,13.7c-5.1,0-9.3,4.2-9.3,9.3c0,5.2,4.2,9.3,9.3,9.3  c5.1,0,9.3-4.2,9.3-9.3C166.1,17.9,161.9,13.7,156.7,13.7z"/>
							<path fill="#181417" d="M212.1,36.9V21.5c0-5.3-2.1-7.9-6.2-7.9c-6.1,0-6.2,5.2-6.3,7.7l0,0.2v15.4H194V21.4l0-0.2  c-0.1-2.5-0.2-7.7-6.3-7.7c-4.1,0-6.2,2.7-6.2,7.9v15.4h-5.6V20.2c0-2.6,0.5-4.9,1.6-6.8c1.9-3.3,5.4-5,9.8-5c5.5,0,8.3,2.6,9.5,4.4  c1.4-2.1,4.2-4.4,9.5-4.4c4.4,0,7.9,1.8,9.8,5c1,1.9,1.6,4.2,1.6,6.8v16.7H212.1z"/>
							<path fill="#181417" d="M28.6,37.6c-9.2,0-14.9-7.7-14.9-14.8c0-7.9,6.7-14.4,14.9-14.4c8.2,0,15,6.5,15,14.5  C43.5,30,37.8,37.6,28.6,37.6z M28.6,13.6c-5.8,0-9.3,4.9-9.3,9.4c0,4.5,3.6,9.4,9.3,9.4c5.2,0,9.4-4.3,9.4-9.5  C37.9,18.4,34.4,13.6,28.6,13.6z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="#010101" d="M96.6,37.6c-1.5,0-3-0.2-4.5-0.7c-6.1-1.9-10.2-7.8-10.1-14.5  l0-0.2V0h5.6v11.4c2.6-2,5.8-3.1,9.1-3.1c8.1,0,14.7,6.6,14.7,14.7c0,3.9-1.5,7.6-4.3,10.4C104.2,36.1,100.5,37.6,96.6,37.6  C96.6,37.6,96.6,37.6,96.6,37.6z M96.6,13.6c-0.3,0-0.6,0-0.9,0c-4.3,0.4-7.8,3.8-8.3,8c-0.3,2.7,0.5,5.4,2.2,7.4  c1.8,2,4.3,3.2,7,3.2c0.4,0,0.8,0,1.2-0.1c4.3-0.5,7.7-4,8.1-8.3c0.3-2.7-0.6-5.2-2.4-7.2C101.7,14.7,99.2,13.6,96.6,13.6z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="#181417" d="M62.6,37.6c-1.5,0-3-0.2-4.5-0.7C52,35.1,47.9,29.1,48,22.4l0-0.2  V0h5.6v11.4c2.6-2,5.8-3.1,9.1-3.1c8.1,0,14.7,6.6,14.7,14.7c0,3.9-1.5,7.6-4.3,10.4C70.2,36.1,66.5,37.6,62.6,37.6  C62.6,37.6,62.6,37.6,62.6,37.6z M62.6,13.6c-0.3,0-0.6,0-0.9,0c-4.3,0.4-7.8,3.8-8.3,8c-0.3,2.7,0.5,5.4,2.2,7.4  c1.8,2,4.3,3.2,7,3.2c0.4,0,0.8,0,1.2-0.1c4.3-0.5,7.7-4,8.1-8.3c0.3-2.7-0.6-5.2-2.4-7.2C67.8,14.7,65.3,13.6,62.6,13.6z"/>
							<path fill="#181417" d="M0,46v-5.8l0.2,0c3.2-0.2,3.2-2.5,3.2-5.9V14.6H9v19.7c0,4.2,0,6.8-3,9.3C4.3,45.1,2.1,46,0.2,46H0z"/>
							<circle fill="#181417" cx="6" cy="8.5" r="3.4"/>
							</svg>
                	</div>
                	<div class="text-center mt-1">
                		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 438.4 96.3" width="100" height="25"  style="vertical-align: middle;">
						  <path fill="#343e45" d="M331.3 24.8c0-2.7 2.2-4.8 5.1-4.8 3.1 0 5.2 2.2 5.2 4.8 0 2.6-2.2 4.8-5.2 4.8-2.9.1-5.1-2.2-5.1-4.8zm8.8 10.5c.2 0 .4.2.4.4v31.5c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c0-.2.2-.4.4-.4h7.3zM73.7 59.8l25-31.8c.1-.1 0-.3-.2-.3H74.4c-.2 0-.4-.2-.4-.4v-6.9c0-.2.2-.4.4-.4h35.8c.2 0 .4.2.4.4v7.1c0 .1 0 .2-.1.3L85.2 59.6c-.1.1 0 .3.2.3h24.8c.2 0 .4.2.4.4v6.9c0 .2-.2.4-.4.4H74c-.2 0-.4-.2-.4-.4v-7.1c0-.1.1-.2.1-.3zm95.7-39.4c0-.2.2-.4.4-.4h14.9c13.7 0 19 5 19 13.6 0 8.9-6.4 12.6-10.7 13.1-.1 0-.2.1-.1.2L205 67.1c.1.2 0 .5-.3.5h-9.4c-.2 0-.4-.1-.4-.3l-10.8-19.7c-.1-.1-.2-.2-.3-.2H178c-.1 0-.2.1-.2.2v19.6c0 .2-.2.4-.4.4h-7.7c-.2 0-.4-.2-.4-.4V20.4zM185 40.1c6.2 0 10.3-1.4 10.3-6.6 0-4.4-2.9-6.3-10.1-6.3h-7.1c-.1 0-.2.1-.2.2v12.5c0 .1.1.2.2.2h6.9zm79.9 4.6c-.2.2-.4.2-.6 0-.9-.8-3.2-2.9-6.3-2.9-3.6 0-9 2.4-9 9.7 0 7.5 5.9 9.7 9.2 9.7 3 0 5.5-1.9 6.2-2.7.2-.2.4-.2.6 0l4.8 5.2c.2.2.1.4 0 .6-2.4 2.2-6.2 4.2-11.3 4.2-8.2 0-17.5-5.3-17.5-16.9 0-11.3 8.8-16.9 17.5-16.9 4.8 0 8.5 1.9 11.4 4.6.2.2.2.4 0 .6l-5 4.8zm-51.5 9.6c-.1 0-.2.1-.2.2.4 3.7 4.4 7.4 8.6 7.4 4.4 0 6.5-1.8 8.4-4.1.1-.2.4-.2.5-.1l5.1 3.9c.2.1.2.4.1.6-3.3 3.8-7.5 6.1-13.4 6.1-9.3 0-17.5-6.3-17.5-16.9 0-10.2 7.7-16.9 17-16.9 8.8 0 15.6 7.4 15.6 17.5v1.8c0 .2-.2.4-.4.4l-23.8.1zm16.1-6.1c.1 0 .2-.1.2-.2 0-3.9-3.5-7.5-7.9-7.5s-8 2.7-8.5 7.4c0 .1.1.2.2.2l16 .1zm149.4 6.1c-.1 0-.2.1-.2.2.4 3.7 4.4 7.4 8.6 7.4 4.4 0 6.5-1.8 8.4-4.1.1-.2.4-.2.5-.1l5.1 3.9c.2.1.2.4.1.6-3.3 3.8-7.5 6.1-13.4 6.1-9.3 0-17.5-6.3-17.5-16.9 0-10.2 7.7-16.9 17-16.9 8.8 0 15.6 7.4 15.6 17.5v1.8c0 .2-.2.4-.4.4l-23.8.1zm16.1-6.1c.1 0 .2-.1.2-.2 0-3.9-3.5-7.5-7.9-7.5s-8 2.7-8.5 7.4c0 .1.1.2.2.2l16 .1zM274.4 35.3h6.3c.2 0 .4.1.4.3l.9 4.8h.1c3.4-6.6 11.4-5.6 12.1-5.5.2 0 .3.2.3.6v6.2c0 .2-.2.4-.4.4 0 0-1.5-.3-2.8-.3-5.2 0-8.9 4.7-9.3 11v14.3c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c.1-.2.3-.4.5-.4zm133.4 0h6.3c.2 0 .4.1.4.3l.9 4.8h.1c3.4-6.6 11.4-5.6 12.1-5.5.2 0 .3.2.3.6v6.2c0 .2-.2.4-.4.4 0 0-1.5-.3-2.8-.3-5.2 0-8.9 4.7-9.3 11v14.3c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c.1-.2.3-.4.5-.4zm-63.1 6.5v-6.1c0-.2.2-.4.4-.4h6.1c.1 0 .2-.1.2-.2v-5.9c0-.2.1-.3.3-.4l7.3-2.7c.3-.1.5.1.5.4v8.6c0 .1.1.2.2.2h8.3c.2 0 .4.2.4.4v6.1c0 .2-.2.4-.4.4h-8.3c-.1 0-.2.1-.2.2v13.9c0 2.8.5 5.2 4.5 5.2 1.5 0 3-.3 4-.7.2-.1.4.1.4.3V67c0 .2-.1.4-.3.5-1.3.6-3.8.9-6.1.9-3.9 0-6.5-.8-8-2.3-1.4-1.4-2.5-3.6-2.5-9.1V42.4c0-.1-.1-.2-.2-.2h-6.1c-.3 0-.5-.2-.5-.4zm-32.5 19.6c-3.2 0-5.9-2-6-5.6V35.7c0-.2-.2-.4-.4-.4h-7.3c-.2 0-.4.2-.4.4v19.2c0 7.9 5.9 13.5 14 13.5h.2c8.1 0 14-5.6 14-13.5V35.7c0-.2-.2-.4-.4-.4h-7.3c-.2 0-.4.2-.4.4v20.1c-.1 3.6-2.8 5.6-6 5.6zm-173.7 2.3c0-.1.2-.2.3-.1 2.1 2.7 6.3 4.8 10.9 4.8 7.8 0 15.6-6.1 15.6-16.9 0-11.5-7.8-16.9-15.9-16.9-5.1 0-9 2.5-11 5.5-.1.1-.2.1-.3-.1l-.9-4.3c0-.2-.2-.3-.4-.3h-5.9c-.2 0-.4.2-.4.4v46.8c0 .2.2.4.4.4h7.3c.2 0 .4-.2.4-.4V63.7zm10.2-2.6c-5.3 0-9.5-3.6-9.5-9.7s4.2-9.7 9.5-9.7c3.1 0 8.7 2.1 8.7 9.7s-5.8 9.7-8.7 9.7zm-33.9-36.3c0-2.7 2.2-4.8 5.1-4.8 3.1 0 5.2 2.2 5.2 4.8 0 2.6-2.2 4.8-5.2 4.8-2.9.1-5.1-2.2-5.1-4.8zm8.8 10.5c.2 0 .4.2.4.4v31.5c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c0-.2.2-.4.4-.4h7.3z"/>
						  <path fill="#b2e522" fill-rule="evenodd" d="M52.9 26.5c-.6-.2-1.3-.1-2 .1l-2.7.9V2.4c0-1.3-1.1-2.4-2.4-2.4H10.3C9 0 7.9 1.1 7.9 2.4v25.2l-2.7-.9c-.7-.2-1.4-.3-2-.1-1 .2-3.2 1.2-3.2 5.1v21c.3 1.8 1.5 3.9 4.2 3.9h9c.9 1.1 3.1 2.9 7.3 3.2.1 3.1 1.9 5.7 4.6 6.8v5.9c0 .1-.1.2-.2.2-12.6.4-20.6 4.4-22.9 5.7C.6 79.2.3 80.9.3 82v4.6c.1 1.6 1.4 2.9 3.1 2.9 1.5 0 2.8-1.3 2.9-2.8.1-1.5-.9-2.7-2.3-3.1-.1 0-.2-.1-.2-.2v-1.7c0-.4.2-.8.6-1 3.4-1.9 12.1-2.8 18.7-3.2H25c.1 0 .2.1.2.2.3 5.3.9 9.8 1.1 12.6h-.2c-1.1 0-2.1 1.3-2.1 3s1 3 2.1 3h4c1.1 0 2.1-1.3 2.1-3s-1-3-2.1-3h-.2s.7-7.3 1.1-12.6c0-.1.1-.2.2-.2h1.9c6.6.3 15.3 1.3 18.7 3.2.4.2.6.6.6 1v1.7c0 .1-.1.2-.2.2-1.4.3-2.4 1.6-2.3 3.1.1 1.5 1.4 2.8 2.9 2.8 1.6 0 3-1.2 3.1-2.9V82c0-1.1-.3-2.7-1.7-3.6-2.3-1.3-10.4-5.3-22.9-5.8-.1 0-.2-.1-.2-.2v-5.9c2.7-1.1 4.5-3.7 4.6-6.8 4.1-.3 6.3-2.2 7.3-3.2h9c2.7 0 3.9-2.1 4.2-3.9v-21c-.1-3.9-2.3-4.8-3.3-5.1zm-45 21.8l-4.1 3.1c-.1.1-.2 0-.2-.1V31.6c0-.8.1-1.8.5-1.7l3.6 1.2c.1 0 .2.2.2.3v16.9zm44.5 3.1l-4.1-3.1V31.5c0-.1.1-.2.2-.3l3.6-1.2c.5-.1.5.9.5 1.7v19.7s-.1.1-.2 0z" clip-rule="evenodd"/>
						  <path fill="#343e45" d="M428.7 30.7c0-.7.1-1.3.4-1.9.3-.6.6-1.1 1-1.5.4-.4.9-.8 1.5-1 .6-.3 1.2-.4 1.9-.4s1.3.1 1.9.4c.6.3 1.1.6 1.5 1 .4.4.8.9 1 1.5s.4 1.2.4 1.9-.1 1.3-.4 1.9-.6 1.1-1 1.5-.9.8-1.5 1c-.6.3-1.2.4-1.9.4s-1.3-.1-1.9-.4c-.6-.3-1.1-.6-1.5-1s-.8-.9-1-1.5c-.3-.6-.4-1.3-.4-1.9zm.9 0c0 .5.1 1.1.3 1.5.2.5.5.9.9 1.3s.8.6 1.3.9 1 .3 1.5.3 1.1-.1 1.5-.3.9-.5 1.3-.9.6-.8.9-1.3c.2-.5.3-1 .3-1.5s-.1-1.1-.3-1.5-.5-.9-.9-1.3-.8-.6-1.3-.9-1-.3-1.5-.3-1.1.1-1.5.3-.9.5-1.3.9-.6.8-.9 1.3-.3.9-.3 1.5z"/>
						  <path fill="#343e45" d="M431.6 27.9h1.8c1.6 0 2.2.6 2.2 1.6s-.7 1.5-1.2 1.5l1.4 2.3v.1h-1.1l-1.3-2.3h-.7v2.3h-.9v-5.5zm1.8 2.3c.7 0 1.2-.2 1.2-.8 0-.5-.3-.7-1.2-.7h-.8v1.4h.8z"/>
						</svg>
					</div>
                	<div class="text-center mt-1">
                		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 320 80" width="100" height="25"  style="vertical-align: middle;"><path d="M287.31 13.4a5.24 5.24 0 0 0-4.22-1.76 5 5 0 0 0-4.22 1.92 9 9 0 0 0-1.49 5.59V37a24.49 24.49 0 0 0-7-5.52 16.88 16.88 0 0 0-5.2-1.56 25.92 25.92 0 0 0-3.6-.24A18.43 18.43 0 0 0 247.06 36c-3.67 4.23-5.51 10.09-5.51 17.65A33.74 33.74 0 0 0 243 63.6a24 24 0 0 0 4.06 8 19.15 19.15 0 0 0 6.41 5.24 17.87 17.87 0 0 0 8 1.84 19.14 19.14 0 0 0 3.75-.35 14.73 14.73 0 0 0 2.27-.55 19.32 19.32 0 0 0 5.12-2.66 30.13 30.13 0 0 0 4.81-4.54v1.17a7.52 7.52 0 0 0 1.6 5.13 5.66 5.66 0 0 0 8.21.08 7.48 7.48 0 0 0 1.8-5.17V18.48a7.76 7.76 0 0 0-1.72-5.08zm-12.15 49.22a11.56 11.56 0 0 1-4.18 5 10.7 10.7 0 0 1-5.78 1.64 10.45 10.45 0 0 1-5.78-1.72 11.84 11.84 0 0 1-4.18-5.16 20.67 20.67 0 0 1-1.52-8.37 20.86 20.86 0 0 1 1.45-8.14 12 12 0 0 1 4-5.4 9.68 9.68 0 0 1 5.94-1.88h.12a9.93 9.93 0 0 1 5.74 1.84 12.56 12.56 0 0 1 4.22 5.28 19.89 19.89 0 0 1 1.56 8.29 20.36 20.36 0 0 1-1.59 8.62zm-37.9.51a4.38 4.38 0 0 0-3-1 4 4 0 0 0-2.62.78c-1.52 1.41-2.74 2.54-3.67 3.36a33.69 33.69 0 0 1-3.13 2.31 12.3 12.3 0 0 1-3.44 1.57 14 14 0 0 1-3.95.51 6.6 6.6 0 0 1-.9 0 10.72 10.72 0 0 1-5-1.57 11.55 11.55 0 0 1-4.3-4.66A17.22 17.22 0 0 1 205.6 57h23.54c3.17 0 5.65-.34 7.37-1.2s2.62-2.9 2.62-5.91a20.41 20.41 0 0 0-2.54-9.66 19.64 19.64 0 0 0-7.59-7.74 23.28 23.28 0 0 0-12.12-3h-.35a27.4 27.4 0 0 0-9.53 1.75 21.07 21.07 0 0 0-7.54 5 22.48 22.48 0 0 0-4.61 7.86 30.26 30.26 0 0 0-1.6 9.94c0 7.59 2.15 13.54 6.45 18 4.06 4.19 9.69 6.38 16.84 6.61h1.25a27.65 27.65 0 0 0 9-1.33 22.39 22.39 0 0 0 6.48-3.32 16 16 0 0 0 3.87-4.23 7.8 7.8 0 0 0 1.29-3.8 3.58 3.58 0 0 0-1.17-2.84zm-28.14-22.4a9.58 9.58 0 0 1 7.39-3.09 9.94 9.94 0 0 1 7.58 3.05c1.91 2 3 5.25 3.32 9.4H205.6c.4-4.09 1.57-7.29 3.52-9.36zM189 63.13a4.38 4.38 0 0 0-3-1 4 4 0 0 0-2.62.78c-1.52 1.41-2.74 2.54-3.67 3.36a33.69 33.69 0 0 1-3.13 2.31 12.3 12.3 0 0 1-3.44 1.57 14 14 0 0 1-3.95.51 6.6 6.6 0 0 1-.9 0 10.72 10.72 0 0 1-5-1.57 11.55 11.55 0 0 1-4.3-4.66 17.22 17.22 0 0 1-1.64-7.43h23.54c3.17 0 5.65-.34 7.37-1.2s2.62-2.9 2.62-5.91a20.41 20.41 0 0 0-2.54-9.66 19.64 19.64 0 0 0-7.58-7.71 23.28 23.28 0 0 0-12.12-3h-.35a27.4 27.4 0 0 0-9.54 1.72 21.07 21.07 0 0 0-7.54 5 22.48 22.48 0 0 0-4.61 7.86 30.26 30.26 0 0 0-1.6 9.94c0 7.59 2.15 13.54 6.45 18 4.06 4.19 9.69 6.38 16.84 6.61h1.25a27.65 27.65 0 0 0 9-1.33A22.39 22.39 0 0 0 185 74a16 16 0 0 0 3.87-4.23 7.8 7.8 0 0 0 1.29-3.8 3.58 3.58 0 0 0-1.16-2.84zm-28.14-22.4a9.58 9.58 0 0 1 7.39-3.09 9.94 9.94 0 0 1 7.58 3.05c1.91 2 3 5.25 3.32 9.4h-21.8c.39-4.09 1.56-7.29 3.52-9.36zm-21.65-27.17A5.26 5.26 0 0 0 135 11.8a5 5 0 0 0-4.22 1.92c-1.31 1.52-1.65 3.24-1.65 5.7V37.2a23.57 23.57 0 0 0-6.62-5.57 17.21 17.21 0 0 0-5.2-1.56 25.92 25.92 0 0 0-3.6-.24 18.38 18.38 0 0 0-14.54 6.34c-3.63 4.23-5.47 10.1-5.47 17.65a35.11 35.11 0 0 0 1.37 9.94 24.13 24.13 0 0 0 4.1 8 19.15 19.15 0 0 0 6.41 5.24 17.87 17.87 0 0 0 8 1.84 19.72 19.72 0 0 0 3.75-.35 14.67 14.67 0 0 0 2.27-.55 19.32 19.32 0 0 0 5.12-2.66 31.93 31.93 0 0 0 4.81-4.54v1.17a7.52 7.52 0 0 0 1.6 5.13 5.62 5.62 0 0 0 8.17.08 7.53 7.53 0 0 0 1.56-5.2V18.68a7.87 7.87 0 0 0-1.65-5.12zm-11.9 49.22a11.37 11.37 0 0 1-4.22 5 10.57 10.57 0 0 1-5.74 1.64 10.44 10.44 0 0 1-5.78-1.72 11.58 11.58 0 0 1-4.18-5.16 20.68 20.68 0 0 1-1.52-8.37 21.64 21.64 0 0 1 1.41-8.14 12.08 12.08 0 0 1 4.06-5.4 9.57 9.57 0 0 1 5.9-1.88h.16a9.72 9.72 0 0 1 5.6 1.88 12.35 12.35 0 0 1 4.26 5.28 20.52 20.52 0 0 1 1.56 8.29 21 21 0 0 1-1.51 8.58zM26 71.27v-28.8c.82.08 1.6.12 2.42.12A20.27 20.27 0 0 0 39 39.65v31.62c0 2.7-.49 4.7-1.71 6a6.16 6.16 0 0 1-4.77 2 6 6 0 0 1-4.69-2c-1.21-1.33-1.84-3.33-1.84-6zm-.12-69C34-.69 43.28-.53 50.23 5.5a11.79 11.79 0 0 1 3.36 4.5c.7 2.27-2.46-.23-2.89-.55a30.92 30.92 0 0 0-7.07-3.6C29.95 1.66 17 9.29 9 21.15A64.11 64.11 0 0 0 1.61 38a9.59 9.59 0 0 1-.7 2.11c-.35.67-.16-1.8-.16-1.88a52 52 0 0 1 1.41-7.36C5.87 17.94 14.08 7.18 25.88 2.25zm10.59 32A9.92 9.92 0 1 1 40.81 21a9.88 9.88 0 0 1-4.34 13.29zm20.87 2.53v1.5a21.48 21.48 0 0 1 6.9-6.13 18.79 18.79 0 0 1 8.65-1.94 17.35 17.35 0 0 1 8.45 2.06 13 13 0 0 1 5.55 5.82 13.56 13.56 0 0 1 1.55 4.78 48.84 48.84 0 0 1 .35 6.48v22.24A7.92 7.92 0 0 1 87.13 77a5.41 5.41 0 0 1-4.27 1.86A5.48 5.48 0 0 1 78.52 77a7.81 7.81 0 0 1-1.62-5.4V51.7c0-4-.59-7-1.68-9.09s-3.3-3.14-6.55-3.14a9.84 9.84 0 0 0-5.82 1.9A11 11 0 0 0 59 46.65c-.58 1.79-.91 5.09-.91 10v14.96c0 2.45-.52 4.23-1.65 5.47a5.68 5.68 0 0 1-4.34 1.82 5.38 5.38 0 0 1-4.29-1.9 7.82 7.82 0 0 1-1.67-5.4V37c0-2.29.5-4 1.51-5.09a5.1 5.1 0 0 1 4.07-1.71 5.41 5.41 0 0 1 2.83.74 5.29 5.29 0 0 1 2.06 2.25 8 8 0 0 1 .74 3.64z" fill="#2164f3" fill-rule="evenodd"/></svg>
                	</div>
                	<div class="text-center mt-1">
                		<img src="{{ asset('img//integration-icons/career_b.png') }}" style="width: 90px;">
                	</div>
                	<div class="text-center mt-1">
                		<img src="{{ asset('img//integration-icons/snag.png') }}" style="width: 90px;">
                	</div>
                </div>
                <p class="text-center mb-0"><strong>{!! trans('main.integration_time') !!}</strong></p>
                <p class="text-center">{!! trans('integration.boards.time') !!}</p>
                <div class="d-flex flex-column flex-lg-row justify-content-between mt-5">
                	<div class="text-center col-lg-4 col-12">
                		<p>
                			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 440.125 440.125" style="enable-background:new 0 0 440.125 440.125; fill:#7b7b7b;" xml:space="preserve" width="50" height="50">
								<g>
									<g>
										<path d="M313.938,187.702L212.563,86.327c-3.079-3.958-7.836-6.37-12.85-6.301c-0.746,0.023-1.49,0.099-2.225,0.099H55.963    c-8.836,0-15.999,7.415-16,16.251v328c0.001,8.836,7.164,15.749,16,15.749h248c8.836,0,15.999-6.913,16-15.749v-221.4    C320.92,197.164,318.605,191.296,313.938,187.702L313.938,187.702z M215.963,135.002l49.375,49.124h-49.375L215.963,135.002    L215.963,135.002z M287.963,408.126h-216v-296h112v85.676c-0.843,5.145,0.873,10.379,4.6,14.025    c0.041,0.042,0.083,0.084,0.125,0.125c0.074,0.067,0.149,0.008,0.225,0.074c3.639,3.482,8.706,5.099,13.675,4.099h85.375V408.126z    "/>
										<path d="M393.932,107.689L292.557,6.314c-3.02-3.891-7.919-6.376-12.844-6.313c-0.744,0.032-1.486,0.124-2.219,0.124H135.963    c-4.189,0-8.351,1.851-11.313,4.812c-2.962,2.962-4.686,7.25-4.687,11.439v43.749h32v-28h112V97.72l38.656,38.405h65.344v192h-28    v32h44c4.189,0,8.351-1.599,11.313-4.561c2.962-2.962,4.686-6.999,4.687-11.188V122.971    C400.897,117.296,398.49,111.196,393.932,107.689z M295.963,104.126V55.002l49.375,49.124H295.963z"/>
									</g>
								</g>
							</svg>
                		</p>
                		<p><strong>{!! trans('integration.boards.link_1') !!}</strong></p>
                	</div>
                	<div class="text-center col-lg-4 col-12">
                		<p>
                			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50" height="50" viewBox="0 0 16 16" style="fill:#7b7b7b;">
								<path fill="#444444" d="M1 0h12v2h-12v-2z"/>
								<path fill="#444444" d="M1 8h13v2h-13v-2z"/>
								<path fill="#444444" d="M1 11h11v2h-11v-2z"/>
								<path fill="#444444" d="M1 14h14v2h-14v-2z"/>
								<path fill="#444444" d="M0 3v4h16v-4h-16zM11 6h-10v-2h10v2z"/>
							</svg>
                		</p>
                		<p><strong>{!! trans('integration.boards.link_2') !!}</strong></p>
                	</div>
                	<div class="text-center col-lg-4 col-12">
                		<p>
                			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#7b7b7b;" xml:space="preserve" width="50px" height="50px"><g><g>
                                <g>
                                    <path d="M451.72,237.26c-17.422-8.71-50.087-8.811-51.469-8.811c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5    c8.429,0.001,32.902,1.299,44.761,7.228c1.077,0.539,2.221,0.793,3.348,0.793c2.751,0,5.4-1.52,6.714-4.147    C456.927,243.618,455.425,239.113,451.72,237.26z"></path>
                                </g>
                            </g><g>
                                <g>
                                    <path d="M489.112,344.041l-30.975-8.85c-1.337-0.382-2.271-1.62-2.271-3.011v-10.339c2.52-1.746,4.924-3.7,7.171-5.881    c10.89-10.568,16.887-24.743,16.887-39.915v-14.267l2.995-5.989c3.287-6.575,5.024-13.936,5.024-21.286v-38.65    c0-4.142-3.358-7.5-7.5-7.5H408.27c-26.244,0-47.596,21.352-47.596,47.596v0.447c0,6.112,1.445,12.233,4.178,17.699l3.841,7.682    v12.25c0,19.414,9.567,36.833,24.058,47.315l0.002,10.836c0,1.671,0,2.363-6.193,4.133l-15.114,4.318l-43.721-15.898    c0.157-2.063-0.539-4.161-2.044-5.742l-13.971-14.678v-24.64c1.477-1.217,2.933-2.467,4.344-3.789    c17.625-16.52,27.733-39.844,27.733-63.991v-19.678c5.322-11.581,8.019-23.836,8.019-36.457v-80.19c0-4.142-3.358-7.5-7.5-7.5    H232.037c-39.51,0-71.653,32.144-71.653,71.653v16.039c0,12.621,2.697,24.876,8.019,36.457v16.931    c0,28.036,12.466,53.294,32.077,69.946v25.22l-13.971,14.678c-1.505,1.581-2.201,3.679-2.044,5.742l-46.145,16.779    c-3.344,1.216-6.451,2.863-9.272,4.858l-7.246-3.623c21.57-9.389,28.403-22.594,28.731-23.25c1.056-2.111,1.056-4.597,0-6.708    c-5.407-10.814-6.062-30.635-6.588-46.561c-0.175-5.302-0.341-10.311-0.658-14.771c-2.557-35.974-29.905-63.103-63.615-63.103    s-61.059,27.128-63.615,63.103c-0.317,4.461-0.483,9.47-0.658,14.773c-0.526,15.925-1.182,35.744-6.588,46.558    c-1.056,2.111-1.056,4.597,0,6.708c0.328,0.656,7.147,13.834,28.76,23.234l-20.127,10.063C6.684,358.176,0,368.991,0,381.02    v55.409c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5V381.02c0-6.312,3.507-11.987,9.152-14.81l25.063-12.531l8.718,8.285    c6.096,5.793,13.916,8.688,21.739,8.688c7.821,0,15.645-2.897,21.739-8.688l8.717-8.284l8.172,4.086    c-3.848,6.157-6.032,13.377-6.032,20.94v57.725c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-57.725    c0-10.296,6.501-19.578,16.178-23.097l48.652-17.691l20.253,30.381c2.589,3.884,6.738,6.375,11.383,6.835    c0.518,0.051,1.033,0.076,1.547,0.076c4.098,0,8.023-1.613,10.957-4.546l12.356-12.356v78.124c0,4.142,3.358,7.5,7.5,7.5    c4.142,0,7.5-3.358,7.5-7.5v-78.124l12.356,12.356c2.933,2.934,6.858,4.547,10.957,4.547c0.513,0,1.029-0.025,1.546-0.076    c4.646-0.46,8.795-2.951,11.384-6.835l20.254-30.38l48.651,17.691c9.676,3.519,16.178,12.801,16.178,23.097v57.725    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-57.725c0-10.428-4.143-20.208-11.093-27.441l1.853-0.529    c1.869-0.534,4.419-1.265,6.979-2.52l19.149,19.149v69.066c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-69.066    l19.016-19.016c1.011,0.514,2.073,0.948,3.191,1.267l30.976,8.85c7.07,2.02,12.009,8.567,12.009,15.921v62.044    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-62.044C512,360.371,502.588,347.892,489.112,344.041z M48.115,330.794    c-14.029-5.048-21.066-11.778-24.07-15.453c2.048-5.354,3.376-11.486,4.275-17.959c4.136,9.917,11.063,18.383,19.795,24.423    V330.794z M91.08,351.092c-6.397,6.078-16.418,6.077-22.813-0.001l-6.975-6.628c1.177-2.205,1.824-4.705,1.824-7.324v-7.994    c5.232,1.635,10.794,2.517,16.558,2.517c5.757,0,11.316-0.886,16.557-2.512l-0.001,7.988c0,2.62,0.646,5.121,1.824,7.327    L91.08,351.092z M79.676,316.662c-22.396,0-40.615-18.22-40.615-40.615c0-4.142-3.358-7.5-7.5-7.5c-0.42,0-0.83,0.043-1.231,0.11    c0.022-0.645,0.043-1.291,0.065-1.93c0.167-5.157,0.328-10.028,0.625-14.206c0.958-13.476,6.343-25.894,15.163-34.968    c8.899-9.156,20.793-14.198,33.491-14.198s24.591,5.042,33.491,14.198c8.82,9.074,14.205,21.492,15.163,34.968    c0.296,4.177,0.458,9.047,0.628,14.203c0.015,0.443,0.03,0.892,0.045,1.338c-8.16-12.572-20.762-21.837-37.045-27.069    c-15.043-4.833-27.981-4.534-28.527-4.52c-1.964,0.055-3.828,0.877-5.191,2.291l-13.532,14.034    c-2.875,2.982-2.789,7.73,0.193,10.605s7.73,2.788,10.605-0.193l11.26-11.677c9.697,0.474,40.894,4.102,53.027,30.819    C116.738,302.04,99.816,316.662,79.676,316.662z M111.229,330.819l0.001-8.945c8.725-6.007,15.662-14.457,19.801-24.449    c0.899,6.458,2.226,12.576,4.27,17.918C132.314,318.983,125.244,325.773,111.229,330.819z M183.403,209.145v-18.608    c0-1.129-0.255-2.244-0.746-3.261c-4.826-9.994-7.273-20.598-7.273-31.518V139.72c0-31.239,25.415-56.653,56.653-56.653h104.769    v72.692c0,10.92-2.447,21.524-7.273,31.518c-0.491,1.017-0.746,2.132-0.746,3.261v21.355c0,20.311-8.165,39.15-22.991,53.047    c-1.851,1.734-3.772,3.36-5.758,4.875c-0.044,0.03-0.086,0.063-0.129,0.094c-13.889,10.545-30.901,15.67-48.667,14.519    C213.201,281.965,183.403,248.897,183.403,209.145z M225.632,360.056c-0.052,0.052-0.173,0.175-0.418,0.149    c-0.244-0.024-0.34-0.167-0.381-0.229l-23.325-34.988l7.506-7.887l35.385,24.187L225.632,360.056z M256.095,331.113    l-40.615-27.762v-14c10.509,5.681,22.276,9.234,34.791,10.044c1.977,0.128,3.942,0.191,5.901,0.191    c14.341,0,28.143-3.428,40.538-9.935v13.7L256.095,331.113z M287.357,359.978c-0.041,0.062-0.137,0.205-0.381,0.229    c-0.245,0.031-0.365-0.098-0.418-0.149l-18.767-18.767l35.385-24.188l7.507,7.887L287.357,359.978z M424.308,353.65l-17.02-17.019    c0.297-1.349,0.465-2.826,0.464-4.455l-0.001-3.165c4.723,1.55,9.701,2.47,14.852,2.624c0.578,0.018,1.151,0.026,1.727,0.026    c5.692,0,11.248-0.86,16.536-2.501v3.02c0,1.496,0.188,2.962,0.542,4.371L424.308,353.65z M452.591,305.196    c-7.949,7.714-18.45,11.788-29.537,11.446c-21.704-0.651-39.361-19.768-39.361-42.613v-14.021c0-1.165-0.271-2.313-0.792-3.354    l-4.633-9.266c-1.697-3.395-2.594-7.195-2.594-10.991v-0.447c0-17.974,14.623-32.596,32.596-32.596h64.673v31.15    c0,5.034-1.19,10.075-3.441,14.578l-3.786,7.572c-0.521,1.042-0.792,2.189-0.792,3.354v16.038    C464.924,287.126,460.544,297.478,452.591,305.196z"></path>
                                </g>
                            </g><g>
                                <g>
                                    <path d="M472.423,380.814c-4.142,0-7.5,3.358-7.5,7.5v48.115c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-48.115    C479.923,384.173,476.565,380.814,472.423,380.814z"></path>
                                </g>
                            </g><g>
                                <g>
                                    <path d="M39.577,390.728c-4.142,0-7.5,3.358-7.5,7.5v38.201c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-38.201    C47.077,394.087,43.719,390.728,39.577,390.728z"></path>
                                </g>
                            </g><g>
                                <g>
                                    <path d="M317.532,158.475c-28.366-28.366-87.715-22.943-111.917-19.295c-7.623,1.149-13.155,7.6-13.155,15.339v17.278    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-17.279c0-0.255,0.168-0.473,0.392-0.507    c9.667-1.457,28.85-3.705,48.725-2.38c23.388,1.557,40.328,7.428,50.349,17.45c2.929,2.929,7.678,2.929,10.606,0    C320.461,166.152,320.461,161.403,317.532,158.475z"></path>
                                </g>
                            </g><g>
                                <g>
                                    <path d="M167.884,396.853c-4.142,0-7.5,3.358-7.5,7.5v32.077c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-32.077    C175.384,400.212,172.026,396.853,167.884,396.853z"></path>
                                </g>
                            </g><g>
                                <g>
                                    <path d="M344.306,396.853c-4.142,0-7.5,3.358-7.5,7.5v32.077c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-32.077    C351.806,400.212,348.448,396.853,344.306,396.853z"></path>
                                </g>
                            </g></g> </svg>
                		</p>
                		<p><strong>{!! trans('integration.boards.link_3') !!}</strong></p>
                	</div>
                </div>

                <p class="mt-5"><strong>{!! trans('integration.boards.text_box_1.title') !!}</strong></p>
                <ul style="list-style: none;" class="pxa-0">
                	<li>{!! trans('integration.boards.text_box_1.text') !!}</li>
                </ul>

                <div class="d-flex flex-column-reverse">
                	<div class="col-12 pxa-0 pl-0">
                		<p class="mt-3"><strong>{!! trans('integration.boards.text_box_2.title') !!}</strong></p>
		                <ul style="list-style: none;" class="pxa-0">
							{!! trans('integration.boards.text_box_2.text', [
                                'button' => trans('main.buttons.start_here')
                            ]) !!}
		                </ul>
                	</div>
                </div>

                <p class="mt-5"><strong>{!! trans('integration.boards.text_box_3.title') !!}</strong></p>
                <ul style="list-style: none;" class="pxa-0">
					{!! trans('integration.boards.text_box_3.text') !!}
                </ul>


                <p class="text-center">
                	<button class="btn btn-primary">{!! trans('main.buttons.get_started') !!}</button>
                </p>


            </div>
        </div>
    </div>
</div>