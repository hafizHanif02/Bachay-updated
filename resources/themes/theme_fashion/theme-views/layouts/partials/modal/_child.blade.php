<div class="modal fade __sign-in-modal" id="ChildModel" tabindex="-1" aria-labelledby="ChildModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="logo">
                    <a href="javascript:">
                        <img loading="lazy" alt="{{ translate('logo') }}"
                            src="{{ getValidImage(path: 'storage/app/public/company/' . $web_config['web_logo']->value, type: 'logo') }}">
                    </a>
                </div>
                <h3 class="title text-capitalize">Switch User</h3>
                <div class="row mb-5 mt-3">
                    <div class="col-12 text-end">
                        <button type="button" class="btn drp-btn">Add Child</button>
                    </div>
                </div>
                <?php $childs = \App\Models\FamilyRelation::where('user_id', Auth::guard('customer')->user()->id)->get();
                     ?>
                    @foreach ($childs as $child)
                    <form action="{{ route('switch_child', $child->id) }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-borderless">
                                    <tr>
                                        <th><label class="disabled form-label form--label" for="login_email"><img style="width: 50px;" src="{{asset('public/assets/images/customers/child/'.$child->profile_picture)}}" alt=""></label></th>
                                        <th>{{ $child->name }}</th>
                                        <th><button class="btn btn-{{ $child->gender == 'male' ? 'primary' : 'custom-pink' }}">Switch</button></th>
                                    </tr>
                                </table>
                                
                        </div>
                    </form>
                    @endforeach
            </div>
        </div>
    </div>
</div>
<style>
    .btn-custom-pink {
        color: #fff;
        background-color: #ff69b4; 
        border-color: #ff69b4; 
    }

    .btn-custom-pink:hover {
        background-color: #ff5aa8; 
        border-color: #ff5aa8; 
    }
</style>
