@section('content')
<div class="pcoded-inner-content">
    <!-- Main body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Update Password</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">User Profile</a></li>
                        <li class="breadcrumb-item"><a href="#!">Update Password</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->

            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">Update Your Password</h5>
                            </div>
                            <div class="card-block">
                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success">
                                        {{ __('Your password has been updated successfully.') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('update-password.updatepassword') }}" class="form-material">
                                    @csrf

                                    <!-- Current Password -->
                                    <div class="form-group form-default">
                                        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                        <input id="current_password" name="current_password" type="password" class="form-control" >
                                    </div>
                                    <div><x-input-error :messages="$errors->get('current_password')" class="mt-2 text-left text-danger" /></div>


                                    <!-- New Password -->
                                    <div class="form-group form-default">
                                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                                        <input id="password" name="password" type="password" class="form-control" >
                                    </div>
                                    <div><x-input-error :messages="$errors->get('password')" class="mt-2 text-left text-danger" /></div>
                                    
                                    <!-- Confirm Password -->
                                    <div class="form-group form-default">
                                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" >
                                    </div>
                                    <div><x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-left text-danger" /></div>

                                    <!-- Buttons -->
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
    <!-- Main body end -->
</div>
@endsection
