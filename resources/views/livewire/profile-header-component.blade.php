<!-- profile header -->
<div class="row">

    <div class="col-12">
        <div class="card profile-header mb-2">
            <!-- profile cover photo -->
            <img class="card-img-top" src="{{asset('images/headers/header.jpg')}}" alt="">
            <!--/ profile cover photo -->

            <div class="position-relative">
                <!-- profile picture -->
                <div class="profile-img-container d-flex align-items-center">
                    <div class="profile-img">
                        <div class="img-hover-zoom--colorize profilepic">


                            <img class="edit-user-img profilepic__image rounded img-fluid"
                                style="cursor: pointer;height:152px;width: 100%"
                                onerror="this.onerror=null;this.src='{{asset('images/users/default.png')}}';"
                                src="{{asset('images/users/')}}{{'/'.$user->image}}" alt="">


                            <div class="profilepic__content" wire:ignore.self>

                                {{-- <input id="file_pic" class="profilepic__icon " wire:model="image"
                                    accept=".jpg, .jpeg, .png" type="file" style="display: none"> --}}

                                <input id="file_pic" class="profilepic__icon" name="profile_pic"
                                    accept=".jpg, .jpeg, .png" type="file" style="display: none" />

                                <button type="button" id="pro1"
                                    class="btn btn-icon waves-effect waves-float waves-light"
                                    style="min-height: 100%;min-width:100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-camera">
                                        <path
                                            d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                        </path>
                                        <circle cx="12" cy="13" r="4"></circle>
                                    </svg>
                                    <span class="profilepic__text">Update Pic</span>
                                </button>
                            </div>

                        </div>

                    </div>
                    <!-- profile title -->
                    <div class="profile-title ms-3">
                        <h2 class="text-white user_name">{{$user->name}}</h2>
                        <p class="text-white">{{$user->user_type}}</p>

                    </div>
                </div>
            </div>

            <!-- tabs pill -->
            <div class="profile-header-nav">
                <!-- navbar -->
                <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100"
                    style="min-height: 50px">
                    <button class="btn btn-icon navbar-toggler waves-effect waves-float waves-light" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-align-justify font-medium-5">
                            <line x1="21" y1="10" x2="3" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="21" y1="18" x2="3" y2="18"></line>
                        </svg>
                    </button>

                    <!-- collapse  -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                            <ul class="nav nav-pills mb-0">

                            </ul>
                            <!-- edit button -->
                            {{-- <button class="btn btn-primary edit-btn waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-edit d-block d-md-none ">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span class="fw-bold d-none d-md-block">Edit</span>
                            </button> --}}
                        </div>
                    </div>
                    <!--/ collapse  -->
                </nav>
                <!--/ navbar -->
            </div>
        </div>
    </div>

</div>
<!--/ profile header -->


@push('extended-js')
<script>
    $("#pro1").click(function (e) {
    $("#file_pic").click();
});

function image_change() {
    $("#file_pic").click();
};


function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        $('.edit-user-img').attr('src',
            window.URL.createObjectURL(uploader.files[0]));
    }
}

$("#file_pic").change(function () {
    fasterPreview(this);  
    change_pic();
});

function change_pic() {
    var image = $("#file_pic")[0].files[0];
    var formdata = new FormData();
    formdata.append('pic', image);
    Ajax_Call_Dynamic("{{route('front.profile.pic_update')}}", 'POST', formdata, "ProfilePicUpdate", "FailedToasterResponse");

}

function ProfilePicUpdate(response){
  
toaster('success',response.response,'Profile');
}






</script>
@endpush