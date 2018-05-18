<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="XKCDBot brings relevant XKCDs into your Slack teams via an easy to use slash command.">
    <meta name="keywords" content="xkcd,slack,comics,bot,slash command">
    <meta name="author" content="Chris White">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')XKCD for Slack</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css">

    <link rel="icon" href="/img/favicon.png">
</head>
<body>
<div class="content clearfix">
    @yield('content')
</div>
<div class="footer">
    <p><a href="/privacy">Privacy Policy</a>. <a href="/support">Support</a>. Made by <a href="https://cwhite.me">Chris White</a>. <strong>NOT</strong> an official XKCD project. Original web design by Randall Munroe.</p>
</div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-62546558-3', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
