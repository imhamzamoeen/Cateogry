<div>
    <a class="d-flex" href="#">
        <div class="list-item d-flex align-items-start">
            <div class="me-1">
                <div class="avatar"><img src="{{ asset('images/asf.png') }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/Default.png') }}';"
                        alt="avatar" width="32" height="32"></div>
            </div>
            <div class="list-item-body flex-grow-1">
                <p class="media-heading"><span class="fw-bolder">Congratulation
                        {{ auth()->user()->name }}
                        🎉</span>winner!</p><small class="notification-text"> Won the monthly
                    best seller badge.</small>
            </div>
        </div>
        
    </a>
</div>
