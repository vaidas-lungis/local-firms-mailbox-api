## About 
<p align="center">
<a href="https://travis-ci.org/vaidas-lungis/rss-aggregator"><img src="https://travis-ci.org/vaidas-lungis/rss-aggregator.svg?branch=master" alt="Build Status"></a>
</p>
Simple Mailbox API

## Setup 
- composer install
- `cp .env.example .env`
- `php artisan key:generate`
- `Setup connection to database`
- `php artisan migrate --seed`
- `php artisan import:messages storage/app/import_messages.json` (Change file path to yours. Relative to app root path) 
- 

## Endpoints
basic auth protected. With testing seed data use header
`Authorization: Basic dGVzdEBleGFtcGxlLmNvbTpzZWNyZXQ=`
- GET `/mesages`
    - list messages
- GET `/archived`
    - list archived messages
- GET `/mesages/1`
    - Show message #1 contents
- POST `messages/1/read`
    - Set message as read
- POST `messages/1/archive`
    - Set message as archived
    
## Dev env
For convince docker-compose.yml file available. Run it with

- docker-compose up