<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Processor</title>
    <link rel="stylesheet" href="/assets/css/foundation.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <h1>Insert a DataSet for the TemplateProcessor</h1>
        </div>
    </div>

    <!-- TODO: Adjust Form and corresponding JSON in export.php -->

    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <div class="callout"><h5>Guest List for the party</h5>
                <form name="templateProcessor" method="post" action="export.php">
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <label><b>Name:</b></label>
                            <input type="text" name="name" placeholder="name"/>
                        </div>
                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <label><b>Street:</b></label>
                            <input type="text" name="street" placeholder="street"/>
                        </div>
                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <label><b>City:</b></label>
                            <input type="text" name="city" placeholder="city"/>
                        </div>
                    </div>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/vendor/jquery.js"></script>
<script src="/assets/js/vendor/what-input.js"></script>
<script src="/assets/js/vendor/foundation.js"></script>
<script src="/assets/js/app.js"></script>

</body>
</html>

<?php

