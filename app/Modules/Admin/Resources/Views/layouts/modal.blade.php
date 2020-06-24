<!--Profile MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1300px;">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <p>Client profile <span style="float:right"><button class="btn btn-primary btn-sm"
                                                                    style="margin-top: -7px;">Access account</button></span>
                </p>

                <table class="table">
                    <thead style="border-top:0;">
                    <tr>
                        <th>Id</th>
                        <th>Employer</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Lang</th>
                        <th>Owner</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Users</th>
                        <th>Owner phone number</th>
                        <th>Owner contact</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="js-businessID"></td>
                        <td class="js-name"></td>
                        <td class="js-email"></td>
                        <td class="js-country"></td>
                        <td class="js-city"></td>
                        <td class="js-lang"></td>
                        <td class="js-owner"></td>
                        <td class="js-type"></td>
                        <td class="js-size"></td>
                        <td class="js-users"></td>
                        <td class="js-owner-phone"></td>
                        <td class="js-owner-contact"></td>
                    </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Date joined</th>
                        <th>Days joined</th>
                        <th>Last Login</th>
                        <th>Locations</th>
                        <th>Open jobs</th>
                        <th>Closed jobs</th>
                        <th>Employees</th>
                        <th>C.Received</th>
                        <th>C.Viewed</th>
                        <th>Messages</th>
                        <th>Industry</th>
                        <th>Imported ATS</th>
                        <th>CR Email</th>
                        <th>CR Forwarder</th>
                        <th>Referred by</th>
                        <th>Legal type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="js-data-joined"></td>
                        <td class="js-days-joined"></td>
                        <td class="js-last-login"></td>
                        <td class="js-locations"></td>
                        <td class="js-open-jobs"></td>
                        <td class="js-closed-jobs"></td>
                        <td class="js-employees"></td>
                        <td class="js-cr"></td>
                        <td class="js-cv"></td>
                        <td class="js-messages"></td>
                        <td class="js-industry"></td>
                        <td class="js-imported-ats"></td>
                        <td class="js-cr-email"></td>
                        <td class="js-cr-forwareder"></td>
                        <td class="js-referred-by"></td>
                        <td class="js-legal"></td>
                    </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Refferals
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Business name (Business Affiliate) <a href="">REF-1234</a></td>
                    </tr>
                    </tbody>
                </table>

                <h6>Billing</h6>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Invoice ID
                        </th>
                        <th>
                            Plan/Package name
                        </th>
                        <th>
                            Discount
                        </th>
                        <th>
                            Total Price
                        </th>
                        <th>
                            Date created
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                    </thead>
                    <tbody class="js-invoices">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Profile MODAL END!!!!!!!!!!!!!!! -->

<!--Admins MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="modifyadmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <p>Modify</p>
                <form class="update-user-admin" action="admins/update/" method="POST">
                    {{ csrf_field() }}
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6"><input type="text" name="name" value="username" class="form-control">
                            </div>
                            <div class="col-6"><input type="password" name="password" value="password"
                                                      class="form-control"></div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                            <div class="col-6"><a class="btn btn-primary btn-block">Delete</a></div>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>
<!--Admins MODAL END!!!!!!!!!!!!!!! -->

<!-- BigMac Index MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="pricetable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px; font-size: 14px;">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <div class="col-12">
                    <p class="h4">
                        <strong>Monthly Plans</strong>
                    </p>
                </div>

                <div class="col-12 mt-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Applicants (Up to)</th>
                            <th>Price/m</th>
                            <th>Plan name</th>
                        </tr>
                        </thead>
                        <tbody class="js-monthlyPlan">

                        </tbody>
                    </table>
                </div>

                <div class="col-12 mt-3">
                    <p class="h4"><strong>Addon packages (non renewable)</strong></p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Applicants (Up to)</th>
                            <th>Price/m</th>
                            <th>Plan name</th>
                        </tr>
                        </thead>
                        <tbody class="js-addonPackage">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BigMac Index MODAL END!!!!!!!!!!!!!!! -->

<!--Map Associate MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="modifyadmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <p>Modify</p>

                <div class="col-12">
                    <div class="row">
                        <div class="col-6"><input type="text" name="" value="username" class="form-control"></div>
                        <div class="col-6"><input type="text" name="" value="password" class="form-control"></div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary btn-block">Update</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary btn-block">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- MODAL END!!!!!!!!!!!!!!! -->