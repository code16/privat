<html>
<head>
    <title>{{ trans("privat::ui.page_title") }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #c7ced4;
            color: #738492;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-weight: 100;
            font-size:19px;
        }

        .container {
            height: 100%;
            display: table;
            text-align: center;
            margin: 0 auto;
            padding: 0 1em;
        }

        .content {
            display: table-cell;
            vertical-align: middle;
            margin: 1em;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        input[type=password] {
            padding:10px;
            font-size:18px;
            font-weight: 200;
            border:1px solid #859aaa;
            margin-top:20px;
            width: 100%;
            text-align: center;
            border-radius: 3px;
        }

        .message {
            color:red;
            font-weight: normal;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">{{ trans("privat::ui.form_title") }}</div>

        @if(session("message"))
            <p class="message">{{ session("message") }}</p>
        @else
            <p>{{ trans("privat::ui.form_help") }}</p>
        @endif

        <form action="{{ url("privat") }}" method="post">
            {{ csrf_field() }}

            <input type="password" name="password" placeholder="{{ trans("privat::ui.form_field_placeholder") }}">
            <button type="submit">{{ trans("privat::ui.button_text") }}</button>

        </form>

    </div>
</div>
</body>
</html>
