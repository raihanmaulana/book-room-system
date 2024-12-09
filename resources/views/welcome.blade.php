<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Ruangan Teknik Industri UNDIP</title>
</head>

<body>
    <div class="container flex">
        <!-- Bagian Kiri (Judul + Deskripsi) -->
        <div class="left-section flex-1 text-left p-10">
            <h1 class="form-title text-center">Peminjaman Ruangan</h1>
            <p class="text-lg">Dapatkan kemudahan dalam proses peminjaman ruangan di Teknik Industri Universitas Diponegoro.</p>
        </div>

        <!-- Bagian Kanan (Formulir Login & Sign Up) -->
        <div class="right-section flex-1 p-10">
            <div class="form-structor">
                <div class="signup">
                    <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-holder">
                            <!-- Name -->
                            <input type="text" class="input" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus />
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            <!-- NIM -->
                            <input type="text" class="input" name="nim" placeholder="NIM" value="{{ old('nim') }}" required />
                            @error('nim')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            <!-- Email -->
                            <input type="email" class="input" name="email" placeholder="Email" value="{{ old('email') }}" required />
                            @error('email')

                            @enderror

                            <!-- Password -->
                            <input type="password" class="input" name="password" placeholder="Password" required />
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            <!-- Confirm Password -->
                            <input type="password" class="input" name="password_confirmation" placeholder="Confirm Password" required />
                            @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="submit-btn">Sign up</button>
                    </form>
                </div>

                <div class="login slide-up">
                    <div class="center">
                        <h2 class="form-title" id="login"><span>or</span>Log in</h2>

                        <!-- Menampilkan pesan error jika login gagal -->
                        @if(session('error'))
                        <div class="text-red-500 text-sm mb-4">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-holder">
                                <!-- Email -->
                                <input type="email" class="input" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus />
                                @error('email')
                                @enderror

                                <!-- Password -->
                                <input type="password" class="input" name="password" placeholder="Password" required />
                                @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="submit-btn">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        console.clear();

        const loginBtn = document.getElementById('login');
        const signupBtn = document.getElementById('signup');

        // Fungsi untuk membuka form login
        const openLoginForm = () => {
            let loginForm = document.querySelector('.login');
            let signupForm = document.querySelector('.signup');

            // Menambahkan class 'slide-up' pada login dan menghapus dari signup
            loginForm.classList.remove('slide-up');
            signupForm.classList.add('slide-up');

            // Menyimpan status form terakhir yang dibuka
            localStorage.setItem('lastOpenedForm', 'login');
        };

        // Fungsi untuk membuka form signup
        const openSignupForm = () => {
            let signupForm = document.querySelector('.signup');
            let loginForm = document.querySelector('.login');

            // Menambahkan class 'slide-up' pada signup dan menghapus dari login
            signupForm.classList.remove('slide-up');
            loginForm.classList.add('slide-up');

            // Menyimpan status form terakhir yang dibuka
            localStorage.setItem('lastOpenedForm', 'signup');
        };

        // Event listener untuk tombol login
        loginBtn.addEventListener('click', (e) => {
            openLoginForm();
        });

        // Event listener untuk tombol signup
        signupBtn.addEventListener('click', (e) => {
            openSignupForm();
        });

        // Mengecek status form yang terakhir kali dibuka setelah reload halaman
        window.addEventListener('DOMContentLoaded', (event) => {
            const lastOpenedForm = localStorage.getItem('lastOpenedForm');
            if (lastOpenedForm === 'login') {
                openLoginForm();
            } else if (lastOpenedForm === 'signup') {
                openSignupForm();
            }
        });
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Fira+Sans");

        html,
        body {
            position: relative;
            min-height: 100vh;
            background-color: #E1E8EE;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Fira Sans", Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Flexbox Container */
        .container {
            display: flex;
            height: 100vh;
            background-image: url('https://ft.undip.ac.id/wp-content/uploads/WhatsApp-Image-2023-09-08-at-16.19.31-1080x675.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.85);
            /* Memberikan efek transparansi */
            border-radius: 12px;
            /* Sudut melengkung lebih halus */
            backdrop-filter: blur(10px);
            /* Efek blur pada latar belakang untuk memberi kesan elegan */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Bayangan halus */
        }

        .left-section h1 {
            font-size: 2.5rem;
            color: #333;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .left-section p {
            font-size: 1.2rem;
            color: #666;
            line-height: 1.6;
        }

        .right-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
        }

        .form-structor {
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
        }

        .form-title {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #0066B3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #00509e;
        }


        .form-structor {
            background-color: #222;
            border-radius: 15px;
            height: 600px;
            width: 350px;
            position: relative;
            overflow: hidden;

            &::after {
                content: '';
                opacity: .8;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-repeat: no-repeat;
                background-position: left bottom;
                background-size: 500px;
                background-image: url('https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bf884ad570b50659c5fa2dc2cfb20ecf&auto=format&fit=crop&w=1000&q=100');
            }

            .signup {
                position: absolute;
                top: 44%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                width: 65%;
                z-index: 5;
                -webkit-transition: all .3s ease;


                &.slide-up {
                    top: 5%;
                    -webkit-transform: translate(-50%, 0%);
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-holder,
                &.slide-up .submit-btn {
                    opacity: 0;
                    visibility: hidden;
                }

                &.slide-up .form-title {
                    font-size: 1em;
                    cursor: pointer;
                }

                &.slide-up .form-title span {
                    margin-right: 5px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;
                }

                .form-title {
                    color: #fff;
                    font-size: 1.7em;
                    text-align: center;

                    span {
                        color: rgba(0, 0, 0, 0.4);
                        opacity: 0;
                        visibility: hidden;
                        -webkit-transition: all .3s ease;
                    }
                }

                .form-holder {
                    border-radius: 15px;
                    background-color: #fff;
                    overflow: hidden;
                    margin-top: 50px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;

                    .input {
                        border: 0;
                        outline: none;
                        box-shadow: none;
                        display: block;
                        height: 30px;
                        line-height: 30px;
                        padding: 8px 15px;
                        border-bottom: 1px solid #eee;
                        width: 100%;
                        font-size: 12px;

                        &:last-child {
                            border-bottom: 0;
                        }

                        &::-webkit-input-placeholder {
                            color: rgba(0, 0, 0, 0.4);
                        }
                    }
                }

                .submit-btn {
                    background-color: rgba(0, 0, 0, 0.4);
                    color: rgba(256, 256, 256, 0.7);
                    border: 0;
                    border-radius: 15px;
                    display: block;
                    margin: 15px auto;
                    padding: 15px 45px;
                    width: 100%;
                    font-size: 13px;
                    font-weight: bold;
                    cursor: pointer;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;

                    &:hover {
                        transition: all .3s ease;
                        background-color: rgba(0, 0, 0, 0.8);
                    }
                }
            }

            .login {
                position: absolute;
                top: 20%;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #fff;
                z-index: 5;
                -webkit-transition: all .3s ease;

                &::before {
                    content: '';
                    position: absolute;
                    left: 50%;
                    top: -20px;
                    -webkit-transform: translate(-50%, 0);
                    background-color: #fff;
                    width: 200%;
                    height: 250px;
                    border-radius: 50%;
                    z-index: 4;
                    -webkit-transition: all .3s ease;
                }

                .center {
                    position: absolute;
                    top: calc(50% - 10%);
                    left: 50%;
                    -webkit-transform: translate(-50%, -50%);
                    width: 65%;
                    z-index: 5;
                    -webkit-transition: all .3s ease;

                    .form-title {
                        color: #000;
                        font-size: 1.7em;
                        text-align: center;

                        span {
                            color: rgba(0, 0, 0, 0.4);
                            opacity: 0;
                            visibility: hidden;
                            -webkit-transition: all .3s ease;
                        }
                    }

                    .form-holder {
                        border-radius: 15px;
                        background-color: #fff;
                        border: 1px solid #eee;
                        overflow: hidden;
                        margin-top: 50px;
                        opacity: 1;
                        visibility: visible;
                        -webkit-transition: all .3s ease;

                        .input {
                            border: 0;
                            outline: none;
                            box-shadow: none;
                            display: block;
                            height: 30px;
                            line-height: 30px;
                            padding: 8px 15px;
                            border-bottom: 1px solid #eee;
                            width: 100%;
                            font-size: 12px;

                            &:last-child {
                                border-bottom: 0;
                            }

                            &::-webkit-input-placeholder {
                                color: rgba(0, 0, 0, 0.4);
                            }
                        }
                    }

                    .submit-btn {
                        background-color: #6B92A4;
                        color: rgba(256, 256, 256, 0.7);
                        border: 0;
                        border-radius: 15px;
                        display: block;
                        margin: 15px auto;
                        padding: 15px 45px;
                        width: 100%;
                        font-size: 13px;
                        font-weight: bold;
                        cursor: pointer;
                        opacity: 1;
                        visibility: visible;
                        -webkit-transition: all .3s ease;

                        &:hover {
                            transition: all .3s ease;
                            background-color: rgba(0, 0, 0, 0.8);
                        }
                    }
                }

                &.slide-up {
                    top: 90%;
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .center {
                    top: 10%;
                    -webkit-transform: translate(-50%, 0%);
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-holder,
                &.slide-up .submit-btn {
                    opacity: 0;
                    visibility: hidden;
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-title {
                    font-size: 1em;
                    margin: 0;
                    padding: 0;
                    cursor: pointer;
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-title span {
                    margin-right: 5px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;
                }
            }
        }
    </style>
</body>

</html>