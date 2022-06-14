## Run the PHP serevr

```bash
php -S localhost:8000 public/index.php
```

## Run Services

```bash
php services/SmsSender.php
php services/SuccessfulSmsStorage.php
php services/FailedSmsStorage.php
```

## Reporting
You can go to the localhost:8000 and fill the username and password
with `admin` for reporting.

## Simple Send API
Curl:
```
curl 'http://localhost:8000/api/sms/send' \
  -H 'Accept: */*' \
  -H 'Accept-Language: en-US,en;q=0.9' \
  -H 'Connection: keep-alive' \
  -H 'Sec-Fetch-Dest: empty' \
  -H 'Sec-Fetch-Mode: cors' \
  -H 'Sec-Fetch-Site: none' \
  -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -H 'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="102", "Google Chrome";v="102"' \
  -H 'sec-ch-ua-mobile: ?0' \
  -H 'sec-ch-ua-platform: "Linux"' \
  --data-raw 'number=09120635002&text=test&provider=ghasedak' \
  --compressed
```
