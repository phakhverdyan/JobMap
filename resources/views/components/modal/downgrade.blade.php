<!--Plan downgrade modal-->
<div class="modal fade" id="downGrade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="logoutModalLabel">Downgrade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conteiner">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            <p class="mb-2">This will affect your next bill, starting on <span id="downGrade-next-bill-starting-on"></span></p>
                            <p>Your next will be charged automatically, <span id="downGrade-next-bill-price"></span> per month+tax</p>
                            <p class="text-center">
                                <button id="downGrade-got-it" type="button" class="btn btn-outline-secondary">
                                    Yes, confirm downgrade
                                </button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Plan downgrade modal-->