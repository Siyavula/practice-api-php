<?php
  $get_token_url = 'https://www.siyavula.com/api/practice/v1/get-token';
  $get_question_url = 'https://www.siyavula.com/api/practice/v1/get-question';
  $submit_answer_url = 'https://www.siyavula.com/api/practice/v1/submit-answer';
  $template_id = 1805;
  $random_seed = 259974;

  // Create a new cURL resource
  $ch = curl_init($get_token_url);

  // Create the payload to get a new token
  $data = array(
      'name' => 'siyavula',
      'password' => 'Vxw5PQCVyAt4vD6uHznVU6GUfjU3j6Et35rCqZWU3EYL376bfch4ZyjSBWgGJaEXWdZLWm6EePETbCghezgFbwrgUPQ5DuYbmJ9tVbxyTEK3us3H8tVKpLYcFaffsMSFw2bPAc6jU4MjvnJgXf4ufxuLzMTQR2McCkASq3Y8bHTY8ujDweNFceXs2PSZw6j3qrCL3TquVwqBr2EygfhyDYpjqG5amSa4Ey32N2UySBGMPumQQCYyWXPXvvHHYQrX',
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
  <title>Practice API</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://www.siyavula.com/static/themes/mobile/practice-api/practice-api.min.css" />
</head>
<body class="za-mobile mobile sv">
  <div id="margins">
    <div id="content">
      <div id="monassis" class="monassis monassis--practice monassis--maths monassis--practice-api">
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
