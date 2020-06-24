@extends('admin::layouts.app')

@section('content')
    <div class="ml-3 mt-2" style="width: 100%;">

        <div class="col-12">
            <div class="d-inline-flex">
                <div>
                    <p>Create new admin</p>
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="admins/add" >
                        <div class="d-flex justify-content-around">
                            {{ csrf_field() }}
                            <div class="mr-3" style="">
                                <input type="text" name="name" placeholder="name" class="form-control form-control-sm text-center" value="{{ old('name') }}">
                            </div>
                            <div class="mr-3" style="">
                                <input type="email" placeholder="email" name="email" class="form-control form-control-sm text-center" value="{{ old('email') }}">
                            </div>
                            <div class="mr-3">
                                <input type="password" placeholder="password" name="password" class="form-control form-control-sm text-center" value="">
                            </div>
                            <div class="mr-3">
                                <select name="role" id="" class="form-control form-control-sm">
                                    <option value="" disabled selected style="display: none;">select role</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="salessupport">Sales and Support</option>
                                    <option value="associates">Associates</option>
                                    <option value="map-manager">Map Manager</option>
                                </select>
                            </div>
                            <div class="mr-3">
                                <button type="submit" class="btn btn-primary btn-sm">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mt-3 d-inline-flex">
                <div>
                    <p>Admin list</p>
                    <table class="table table-bordered">
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>role</th>
                            <th>action</th>
                            <th>Created At</th>
                        </tr>
                        @foreach( $admins as $admin )
                            <tr class="admin-profile-{{ $admin->id }}">
                                <td class="mr-3" style="font-size: 15px;"><p class="admin-name" data-profile-name="{{ $admin->name }}">{{ $admin->name }}</p></td>
                                <td class="mr-3" style="font-size: 15px;"><p>{{ $admin->email }}</p></td>
                                <td class="mr-3" style="font-size: 15px;"><p>{{ $admin->roles[0]->name }}</p></td>
                                <td class="mr-3">
                                    <button class="btn btn-primary btn-sm modify-admin" data-profile-id="{{ $admin->id }}" data-toggle="modal" data-target="#modifyadmin">Modify</button>
                                </td>
                                <td class="mr-3" style="font-size: 15px;"><strong>{{ \Carbon\Carbon::parse($admin->created_at)->format('Y.m.d') }}</strong></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.modify-admin').click(function () {
                var adminId = $(this).data('profile-id');
                var adminName = $('.admin-profile-' + adminId + ' .admin-name').data('profile-name');
                var urlForm = $('#modifyadmin .update-user-admin');
                $('#modifyadmin input[name="name"]').val(adminName);
            });
        });
    </script>
@endsection
