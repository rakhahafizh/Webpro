<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('/storage/images/background2.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            color: #ffffff; /* Set text color to white */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        .overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .content {
            position: relative;
            z-index: 2;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }

        p {
            font-size: 1.2rem;
        }

        .btn-custom {
            background-color: #198754;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #145c32;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="content d-flex flex-column justify-content-center align-items-center text-center h-100">
        <h1>Welcome to Our Car Collection</h1>
        <p>Discover the latest and most exclusive cars with us.</p>
        <a href="{{ route('mobils.index') }}" class="btn btn-custom btn-lg mt-3">Explore Cars</a>
    </div>
</body>
</html>
