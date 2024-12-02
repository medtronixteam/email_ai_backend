
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Design</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #fff;
        }

        /* Main Container */
        .newsletter-container {
            text-align: center;
            background-color: #222;
            padding: 30px;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* Weekly News Ribbon */
        .ribbon {
            background-color: #fff;
            color: #000;
            padding: 5px 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            border-radius: 5px;
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Title Styles */
        .newsletter-title {
            font-size: 32px;
            font-weight: bold;
            margin-top: 30px;
            letter-spacing: 1px;
        }

        /* Placeholder Text */
        .description {
            margin-top: 15px;
            font-size: 14px;
            color: #ccc;
            line-height: 1.5;
            padding: 0 10px;
        }

        /* Social Icons */
        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            margin: 0 10px;
            display: inline-block;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #bbb;
        }
    </style>
</head>
<body>

    <div class="newsletter-container">
        <!-- Ribbon -->
        <div class="ribbon">WEEKLY NEWS</div>

        <!-- Title -->
        <div class="newsletter-title">{{$title}}</div>

        <!-- Placeholder Text -->
        <div class="description">
            <p>{{$description}}</p>
        </div>

        <!-- Social Media Icons -->
        
    </div>

</body>
</html>

