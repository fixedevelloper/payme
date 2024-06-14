<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{!! route('admin.bc_dashboard') !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
                <li><a href="{!! route('admin.bc_transactions') !!}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-list-1"></i>
                        <span class="nav-text">Transactions</span>
                    </a>
                </li>
                <li><a href="{!! route('admin.bc_customers') !!}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-user-5"></i>
                        <span class="nav-text">Customers</span>
                    </a>
                </li>
            <li>
                    <span class="nav-header">My Trips</span>
            </li>
            <li><a href="{!! route('admin.bc_countries') !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-flag"></i>
                    <span class="nav-text">Countries</span>
                </a>
            </li>
            <li><a href="{!! route('admin.bc_currencies') !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-shuffle"></i>
                    <span class="nav-text">Currencies</span>
                </a>
            </li>
            <li><a href="{!! route('admin.bc_banners') !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-id-card-5"></i>
                    <span class="nav-text">Banners</span>
                </a>
            </li>
            <li><a href="#" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-1"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>

            <li><a href="{!! route('auth.sign_out') !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-lock-1"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
        <div class="copyright">
            <p><strong>{!! config('app.name') !!}</strong> © 2024 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by Creativ-soft</p>
        </div>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
