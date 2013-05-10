<?php
    require 'Envato_marketplaces.php';
    require 'config.php';

    $e = new Envato_marketplaces();
    $e->set_api_key($config['api_key']);

    if (isset($_POST['submitted'])) {
        $v = $e->verify_purchase($config['username'],$_POST['purchase-code']);
    }
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Envato Marketplace Purchase Verifier</title>
    <meta name="description" content="Envato Marketplace Purchase Verifier">
    <meta name="author" content="Higher Ground Studio">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">
    <link rel="stylesheet" href="assets/css/main-1.0.1.css">
    <script src="assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body class="verify animated fadeIn">
    <div id="verify-container" class="container animated fadeInRightBig">
        
        <h5 class="page-header-sub">Envato Marketplace Purchase Verifier</h5>

        <form id="verify-form" action="index.php" method="post" class="form-inline" style="display: block;">
            <input type="hidden" name="submitted" value="true" />
            <div class="control-group">
                <div class="input-append">
                    <input type="text" id="purchase-code" name="purchase-code" placeholder="Purchase Code..">
                    <span class="add-on"><i class="icon-barcode"></i></span>
                </div>
            </div>
            <div class="control-group verify-btn">
                <input type="submit" value="Verify" class="btn btn-info btn-block">
            </div>
        </form>
    </div>
    <?php if (isset($_POST['submitted'])): ?>
        <div id="results" class="<?php echo(isset($v->buyer) ? "valid" : "invalid"); ?> container animated fadeInLeftBig">
                <h2><?php echo(isset($v->buyer) ? "Valid Purchase" : "Invalid Purchase"); ?></h2>
                <?php if ($v==null) { echo 'No other data available'; } else { ?>
                <ul>
                    <li><strong>Item Name:</strong> <?php echo $v->item_name; ?></li>
                    <li><strong>Item ID:</strong> <?php echo $v->item_id; ?></li>
                    <li><strong>Licence:</strong> <?php echo $v->licence; ?></li>
                    <li><strong>Buyer:</strong> <?php echo $v->buyer; ?></li>
                    <li><strong>Purchase Code:</strong> <?php echo $_POST['purchase-code']; ?></li>
                    <li><strong>Purchase Time &amp; Date:</strong> <?php echo $v->created_at; ?></li>
                </ul>
                <?php } ?>
        </div>
    <?php endif; ?>
    <footer>
        <span id="year-copy">2013</span> © <strong>Envato Marketplace Purchase Verifier</strong> - Built with <i class="icon-heart"></i> by <strong><a href="http://codecanyon.net/user/HigherGroundStudio?ref=highergroundstudio" target="_blank">Higher Ground Studio</a></strong>
    </footer>
</body>

</html>