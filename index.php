<!DOCTYPE html>
<html>
<head>
    <title></title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.css">
    
    <style>
        body { padding-top: 40px; }
    </style>
</head>
<body>
    <div id="root" class="container">
        <tabs>
            <tab name="About Us" :selected="true">
                <h1>Here is the content for the about us tab.</h1>
            </tab>

            <tab name="About Our Culture">
                <h1>Here is the content for the about our culture tab.</h1>
            </tab>

            <tab name="About Our Vision">
                <h1>Here is the content for the about our vision tab.</h1>
            </tab>
        </tabs>
    </div>

    <script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>
    <script src="main.js"></script>
</body>
</html>