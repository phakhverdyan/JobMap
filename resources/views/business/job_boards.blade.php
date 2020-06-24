@extends('layouts.main_business')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-12 col-xl-8 mx-auto mt-4 bg-white rounded p-3">
                <div class="mb-3 text-left">
                  <p class="h4">Presentation the Job Boards</p>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <p class="text-right mb-3 mt-5" style="opacity: 0.4;">
                    <button type="button" class="pt-0 mt-0 border-0 help-how-to-start-show"
                            style="background-color: inherit; font-size: 13px; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path class="heroicon-ui"
                                  d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        {!! trans('main.help') !!}
                    </button>
                </p>

                <div>
                  <!-- one job board -->
                  <p class="h4">CloudResume (Main brand)</p>
                  <div class="d-flex mb-3">
                    <div class="align-self-center mr-5">
                      @svg('/img/integration-icons/indeed.svg', [
                           'width' => '150px',
                        ])
                    </div>
                    <div class="align-self-center mx-5">
                      <label class="switch">
                          <input type="checkbox" class="job-status-change" data-id="4" checked="">
                          <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="align-self-center mx-5">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                  </div>
                  <!-- /one job board -->
                  <!-- one job board -->
                  <p class="h4">Second brand name</p>
                  <div class="d-flex mb-3">
                    <div class="align-self-center mr-5">
                      @svg('/img/integration-icons/indeed.svg', [
                           'width' => '150px',
                        ])
                    </div>
                    <div class="align-self-center mx-5">
                      <label class="switch">
                          <input type="checkbox" class="[ indeed-account-toggle ]">
                          <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="align-self-center mx-5">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                  </div>
                  <!-- /one job board -->
                </div>

            </div>
        </div>

        @include('components.modal.create_indeed_account')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="{{ asset('/js/app/share-button.js?v='.time()) }}"></script>
    <script src="http://code.interactjs.io/v1.3.3/interact.min.js"></script>
    <script src="{{ asset('/js/app/cr_link.js?v='.time()) }}"></script>
@stop

@push('scripts')
    <script>
        $(function() {
            $('.indeed-account-toggle').click(function(event) {
                event.preventDefault();
                
                if (!$(this).prop('checked')) {
                    new GraphQL('mutation', 'deleteIndeedAccount', {
                        business_id:    business.currentData.id,
                    }, [ 'id' ], true, false, function(data) {
                        //
                    }, function(data) {
                        $.notify('Indeed Account was disconnected!', 'success');
                        $('.indeed-account-toggle').prop('checked', false);
                    }).request();

                    return;
                }

                $('#create-indeed-account-modal').modal('show');
            });

            $('.indeed-account-toggle').prop('checked', business.currentData.indeed_account ? true : false);
        });
    </script>
@endpush