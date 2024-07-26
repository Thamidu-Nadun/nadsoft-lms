<?php
include ('admin/inc/config.php'); // Ensure this path is correct relative to your current file location
?>
<?php
$message='';
$language = 'en';

if (isset($_GET['lang'])) {
  $language = $_GET['lang'];
}

$statement = $pdo->prepare("SELECT * FROM translations WHERE language = :language");
$statement->bindParam(':language', $language, PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetchAll();
// $translations = $statement->fetchAll(PDO::FETCH_ASSOC);
$translations = array();
foreach ($result as $data) {
  $translations[$data['content_id']] = $data;
}
?>
<?php
$currency = '$';

if (isset($_GET['currency'])) {
  $currency = $_GET['currency'];
}
?>
<?php
if (isset($_POST['newsLetterSubmit'])) {
    $email = $_POST['email'];

    $statementOfEmail = $pdo->prepare('INSERT INTO subscribers (email) VALUES (?);');
    $statementOfEmail->execute(array(
      $email
    ));

    $message = 'Subscribed Successfully';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META ============================================= -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="robots" content="" />

  <!-- DESCRIPTION -->
  <meta name="description" content="EduChamp : Education HTML Template" />

  <!-- OG -->
  <meta property="og:title" content="EduChamp : Education HTML Template" />
  <meta property="og:description" content="EduChamp : Education HTML Template" />
  <meta property="og:image" content="" />
  <meta name="format-detection" content="telephone=no" />

  <!-- FAVICONS ICON ============================================= -->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

  <!-- PAGE TITLE HERE ============================================= -->
  <title>NadSoft: LMS</title>

  <!-- MOBILE SPECIFIC ============================================= -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.min.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

  <!-- All PLUGINS CSS ============================================= -->
  <link rel="stylesheet" type="text/css" href="assets/css/assets.css" />

  <!-- TYPOGRAPHY ============================================= -->
  <link rel="stylesheet" type="text/css" href="assets/css/typography.css" />

  <!-- SHORTCODES ============================================= -->
  <link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css" />

  <!-- STYLESHEETS ============================================= -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css" />

  <!-- REVOLUTION SLIDER CSS ============================================= -->
  <link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/layers.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/settings.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/navigation.css" />
  <!-- REVOLUTION SLIDER END -->
  <script src="assets/js/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      // Retrieve current parameters or set defaults
      var params = new URLSearchParams(window.location.search);
      var lang = params.get('lang') || 'en';
      var currency = params.get('currency') || '$';

      // Set initial values of selectors
      $('#language-select').val(lang);
      $('#currencySelector').val(currency);

      // Function to update URL
      function updateUrl() {
        var selectedLang = $('#language-select').val();
        var selectedCurrency = $('#currencySelector').val();

        // Update URL preserving existing parameters
        params.set('lang', selectedLang);
        params.set('currency', selectedCurrency);

        var newUrl = window.location.pathname + '?' + params.toString();
        window.location.href = newUrl;
      }

      // Attach event handlers
      $('#language-select').on('change', updateUrl);
      $('#currencySelector').on('change', updateUrl);
    });

  </script>


</head>