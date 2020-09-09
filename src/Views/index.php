<html>
    <head>
        <link rel="stylesheet" href="../Common/CSS/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <?php

    ?>
    <?php if (!empty($_SESSION['params'])) : ?>
        <?php foreach ($_SESSION['params'] as $recipe) : ?>
        <div id="section">
            <h1><?= $recipe->name ?></h1>
            <div id="time">
                <p>Cooking Time: </p><?= $recipe->duration; ?>
            </div>
            <form method="post" id="servings">
                <input name="servings" type="number" placeholder="Enter Number of Servings">
                <textarea name="currentServings" style="display: none"><?= $recipe->servings ?></textarea>

                <input id="submit" type="button" value="Calculate">
            </form>
        </div>
        <div id="ingredients">
            <h1>Ingredients</h1>
            <ul>
                <?php foreach ($recipe->ingredients as $ingredient) : ?>
                <p><li data-name="<?= $ingredient->name; ?>"><?= $ingredient->display ?></li></p>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="methodSection">
            <h1 id="method">Method</h1>
            <?php foreach ($recipe->instructions as $instruction) : ?>
                <p><?= $instruction->text ?></p>
            <?php endforeach; ?>
            <br>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
        <script>
            $(document).ready(function() {
                let servingValue = [];
                $('#submit').on('click', function () {
                    var formData = $("#servings").serializeArray();
                    servingValue.push(formData[0]["value"]);
                    if (formData.length > 0 && servingValue[servingValue.length - 2] != formData[0]["value"]) {
                        $.ajax({
                            dataType: 'json',
                            type: 'POST',
                            url: <?= json_encode(str_replace('?/', '', str_replace('Script', 'Service', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '/ChangeIngredientPortionService.php')) ?>,
                            async: false,
                            data: {formData}
                        }).done(function (response) {
                            $('#ingredients').find('li').each(function() {
                                var current        = $(this).text();
                                var currentPortion = current.charAt(0);

                                if (currentPortion !== 'n') {

                                    if (currentPortion == '½') {
                                        currentPortion = 0.5
                                    }

                                    var newPortion = response * currentPortion;
                                    $(this).html(current.replace(current, newPortion) + current.substring(1));
                                }
                            });
                        });
                    }
                });
            });
        </script>
    </body>
</html>