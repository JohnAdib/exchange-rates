# Exchange Rates

Exchange rates of a well known currencies e.g. USD, EUR, CHF, AUD, CAD to GBP.

- Backend - Phalcon 4.0.5 as PHP framework
- Frontend - React JS + Tailwind CSS

## Installation

### Install Dependencies - Docker & git

First, update your existing list of packages

`sudo apt update`

Next, install a few prerequisite packages which let apt use packages over HTTPS

`sudo apt install apt-transport-https ca-certificates curl software-properties-common`

Then add the GPG key for the official Docker repository to your system

`curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg`

Add the Docker repository to APT sources

`echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null`

Update your existing list of packages again for the addition to be recognized

`sudo apt update`

Make sure you are about to install from the Docker repo instead of the default Ubuntu repo

`apt-cache policy docker-ce`

Finally, install Docker, Docker compose and Git

`sudo apt install -y docker-ce docker-compose-plugin git`

First clone this respository from github with below command

### Install Project - Clone Git repository and set API key in `.env`

Clone the repository somewhere with below command.

`git clone https://github.com/MrJavadAdib/exchange-rates.git`

Go to cloned folder

`cd exchange-rates`

Before running docker you need to config env to set api key of exchage service. Get API key from <https://exchangeratesapi.io/documentation/>.

- copy `.env.dev` file on root to `.env` and update EXCHANGERATES_API_KEY

### Run Backend with Docker

Try to run docker. it takes some minute to do everything. `-d` for detached mode.

`docker compose up --build -d`

Now open browser and go to <http://localhost:8022>. port `8022` is set inside `docker-compose.yml`

### Run frontend

Go to ui folder with below command

`cd ui`

Now install dependecies with npm via below command

`npm install`

Then run npm

`npm start`

Browser automatically open a new link to <http://localhost:3000>

### Run backend tests

Backend tests written with PHPUnit. To run tests on backend, use below command

`docker-compose exec app vendor/bin/phpunit`

### Run frontend Storybook

go to ui folder, run below command

`npm run storybook`

Browser automatically open link to <http://localhost:6006/>

## Sample output of API for USD

```
{
  "okay": true,
  "status": 200,
  "error": false,
  "ttl": 3600,
  "dateUpdate": "2022-09-10 00:25:33",
  "dateExpire": "2022-09-10 01:25:33",
  "latest": {
    "success": true,
    "timestamp": 1662769512,
    "base": "EUR",
    "date": "2022-09-10",
    "rates": {
      "USD": 1.015176,
      "EUR": 1,
      "GBP": 0.875077,
      "CHF": 0.973523,
      "CAD": 1.323388,
      "AUD": 1.482209,
      "JPY": 144.667762,
      "CNY": 7.031624,
      "RUB": 61.707607,
      "IRR": 43043.482408,
      "AED": 3.728849,
      "TRY": 18.513168,
      "IQD": 1482.157637,
      "INR": 80.864948
    }
  },
  "symbols": {
    "USD": "United States Dollar",
    "EUR": "Euro",
    "GBP": "British Pound Sterling",
    "CHF": "Swiss Franc",
    "CAD": "Canadian Dollar",
    "AUD": "Australian Dollar",
    "JPY": "Japanese Yen",
    "CNY": "Chinese Yuan",
    "RUB": "Russian Ruble",
    "IRR": "Iranian Rial",
    "AED": "United Arab Emirates Dirham",
    "TRY": "Turkish Lira",
    "IQD": "Iraqi Dinar",
    "INR": "Indian Rupee"
  }
}
```
