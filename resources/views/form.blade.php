<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans("privat::ui.page_title") }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            animation: backgroundAnimation 10s infinite alternate;
        }

        @keyframes backgroundAnimation {
            0% { background-color: #f4f4f4; }
            50% { background-color: #e6f7ff; }
            100% { background-color: #fce4ec; }
        }

        .lock-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 20px;
            color: #666;
            font-weight: normal;
        }

        .error {
            color: #dc3545;
        }

        .input-container {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        input {
            padding: 14px;
            font-size: 18px;
            border: none;
            outline: none;
            width: 280px;
            text-align: center;
        }

        button {
            padding: 14px 18px;
            font-size: 18px;
            border: none;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<svg class="lock-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6 10V8C6 4.69 8.69 2 12 2C15.31 2 18 4.69 18 8V10M6 10H18M6 10H5C3.9 10 3 10.9 3 12V20C3 21.1 3.9 22 5 22H19C20.1 22 21 21.1 21 20V12C21 10.9 20.1 10 19 10H18M12 14V18M12 18H10M12 18H14" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<h1>{{ trans("privat::ui.form_title") }}</h1>

@if(session("error"))
    <h2 class="error">{{ session("error") }}</h2>
@else
    <h2>{{ trans("privat::ui.form_help") }}</h2>
@endif

<form class="input-container" action="{{ url("privat") }}" method="post">
    @csrf
    <input type="password" name="password" placeholder="{{ trans("privat::ui.form_field_placeholder") }}">
    <button type="submit">OK</button>
</form>
</body>
</html>