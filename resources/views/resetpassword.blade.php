<title>Recuperación de Contraseña</title>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column
    }

    h1 {
        color: #2c3e50;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        background-color: seagreen;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        width: 40%;
        text-align: center;
    }

    .divider {
        width: 200px;
        height: 10px;
        background: seagreen;
        margin: 20px 0;
    }

    .footer {
        margin-top: 20px;
        font-size: 0.9em;
        color: #777;
    }

    .footer a {
        color: seagreen;
    }

    img {
        object-fit: cover;
        width: 50%;
        height: auto;
    }
</style>
</head>

<body>
    <div class="container">
        <h1>Recupera tu Contraseña</h1>
        <p>Para restrablecer la contraseña presiona aqui:</p>
        <a href="http://localhost:4200/reset/password/{{$token}}?use_id={{$use_id}}" class="btn">Recuperar Contraseña</a>


        <img src="{{ asset('assets/img/logoVF.png') }}" alt="logo">

        <p class="footer">Att: <a href="https://mercadoagroecologico.org">Mercado agroecológico 4.0</a></p>

    </div>
