<?php
/**
 * Help Me Gator — contact form handler
 * Receives the quote request form and emails it to gator@helpmegator.com.
 */

$recipient = 'gator@helpmegator.com';
$from_addr = 'noreply@helpmegator.com';

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

// Honeypot — bots fill hidden fields; humans never see it.
// Pretend success so bots don't retry.
if (!empty($_POST['_honey'])) {
    header('Location: thanks.html');
    exit;
}

function field($key) {
    if (!isset($_POST[$key])) return '';
    $v = trim($_POST[$key]);
    // Strip header-injection attempts
    return str_replace(["\r", "\n", "%0a", "%0d"], ' ', $v);
}

$name         = field('name');
$business     = field('business');
$email        = field('email');
$phone        = field('phone');
$project_type = field('project_type');
$budget       = field('budget');
$current_site = field('current_site');
$message      = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if ($name === '' || $email === '' || $project_type === '' || $message === ''
    || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.html?error=1');
    exit;
}

// Cap lengths so nobody mails us a novel
$name         = mb_substr($name, 0, 200);
$business     = mb_substr($business, 0, 200);
$phone        = mb_substr($phone, 0, 50);
$current_site = mb_substr($current_site, 0, 300);
$message      = mb_substr($message, 0, 5000);

$subject = 'New quote request from ' . $name . ' — helpmegator.com';

$body  = "New quote request from the helpmegator.com contact form\n";
$body .= "========================================================\n\n";
$body .= "Name:          $name\n";
$body .= "Business:      " . ($business ?: '—') . "\n";
$body .= "Email:         $email\n";
$body .= "Phone:         " . ($phone ?: '—') . "\n";
$body .= "Needs:         $project_type\n";
$body .= "Budget:        " . ($budget ?: 'Not sure yet') . "\n";
$body .= "Current site:  " . ($current_site ?: '—') . "\n\n";
$body .= "Message:\n--------\n$message\n\n";
$body .= "--------------------------------------------------------\n";
$body .= "Sent " . date('Y-m-d H:i:s T') . " from IP " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";

$headers   = [];
$headers[] = 'From: Help Me Gator Website <' . $from_addr . '>';
$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
$headers[] = 'X-Mailer: helpmegator-site';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';

$sent = mail($recipient, $subject, $body, implode("\r\n", $headers));

header('Location: ' . ($sent ? 'thanks.html' : 'contact.html?error=1'));
exit;
