@extends('theme-views.layouts.app')

@section('title', translate('my_profile') . ' | ' . $web_config['name']->value . ' ' . translate('ecommerce'))

@section('content')
    <section class="user-profile-section section-gap pt-0">
        <div class="container">

            @include('theme-views.partials._child_list')

            <div class="tab-content">


                <div class="address-details px-md-4">
                    <h4 class="subtitle mb-3 mx-2 text-capitalize">{{ translate('My_Children') }}</h4>
                    <div class="row">
                        <div class="col-md-6 custom-spacing">
                            <div class="child_list">
                                <table class="table-responsive table-borderless w-100">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($childs as $child)
                                        <?php $childDob = \Carbon\Carbon::parse($child->dob);
                                        $diff = $childDob->diff(\Carbon\Carbon::now());
                                        $formattedAge = '';
                                        
                                        if ($diff->y > 0) {
                                            $formattedAge .= $diff->y . 'Y';
                                        }
                                        
                                        if ($diff->m > 0) {
                                            $formattedAge .= ($formattedAge ? ' ' : '') . $diff->m . 'M';
                                        }
                                        
                                        // If the age is less than a month, display "New Born"
                                        if ($diff->y == 0 && $diff->m == 0) {
                                            $formattedAge = 'New Born';
                                        }
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle me-2"
                                                        src="{{ asset('public/assets/images/customers/child/' . $child->profile_picture) }}"
                                                        width="50px" height="50px">
                                                </td>
                                                <td>{{ $child->name }}</td>
                                                <td>{{ $formattedAge }}</td>
                                                <td><a href="{{ route('my-child.destroy', $child->id) }}"><button
                                                            type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Create Child</h4>
                            <form action="{{ route('my-child.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- {{ dd(Auth::guard('customer')->id()) }} --}}
                                <input type="hidden" name="user_id" value="{{ Auth::guard('customer')->id() }}">
                                <div class="col-md-12 row mt-3">
                                    <label for="" class="form-label">Name</label>
                                    <input required type="text" name="name" placeholder="Enter Name"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-12 row mt-3">
                                    <label for="" class="form-label">Relation Type</label>
                                    <input required type="text" name="relation_type" placeholder="Enter Relation Type"
                                        class="form-control" required>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Profile Picture</label>
                                        <input required type="file" name="profile_picture" placeholder="Enter Image"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Date Of Birth</label>
                                        <input required type="date" name="dob" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 row mt-3">
                                    <label for="" class="form-label">Gender</label>
                                    <select class="form-control" name="gender" id="">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="row mt-3 text-center">
                                    <button type="submit" class="btn seller_reg">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($childs) <= 0)
                        <div class="text-center pt-5 w-100 custom-space">
                            <div class="text-center mb-5 custom-space">
                                <img loading="lazy" src="{{ theme_asset('assets/img/icons/no-child.svg') }}"
                                    alt="{{ translate('address') }}" width="200px" height="200px">
                                <h5 class="my-3 pt-4 text-muted">{{ translate('no_child_found') }}!</h5>
                                {{-- <p class="text-center text-muted">{{ translate('please_add_your_address_for_your_better_experience') }}</p> --}}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        </div>
        <style>
            tbody tr td {
                padding-bottom: 10px;
            }
            @media (max-width: 767px) {
                .custom-space {
                    margin-bottom: 0 !important;
                }

                .custom-space {
                    padding-top: 0 !important;
                }

                .custom-spacing {
                    margin-bottom: 20px !important;
                }
            }
        </style>
    </section>
@endsection
