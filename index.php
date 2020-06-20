<?php
first: DIRECTORY_SEPARATOR === '\\' ? pclose(popen('cls&color 0B', 'w')) : exec('clear');
echo '     Copyright 2003-' . date('Y') . ' Safa Safari All Rights Reserved';
echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
echo '     1) Register new account' . PHP_EOL;
echo '     2) Check status' . PHP_EOL;
echo '     3) Get free warp+' . PHP_EOL;
echo '     4) Set license' . PHP_EOL;
echo '     5) Repair config with JSON file' . PHP_EOL . PHP_EOL;
$a = check(readline('Choose option : '));
if ($a == 1) {
  if (file_exists('Safa.JSON'))
    $caution = readline('CAUTION a JSON file already exist REMOVE them ?(y/n) : ');
  if (@$caution == 'y')
    goto c;
  if (@$caution == 'n')
    goto first;
  c: $private = exec('wg genkey');
  $descriptors = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w"),
  );

  $proc = proc_open("wg pubkey", $descriptors, $pipes);
  fwrite($pipes[0], $private);
  fclose($pipes[0]);
  $public = trim(fgets($pipes[1]));
  proc_close($proc);
  file_put_contents('Safa.conf', '[Interface]
#public = ' . $public . '
PrivateKey = ' . $private . '
Address = 172.16.0.2/32, fd01:5ca1:ab1e:8e2b:9435:1119:d45c:3c70/128
DNS = 1.1.1.1

[Peer]
PublicKey = bmXOC+F1FxEMF9dyiK2H5/1SUtzH0JuVo51h2wPfgyo=
AllowedIPs = 0.0.0.0/0, ::/0
Endpoint = engage.cloudflareclient.com:2408
');
  $id = '3aff766b-8031-4674-aa70-8a9804ab2bd6';
  $date = date('Y-m-d');
  $date .= 'T';
  $date .= date('H:i:s' . substr((string) microtime(), 1, 4) . '+07:00');
  $data = json_encode([
    'key' => $public,
    'warp_enabled' => true,
    'referrer' => $id,
    'tos' => $date,
    'model' => 'SafaSafari',
    'type' => 'Android',
    'install_id' => 'SafaSafariSafaSafari77',
    'fcm_token' => 'SafaSafariSafaSafari77:APA911bSafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari77SafaSafariSafaSafari777777',
    'locale' => 'en_US',
  ], 128 | 256 | 64 | 16);
  $header = array(
    'Content-Type: application/json',
    'User-Agent: okhttp/3.12.1',
  );
  $opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => $header,
        'content' => $data
    )
);
  $context  = stream_context_create($opts);
  $res = json_decode(file_get_contents('https://api.cloudflareclient.com/v0a977/reg', false, $context),true);
