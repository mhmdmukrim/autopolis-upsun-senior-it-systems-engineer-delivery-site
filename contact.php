<?php
/* Contact form handler for Upsun: Senior IT Systems Engineer — delivery site — set YOUR address below. */
$TO = "you@example.com";
$OK = "Thank you! Your message has been sent.";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.html'); exit; }
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$hp      = trim($_POST['website'] ?? '');          /* honeypot: bots fill it */
if ($hp !== '') { usleep(300000); header('Location: index.html'); exit; }
if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400); exit("Please fill in name, a valid email and a message.");
}
if (strlen($name) > 80 || strlen($message) > 3000) { http_response_code(400); exit("Too long."); }
$subj = "Website enquiry from " . $name;
$body = "Name:  " . $name . "\nEmail: " . $email . "\n\n" . $message . "\n\n-- sent by contact.php";
$hdr  = "From: no-reply@" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . "\r\n"
      . "Reply-To: " . $email . "\r\n" . "X-Mailer: PHP/" . phpversion();
$sent = @mail($TO, $subj, $body, $hdr);
if ($sent) { header('Content-Type: text/html; charset=utf-8');
  echo "<!doctype html><meta charset=utf-8><title>Sent</title>"
     . "<body style='font-family:Segoe UI,Arial,sans-serif;text-align:center;padding:80px 20px'>"
     . "<h1>Thank you!</h1><p>" . htmlspecialchars($OK) . "</p>"
     . "<p><a href='index.html'>Back to the site</a></p></body>";
  exit;
}
http_response_code(500); exit("Sorry, your message could not be sent. Please email us directly.");
