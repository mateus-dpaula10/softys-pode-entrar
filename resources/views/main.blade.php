<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
        crossorigin="anonymous"
    >
    <link rel="icon" type="image/png" href="{{ asset('img/elements/Logo-02.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="box_header" data-aos="fade-right" data-aos-duration="3000">
                        <img src="{{ asset('img/logos/logo_azul.png') }}" alt="Logo Pode Entrar">
                        <h1>Celebrações que <br> <strong>aproximam</strong></h1>
                        <h3>
                            A Softys estará de portas abertas para receber a sua família em um momento especial!
                        </h3>
                        <p>
                            O Pode Entrar é um evento especial em que recebemos as famílias dos nossos colaboradores dentro de nossas fábricas. 
                            Um momento para mostrar, com orgulho, o que fazemos todos os dias e compartilhar com quem mais amamos o cuidado que 
                            nos une.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-duration="3000">
                    <img src="{{ asset('img/logos/logo_azul.png') }}" alt="Logo Pode Entrar">
                    <p>
                        O Pode Entrar é um evento especial em que recebemos as famílias dos nossos colaboradores dentro de nossas fábricas. 
                        Um momento para mostrar, com orgulho, o que fazemos todos os dias e compartilhar com quem mais amamos o cuidado que nos une.
                    </p>
                    <small>
                        © 2025 – Todos os direitos reservados – Desenvolvido por 
                        <a href="https://www.instagram.com/hiatocomunicacao">Hiato Comunicação</a>
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
</body>
</html>