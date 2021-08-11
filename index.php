<html>

<head>
</head>

<body>
    <?php
    switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
        case '/':
            require 'home.php';
            break;
        case '/home':
            require 'home.php';
            break;
        case '/form':
            require 'form.php';
            break;
        case '/action.php':
            require 'action.php';
            break;
        case '/bigquery':
            require 'bigquery.php';
            break;
        case '/dashboard':
            require 'dashboard.php';
            break;
        case '/listenbrainz':
            require 'listenbrainz.php';
            break;
        default:
            http_response_code(404);
            exit('Not Found');
    }
    ?>
</body>

</html>