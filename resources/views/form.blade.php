<html>
<head>
    <title>Version protégée</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #B0BEC5;
            display: table;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .container {
            text-align: center;
            max-width: 500px;
            margin:70px auto;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 100;
        }

        input[type=password] {
            padding:5px 10px;
            font-size:24px;
            font-weight: 100;
            border:1px solid #aaa;
            margin-top:20px;
        }

        .message {
            color:red;
            font-weight: bold;
            margin:10px 0;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Ce site est en version beta</div>
        <p>Saisissez votre mot de passe pour y accéder</p>

        @if(session("message"))
            <div class="message">{{ session("message") }}</div>
        @endif

        <form action="{{ url("privat/form") }}" method="post">
            {{ csrf_field() }}

            <input type="password" name="password" placeholder="Password">

        </form>

    </div>
</div>
</body>
</html>
