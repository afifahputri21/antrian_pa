<?php

define('API_ACCESS_KEY', 'AAAA1y4BcRk:APA91bHe29Squ-Fv_vr5MmPX3fFy51uSUClVlm44LXj2-VHQHyGZMh3IBlgpMkhseYWzp4Mvv
pw3HENhDgmJmolC7Eix5Fjov7RmaEXYjvuS9yqnVZeQdI7fKqgBwVFxaGh202LP9SJu');

$fcmUrl = 'http://fcm.googleapis.com/fcm/send';

$token = $_POST['token'];

$notification = [
    'title' => 'EasyCoding',
    'body' => 'Amara Tetsig Adifah',
    'icon' => 'myI con',
    'sound' => 'mySound',
];

$extraNotification = ["message" => $notification, "moredara" => 'dd'];

$fcmNotification = [
    'to' => $token,
    'notification' => $notification,
    'data' => $extraNotification
];

$header = [
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type : application/json'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);

echo $result;


