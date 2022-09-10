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
