<div class="modal fade" id="franchiseConnect" tabindex="-1" role="dialog" aria-labelledby="signInModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body pt-0" style="position: relative;">
              <button type="button" class="close mt-0" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 5px; right: 10px;">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="mb-3"><input type="text" name="" placeholder="Enter your franchise name" class="form-control" autocomplete="off" id="create-business__franchise-search"></p>
              <!-- businesses result -->
              <div style="height: 400px; overflow-y: auto;" id="create-business__franchise-businesses">

                {{--<div class="d-flex my-3">
                  <input type="checkbox" name="" class="form-control align-self-center mr-2">
                  <img class="rounded align-self-center mr-2" alt="Your business logo" style="width: 100px; height: 100px;" src="/business/3/200.200.4b223c47ecfcce40d93f6e4fb513f3c0.jpg?v=88608">
                  <p class="mb-0 align-self-center">
                    <strong>Business name</strong>
                  </p>
                </div>--}}

              </div>
              <!-- /businesses result -->

              <div class="row pb-3 pt-1 px-3">
                  <div class="col-lg-6 col-12 pxa-0 pl-0">
                      <button type="button" class="btn btn-primary btn-block" role="button" id="create-business__franchise-ok">
                        Connect
                      </button>
                  </div>
                  <div class="col-lg-6 col-12 pxa-0 pr-0">
                      <button type="button" class="btn btn-outline-primary btn-block" role="button" data-dismiss="modal" aria-label="Close">
                        Skip
                      </button>
                  </div>
              </div>

            </div>
        </div>
    </div>
</div>
