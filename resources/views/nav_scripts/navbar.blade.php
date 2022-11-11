<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wholestore Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>
    <div class="container" style="background-color: rgba(211, 200, 200, 0.288)">

        {{-- Navbar Code --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div>
                    <a class="navbar-brand" href="{{ route('index') }}"><img
                            src="{{ asset('public/images/product/logo.jpg') }}" alt="" style="width: 10%"></a>
                </div>
                @if (Auth::check())
                    @if (Auth::user()->role_id == App\Models\User::ROLE_ADMIN)
                        <div>
                            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ route('productList') }}">Products</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profile
                            </a>
                            @if (Auth::user())
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"><i
                                                class="bi bi-person-fill"></i>{{ Auth::user()->name }}</a></li>
                                    <li><a class="dropdown-item" type="button" href="{{ route('logout') }}">Logout</a>
                                    </li>
                                </ul>
                            @else
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Register</a></li>
                                    <li><a class="dropdown-item" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Login</a>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Success Alert Message --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        {{-- Alert Message --}}
        @if ($message = Session::get('message'))
            <div class="alert alert-warning alert-block" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @yield('content')
        
    </div>

    <!--Register User Form Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Register User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="registerName">
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="registerEmail"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="registerPassword">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" name="role_id" type="radio"
                                name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Normal User
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" name="role_id" type="radio"
                                name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Premium User
                            </label>
                        </div>
                        <div><small><b>Note: </b> Premium User will cost you 10$/Month</small> </div>
                        <button type="submit" class="btn btn-primary mt-2">Signup</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Login User Offcanvas --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Login User</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="LoginEmail" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="LoginEmail"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="LoginPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="LoginPassword">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <script>
        $('.btnS').click(function(e) {
            e.preventDefault();
            var special_price = $(this).closest('._js_special_tdata').find('.special_price').val();
            var product_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "{{ route('specialPrice') }}",
                data: {
                    'special_price': special_price,
                    'product_id': product_id,
                },
                success: function(response) {
                    alert('success')
                    location.reload();
                }
            });
        });
    </script>


</body>

</html>
