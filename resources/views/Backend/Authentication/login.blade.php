<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('translation.Admin-Login')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* From Uiverse.io by 3bdel3ziz-T */
        .card {
            --main-col: #ffeba7;
            --bg-col: #2a2b38;
            --bg-field: #1f2029;

            width: 500px;
            padding: 1.9rem 1.2rem;
            text-align: center;
            background: var(--bg-col);
            border-radius: 10px;
            border: 1px solid var(--main-col);
            user-select: none;
        }

        /*Inputs*/
        .field {
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 0.5rem;
            gap: 0.5rem;
            background-color: var(--bg-field);
            border-radius: 4px;
        }

        .input-icon {
            width: 1em;
            color: var(--main-col);
            fill: var(--main-col);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-field {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            color: var(--main-col);
            padding: 0.5em 1em 0.5em 0;
            caret-color: var(--main-col);
        }

        .filed:has(.input-field:valid) {
            border: 1px solid var(--main-col);
        }

        /*Text*/
        .title {
            margin-bottom: 1rem;
            font-size: 1.5em;
            font-weight: 500;
            color: var(--main-col);
            text-shadow: 1px 1px 20px var(--main-col);
            text-transform: uppercase;
        }

        /*Buttons*/
        .btn {
            margin: 1rem;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.8em;
            text-transform: uppercase;
            padding: 0.6em 1.2em;
            background-color: var(--main-col);
            color: var(--bg-col);
            box-shadow: 0 8px 24px 0 rgb(255 235 167 / 20%);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .btn-link {
            color: #f5f5f5;
            display: block;
            font-size: 0.75em;
            transition: color 0.3s ease-out;
        }

        /*Hover & focus*/
        .field input:focus::placeholder {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn:hover {
            background-color: var(--bg-field);
            color: var(--main-col);
            box-shadow: 0 8px 24px 0 rgb(16 39 112 / 20%);
        }

        .btn-link:hover {
            color: var(--main-col);
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card">
            <h4 class="title">Log In!</h4>

            <!-- Show errors if any -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <label class="field" for="logemail">
                    <span class="input-icon">@</span>
                    <input autocomplete="on" id="email" placeholder="Email" class="input-field" name="email"
                        type="email" value="{{ old('email') }}" />
                </label>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <label class="field" for="logpass">
                    <svg class="input-icon" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z">
                        </path>
                    </svg>
                    <input autocomplete="on" id="logpass" placeholder="Password" class="input-field" name="password"
                        type="password" />
                </label>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
