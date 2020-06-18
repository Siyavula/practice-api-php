<?php
  // Uncomment the following lines to print errors
  //ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
  //error_reporting(E_ALL);

  $get_token_url = getenv('question_api_host').'/api/question/v1/get-token';
  $get_question_url = getenv('question_api_host').'/api/question/v1/get-question';
  $submit_answer_url = getenv('question_api_host').'/api/question/v1/submit-answer';
  $template_id = 1805;
  $random_seed = 259974;

  // Create a new cURL resource
  $ch = curl_init($get_token_url);

  // Create the payload to get a new token
  $data = array(
      'name' => getenv('api_client_name'),
      'password' => getenv('api_client_password'),
      'client_ip' => '127.0.0.1',
      'theme' => 'basic',
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
  // Allow self signed certificates (don't do this in production)
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  // Get the token
  $response = json_decode(curl_exec($ch));
  // Close cURL resource
  curl_close($ch);

  // If this is a POST request the user is submitting an answer
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new cURL resource
    $ch = curl_init($submit_answer_url);

    // Create the payload to submit an answer
    $data = array(
        'template_id' => $template_id,
        'random_seed' => $random_seed,
        'user_responses' => $_POST
    );
    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // Set the authentication header
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'JWT: '.$response->token,
    ));

    $response = json_decode(curl_exec($ch));
  } else { // This is not a POST request so get a new question intance
    // Create a new cURL resource
    $ch = curl_init($get_question_url);

    // Create the payload to get a question
    $data = array(
        'template_id' => $template_id,
        'random_seed' => $random_seed
    );
    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // Set the authentication header
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'JWT: '.$response->token,
    ));

    $response = json_decode(curl_exec($ch));
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Question API</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?php echo getenv('question_api_host'); ?>/static/themes/mobile/question-api/question-api.min.css" />
</head>
<body class="za-mobile mobile sv">
  <div id="margins">
    <div id="content">
      <div id="monassis" class="monassis monassis--practice monassis--maths monassis--question-api">
        <div class="question-wrapper">
          <div class="question-content">
            <?php echo $response->question_html; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
