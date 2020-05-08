<?php
  // Example of getting a token via PHP cURL
  $get_token_url = getenv('practice_api_host').'/api/practice/v1/get-token';
  $template_id = 2122;
  $random_seed = 487029;

  // Create a new cURL resource
  $ch = curl_init($get_token_url);

  // Create the payload to get a new token
  $data = array(
      'name' => getenv('api_client_name'),
      'password' => getenv('api_client_password'),
      'client_ip' => '127.0.0.1',
      'theme' => 'responsive',
      'region' => 'ZA',
      'curriculum' => 'CAPS'
  );
  $payload = json_encode($data);

  // Attach encoded JSON string to the POST fields
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  // Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  // Return response instead of outputting
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Get the token
  $response = json_decode(curl_exec($ch));

  // Close cURL resource
  curl_close($ch);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Practice API</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://www.siyavula.com/static/themes/emas/practice-api/practice-api.min.css" />
  <script type="text/javascript">
    token = '<?php echo $response->token; ?>';
    template_id = '<?php echo $template_id; ?>';
    random_seed = '<?php echo $random_seed; ?>';
  </script>
</head>
<body>
  <main class="sv-region-main emas sv">
    <div id="monassis" class="monassis monassis--practice monassis--maths monassis--practice-api">
      <div class="question-wrapper">
        <div class="question-content"></div>
      </div>
    </div>
  </main>
  <script src="https://www.siyavula.com/static/themes/emas/node_modules/mathjax/MathJax.js?config=TeX-MML-AM_HTMLorMML-full"></script>
  <script src="https://www.siyavula.com/static/themes/emas/practice-api/practice-api.min.js"></script>
</body>
</html>
