@section('title')
Profile
@endsection
@section('content')
<div class="pcoded-inner-content">
    <!-- Main body start -->
    <div class="main-body user-profile">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>User Profile</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">User Profile</a></li>
                        <li class="breadcrumb-item"><a href="#!">User Profile</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->

            <!-- Page-body start -->
            <div class="page-body">
                <!-- profile cover start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cover-profile">
                            <div class="profile-bg-img">
                                <img class="profile-bg-img img-fluid" src="{{asset('assets/auth/images/user-profile/bg-img1.jpg')}}" alt="bg-img">
                                <div class="card-block user-info">
                                    <div class="col-md-12">
                                        <div class="media-left">
                                            <a href="#" class="profile-image">
                                                <img class="user-img img-circle " src="{{asset('storage/'.Auth::user()->file_name)}}" alt="user-img" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                            </a>
                                        </div>
                                        <div class="media-body row">
                                            <div class="col-lg-12">
                                                <div class="user-title">
                                                    <h2>{{ $user->name }}</h2>
                                                    <span class="text-white">Web designer</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- profile cover end -->

                <!-- tab content start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <!-- tab panel personal start -->
                            <div class="tab-pane active" id="personal" role="tabpanel">
                                <!-- personal card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">About Me</h5>
                                    </div>
                                    <div class="card-block">
                                        <!-- Edit Info Form -->
                                        <div id="profile-info-edit">
                                            <form method="POST" id="editprofile" action="{{ route('user-profile-information.update') }}" class="mt-6 space-y-6">
                                                @csrf
                                                @method('put')

                                                <div class="row">
                                                    <!-- Full Name Input -->
                                                    <div class="col-lg-6 input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full form-control" :value="old('name', $user->name)" autofocus autocomplete="name" />
                                                        <div><x-input-error class="mt-2 text-danger" :messages="$errors->updateProfileInformation->get('name')" /></div>
                                                    </div>
                                                    
                                                    <!-- Email Input -->
                                                    <div class="col-lg-6 input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-email"></i></span>
                                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full form-control" :value="old('email', $user->email)" autocomplete="email" />
                                                        <x-input-error class="mt-2 text-danger" :messages="$errors->updateProfileInformation->get('email')" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- City Input -->
                                                    <div class="col-lg-6 input-group">
                                                        <span class="input-group-addon"><i class="ti-location-pin"></i></span>
                                                        <x-text-input id="city" name="city" type="text" class="mt-1 block w-full form-control" :value="old('city', $user->city)" autofocus autocomplete="city" />
                                                        <div><x-input-error class="mt-2 text-danger" :messages="$errors->updateProfileInformation->get('city')" /></div>
                                                    </div>
                                                    
                                                    <!-- Phone Input -->
                                                    <div class="col-lg-6 input-group">
                                                        <span class="input-group-addon"><i class="ti-mobile"></i></span>
                                                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full form-control" :value="old('phone', $user->phone)" autocomplete="phone" />
                                                        <div class="text-danger" id="phoneError"></div> <!-- Error message will appear here -->
                                                    </div>
                                                    
                                                </div>


                                                <div class="flex items-center gap-4">
                                                    <!-- Save Button with the primary color -->
                                                    <x-primary-button class="btn-primary">{{ __('Save') }}</x-primary-button>
                                                 
                                                    <!-- Cancel Button with a light grey background to match the theme -->
                                                    <button type="button" id="cancel-btn" class="btn text-[#132043] border-[#132043] ">{{ __('Cancel') }}</button>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- personal card end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tab content end -->
            </div>
            <!-- Page-body end -->
        </div>
    </div>
    <!-- Main body end -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#editprofile').on('submit', function (e) {
            e.preventDefault();  // Prevent form submission
    
            // Clear previous errors
            $('#phoneError').text('');
    
            var phone = $('#phone').val().trim();
            var isValid = true;
    
            // Phone Validation: check if the phone number is 10 digits
            if (phone === '') {
                $('#phoneError').text('Please enter your phone number.');
                isValid = false;
            } else if (!/^[0-9]{10}$/.test(phone)) {
                $('#phoneError').text('Please enter a valid 10-digit phone number.');
                isValid = false;
            }
    
            // Submit if valid
            if (isValid) {
                this.submit();  // Submit the form
            }
        });
    
        // Cancel button functionality
        $('#cancel-btn').on('click', function () {
            $('#phoneError').text('');  // Clear any error messages when the cancel button is clicked
        });
    });
</script>    
</div>
@endsection
