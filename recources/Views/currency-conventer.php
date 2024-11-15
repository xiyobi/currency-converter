
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currency Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="recources/Css/style.css">
</head>
<body>
<div class="currency-section text-center pt-5 bg-primary-subtle">
    <h1>Currency Converter Shehroz</h1>
    <p>Need to make an international business payment? Take a look at our live foreign exchange rates.</p>
    <div class="currency-card">
        <h3>Make fast and affordable international business payments</h3>
        <p>Send secure international business payments in XX currencies, all at competitive rates with no hidden
            fees.</p>
        <form>
            <div class="row g-3 align-items-center">
                <div class="col-md-5">
                    <label for="amount" class="form-label visually-hidden">Amount</label>
                    <input type="number" id="amount" class="form-control" placeholder="Amount" name="amount" value="10000">
                </div>
                <div class="col-md-3 text-center">
                    <select class="form-select" name = "fromCurrency">

                        <?php
                            global $currency;
                            $currencies = $currency->getCurrencies();
                            foreach($currencies as $key=>$currency_rate):
                                    echo '<option value="'.$key.'">'.$key.'</option>';
                                ?>
                                <?php endforeach;?>
                        <option value = "UZS">UZS</option>

                    </select>
                </div>
                <div class="col-md-3 text-center">
                    <select class="form-select"  name="toCurrency">

                        <option>UZS</option>

                        <?php
                        foreach($currencies as $key=>$currency_rate):
                            echo '<option value="'.$key.'">'.$key.'</option>';?>
                        <?php endforeach;?>
                        <option value = "UZS">UZS</option>


                    </select>
                </div>
            </div>
            <p class="rate-info mt-2">
                <?php
                if (isset($_GET['fromCurrency']) and isset($_GET['toCurrency']) and isset($_GET['amount'])):
                    $fromCurrency = $_GET['fromCurrency'];
                    $toCurrency = $_GET['toCurrency'];
                    $amount = (int)$_GET['amount'];
                    echo $currency->exchange($fromCurrency, $toCurrency, $amount);
                endif;
                ?>
            </p>
            <button type="submit" class="btn btn-primary btn-primary-custom mt-3">Convert</button>
        </form>

    </div>
</div>
<div class="info-section bg-light">
    <h4 class="fw-bold">Let’s look weather</h4>
    <p class="text-muted">information of Weather</p>
    <a class="btn btn-outline-danger" href="./weather.php">Weather</a>
</div>
</body>
</html>
