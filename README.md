# Euler Bot

A Bot Slack App that answers to the Multiples of 3 and 5 Euler problem (see projecteuler.net, problem 1). When the user sends a message to the bot with a natural number X (where 0 < X < 10000), the Slack Bot will answer with the sum of all multiples of 3 and 5 below X.

Use the Bot App by mentioning its name followed by the number. For example, if the name of the Bot is Euler, then
```
@Euler 10
```

### Prerequisite

Install the following requirements:

* [Docker](https://www.docker.com/) - For development and deployment
* [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli) - For deployment
* [Git](https://git-scm.com/) - Version Control and deployment

Setup an account for the following:
* [Heroku](https://www.heroku.com/) Account
* [Slack](https://slack.com/) Account, Workplace and App

### Installing Euler Bot

Start by cloning the repository
```
git clone https://github.com/nuelgacer/EulerBot.git
```

## Deployment with Heroku

If you wish to deploy directly from GitHub to Heroku, please follow this [instructions](https://devcenter.heroku.com/articles/github-integration).

Otherwise, from the app directory, login with CLI by running the following
```
heroku login
```

Following the instructions, then run this command to create a container, replace <name> with your desired name.
```
heroku create <name>
```

To deploy the code
```
git push heroku master
```

For detailed instructions, please follow [here](https://devcenter.heroku.com/articles/git).

### Create Slack Bot

To create a bot, please follow these [instructions](https://slack.com/intl/en-ae/help/articles/115005265703-create-a-bot-for-your-workspace).

When completing the Event Subscription for Slack Bot, copy your heroku app url to the request url which looks like this,
```
app-name.herokuapp.com
```

Then only subscribe to bot events and look for `app_mention`. There will be no other subsription.

From slack bot Basic Information page, copy the `Signing Secret`. This will be used to verify requests from Slack API.

From slack bot Install App page, copy the `Bot User OAuth Access Token`. This will be used as an Authentication token when sending messages to Slack API.

### Prepare Config Vars to Heroku

Required configurations
* APP_KEY - generate 32 char
* BOT_TOKEN - `Bot User OAuth Access Token` from slack
* SIGN_SECRET - `Signing Secret` from slack

If you have PHP installed in your machine, run the following command to generate the app key:
```
echo bin2hex(random_bytes(16));
```

To add the configurations to heroku, run the following commands:
```
heroku config:set APP_KEY=app-key
```
```
heroku config:set BOT_TOKEN=token-key
```
```
heroku config:set SIGN_SECRET=secret-key
```

## Built With

* [Lumen](https://lumen.laravel.com/) - The PHP framework used
* [Composer](https://getcomposer.org/) - Package Management
* [Guzzle](https://github.com/guzzle/guzzle/) - The HTTP Client used to send response to Slack API

## Authors

* **Emmanuel Gacer** - [nuelgacer](https://github.com/nuelgacer)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
