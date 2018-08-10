
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
            <h1>Word document creation with CD templates using PHPWord and XPath</h1>
        </div>
    </div>


    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <div class="callout"><h5>We bet you&rsquo;ll need a form somewhere:</h5>
                <form name="templateProcessor" method="post" action="export.php">
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <label>Input Label</label>
                            <input type="text" placeholder="large-12.cell"/>
                        </div>
                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="large-4 medium-4 cell">
                            <label>Input Label</label>
                            <input type="text" placeholder="large-4.cell"/>
                        </div>
                        <div class="large-4 medium-4 cell">
                            <label>Input Label</label>
                            <input type="text" placeholder="large-4.cell"/>
                        </div>
                        <div class="large-4 medium-4 cell">
                            <div class="grid-x">
                                <label>Input Label</label>
                                <div class="input-group">
                                    <input type="text" placeholder="small-9.cell" class="input-group-field"/>
                                    <span class="input-group-label">.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <label>Select Box</label>
                            <select>
                                <option value="husker">Husker</option>
                                <option value="starbuck">Starbuck</option>
                                <option value="hotdog">Hot Dog</option>
                                <option value="apollo">Apollo</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="large-6 medium-6 cell">
                            <label>Choose Your Favorite</label>
                            <input type="radio" name="pokemon" value="Red" id="pokemonRed"><label for="pokemonRed">Radio
                                1</label>
                            <input type="radio" name="pokemon" value="Blue" id="pokemonBlue"><label for="pokemonBlue">Radio
                                2</label>
                        </div>
                        <div class="large-6 medium-6 cell">
                            <label>Check these out</label>
                            <input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
                            <input id="checkbox2" type="checkbox"><label for="checkbox2">Checkbox 2</label>
                        </div>
                    </div>
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <label>Textarea Label</label>
                            <textarea placeholder="small-12.cell"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="button" value="Submit">
                </form>
            </div>

            <div class="large-4 medium-4 cell">
                <h5>Try one of these buttons:</h5>
                <p><a href="#" class="button">Simple Button</a><br/>
                    <a href="#" class="success button">Success Btn</a><br/>
                    <a href="#" class="alert button">Alert Btn</a><br/>
                    <a href="#" class="secondary button">Secondary Btn</a></p>
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