DIRECTORY_SEPARATOR === '\\' ? pclose(popen('cls&color 0B', 'w')) : exec('clear');
  if (!$res) {
    echo 'Connection limit reached please try again after 60 second' . PHP_EOL;
    goto s;
  }
  $json['id'] = $res['id'];
  $json['token'] = $res['token'];
  $json['private_key'] = $private;
  $json['public_key'] = $public;
  $json['license'] = $res['account']['license'];
  file_put_contents('Safa.json', 'DON\'T CHANGE THIS FILE' . PHP_EOL . json_encode($json));
  echo PHP_EOL . 'Config created successfully' . PHP_EOL;
  s: readline('Press any key to continue.');
  goto first;
} elseif (!file_exists('Safa.json')) {
  echo 'First Register new account' . PHP_EOL;
  goto s;
} elseif ($a == 2) {
  $json = json_decode(explode(PHP_EOL, file_get_contents('Safa.json'))[1], true);
  $header = array(
    'User-Agent: okhttp/3.12.1',
    'Authorization: Bearer ' . $json['token']
  );
  $url = "https://api.cloudflareclient.com/v0a977/reg/" . $json['id'] . '/account';
  $opts = array('http' =>
    array(
        'header'  => $header,
    )
);
  $context  = stream_context_create($opts);
  @$res = json_decode(file_get_contents($url, false, $context),true);
  DIRECTORY_SEPARATOR === '\\' ? pclose(popen('cls&color 0B', 'w')) : exec('clear');
  if (!$res) {
    echo 'Connection limit reached please try again after 60 second' . PHP_EOL;
    goto s;
  }
  echo PHP_EOL . 'License: ' . $res['license'] . PHP_EOL . PHP_EOL . 'Warp+ data: ' . $res['premium_data'] . PHP_EOL . PHP_EOL . 'quota: ' . $res['quota'] . PHP_EOL . PHP_EOL;
  goto s;
  goto first;
} elseif ($a == 3) {
  $json = json_decode(explode(PHP_EOL, file_get_contents('Safa.json'))[1], true);
  $id = $json['id'];
  $data = json_encode([
    'referrer' => $id,
  ], 128 | 256 | 64 | 16);
  $header = array(
    'Content-Type: application/json',
    'User-Agent: okhttp/3.12.1',
  );
  $url = "https://api.cloudflareclient.com/v0a977/reg";
  exec('title To stop Press Ctrl + c or Close Proccess');
  $i = 1;
  for (;;) {
    $j = $i - 1;
    for (; $i < $j + 4; $i++) {
  $opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => $header,
        'content' => $data
    )
);
  $context  = stream_context_create($opts);
  file_get_contents($url, false, $context);
      echo $i . ' OK' . PHP_EOL;
    }
    for ($t = 60; $t >= 0; $t--) {
      sleep(1);
      if ($t < 10) $t = '0' . $t;
      $second = 'second';
      if ($t > 1) $second .= 's';
      echo 'Connection limit reached waiting ' . $t . ' ' . $second . " \r";
    }
    echo PHP_EOL;
  }
} elseif ($a == 4) {
  $json = json_decode(explode(PHP_EOL, file_get_contents('Safa.json'))[1], true);
  if (isset($json['license'])) {
    echo 'Current license is : ' . $json['license'] . PHP_EOL;
    $caution = readline('CAUTION a license already exist REMOVE them ?(y/n) : ');
    if ($caution == 'y') {
      $license = checklicense(readline('Enter license : '));
      goto s;
    }
    if ($caution == 'n')
      goto first;
  }
} elseif ($a == 5) {
  $json = json_decode(explode(PHP_EOL, file_get_contents('Safa.json'))[1], true);
  file_put_contents('Safa.conf', '[Interface]
#public = ' . $json['public_key'] . '
PrivateKey = ' . $json['private_key'] . '
Address = 172.16.0.2/32, fd01:5ca1:ab1e:8e2b:9435:1119:d45c:3c70/128
DNS = 1.1.1.1

[Peer]
PublicKey = bmXOC+F1FxEMF9dyiK2H5/1SUtzH0JuVo51h2wPfgyo=
AllowedIPs = 0.0.0.0/0, ::/0
Endpoint = engage.cloudflareclient.com:2408
');
  readline('Done, Press any key to continue.');
  goto first;
}
function check($a)
{
  if (is_numeric($a))
    return $a;
  else return check(readline('Please enter number : '));
}
function checklicense($a)
{
  $json = json_decode(explode(PHP_EOL, file_get_contents('Safa.json'))[1], true);
  if (is_array($a)) {
    if (!isset($a['result']))
      return 1;
    else {
      checklicense(readline('Please enter license correctly : '));
    }
  }
  if (strlen($a) == 26) {
    $data = json_encode([
      'license' => $a,
    ], 128 | 256 | 64 | 16);
    $header = array(
      'Content-Type: application/json',
      'User-Agent: okhttp/3.12.1',
      'Authorization: Bearer ' . $json['token'],
      'Content-Length: ' . strlen($data),
    );
    $url = "https://api.cloudflareclient.com/v0a977/reg/" . $json['id'] . '/account';
    $opts = array('http' =>
    array(
        'method'  => 'PUT',
        'header'  => $header,
        'content' => $data
    )
);
  $context  = stream_context_create($opts);
  $res = json_decode(file_get_contents('https://api.cloudflareclient.com/v0a977/reg', false, $context),true);

    if (checklicense(json_decode($res, true)) == 1) {
      $json['license'] = $a;
      file_put_contents('Safa.json', 'DON\'T CHANGE THIS FILE' . PHP_EOL . json_encode($json));
      echo 'License submitted' . PHP_EOL;
      return;
    }
  } else return checklicense(readline('Please enter license correctly : '));
}
