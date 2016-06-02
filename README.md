# XKCDBot

A Slack bot that returns a relevant XKCD in response to a `/xkcd <search terms>` command. [It's on the Slack app directory](https://xdesign.slack.com/apps/A11BCGM0E-xkcdbot).

Written as a fairly simple Slim application, although pending a rewrite to Lumen (probably) since Slim's dependency injection leaves much to be desired.

There's a cron script at `cron/SyncXkcd.php` which is run every 10 minutes or so which checks for new XKCD comics and stores them as JSON under `storage/`.

When a Slack user executes a `/xkcd` slash command, a POST request is sent to the app with the search terms. The app then searches the locally stored comics for a comic title match. If none was found, it will fall back to searching the web using Bing's search API and return the top result.

If a result is found, it's cached to Redis for future use (and to save my Bing API quota).
