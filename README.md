## Description:
This is an async dockerized API-based sms gateway application written in PHP.

I've implemented two sms service providers api in this application, [Ghasedak](https://ghasedak.me/) and [Kavenegar](https://kavenegar.com/).

For messaging and async implementation, I've used RabbitMq.

For containerization and infrastructure freedom, I've used Docker.

### Installation:
1) Go to the root of the Pony Express directory.
2) Open the `.env` file and set the `LOCAL_APP_PORT`, `LOCAL_RABBITMQ_PORT` and `LOCAL_MYSQL_PORT` related on your choice.
   (Note that the ports you are going to declare are empty.)
3) run: `docker-compose build`
4) run: `docker-compose up -d`

### Sms Sending API:
route: `http://localhost:8000/api/sms/send`

Note that 8000 is the value of `LOCAL_APP_PORT` environment variable in the `.env` file

#### Example:
Body | urlencoded

| Key      | Value                    |
|----------|--------------------------|
| number   | 09120635002              |
| text     | Hello from Pony Express! |
| provider | ghasedak                 |

Note:

You can omit the `provider` key in the body. If you do this, Ghasedak will be the default provider.

####Curl:
```
curl --location --request POST 'http://localhost:8000/api/sms/send' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'number=09120635002' \
--data-urlencode 'text=Hello From Pony Express!' \
--data-urlencode 'provider=ghasedak'
```

###Simple Reporting and Monitoring UI:
On the `http://localhost:8000/` route you can fill the username and password with the `admin` and then use the querying and reporting UI.

Note: 

In this page for `number` and `text` inputs you can think that you are querying in SQL with `LIKE` operator.

For example if you fill the number input with `0912063%` you will receive the messages that start with `0912063`

### Using this application on production:
In the `.env` file you can set the api keys for sms service providers.

For example, you can declare the api key for ghasedak sms service provider with `GHASEDAK_API_KEY` environment variable.

Also, you can change the line numbers for providers depending on your needs in the `.env` file.

### How to use Pony Express with another sms service provider?
1) Go the `src/pony/Providers` path and create a directory.
2) In the created folder, create a class with the name of sms service provider.
3) The class that you defined must extend from the `AbstractProvider` class.
4) All you have to do in this class is implement a method with the following signature:
`public static function send(string $number, string $text)`. Your functionality for a simple send according to your sms service provider must be implemented here.
5) The last thing you must do is that map your new sms service provider in the `src/pony/Providers/providers.php`.
This is a file that returns an associative array which maps the providers to their own classes.