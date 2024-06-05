<div class="col-lg-3 col-12 order-2 order-lg-1">
    <!-- about -->
    <div class="card">
        <div class="card-body">
            <h5 class="mb-75">Name</h5>
            <p class="card-text user_name">
                {{$user->name}}
            </p>
            <div class="mt-2">
                <h5 class="mb-75">Email:</h5>
                <p class="card-text user_email"> {{$user->email}}</p>
            </div>
            <div class="mt-2">
                <h5 class="mb-75">Role</h5>
                <p class="card-text ">{{$user->user_type}}</p>
            </div>
            <div class="mt-2">
                <h5 class="mb-75">Joined:</h5>
            <p class="card-text"> {{$user->created_at->format('D M Y')}} </p>
            </div>

        </div>
    </div>
    <!--/ about -->



    <!-- My companies -->
    {{-- <div class="card">
        <div class="card-body">
            <h5>My Companies</h5>

            <div class="profile-twitter-feed mt-1">

                <p class="card-text mb-50">No Companies Assigned
                </p>

            </div>
        </div>
    </div> --}}
    <!--/ twitter feed card -->
</div>