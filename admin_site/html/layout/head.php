<head>
<!--<meta name="csrf-token" content="{!! csrf_token() !!}">-->

    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Semantic UI-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>

    <title>
        <?php
            echo isset($title)?$title:""
        ?>
    </title>
</head>