<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="../index-2.html">
                            <span class="pcoded-mtext">Default</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{url('products')}}">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Products</span>
                </a>
            </li>
            <li class="">
                <a href="{{url('flavours')}}">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Flavours</span>
                </a>
            </li>
            <li class="active">
                <a href="{{url('customers')}}">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Customers</span>
                </a>
            </li>
        </ul>
    </div>
</nav>