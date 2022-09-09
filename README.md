# Exchange Rates

Exchange rates of a well known currencies e.g. USD, EUR, CHF, AUD, CAD to GBP.

- Backend - Phalcon 4.0.5 as PHP framework
- Frontend - React JS + Tailwind CSS

## FrontEnd - React - Atomic Design

I use [Atomic design](https://bradfrost.com/blog/post/atomic-web-design/) methodology for creating design systems. There are five distinct levels in atomic design.

Atomic design provides a clear methodology for crafting design systems. Clients and team members are able to better appreciate the concept of design systems by actually seeing the steps laid out in front of them.

Atomic design gives us the ability to traverse from abstract to concrete. Because of this, we can create systems that promote consistency and scalability while simultaneously showing things in their final context. And by assembling rather than deconstructing, we’re crafting a system right out of the gate instead of cherry picking patterns after the fact.

![Atomic Design](doc/atomic-design.jpg?raw=true "Atomic Design")

### 1. Atoms

Atoms are the basic building blocks of matter. Applied to web interfaces, atoms are our HTML tags, such as a form label, an input or a button. Like atoms in nature they’re fairly abstract and often not terribly useful on their own.

### 2. Molecules

Things start getting more interesting and tangible when we start combining atoms together. Molecules are groups of atoms bonded together and are the smallest fundamental units of a compound. These molecules take on their own properties and serve as the backbone of our design systems.

For example, a form label, input or button aren’t too useful by themselves, but combine them together as a form and now they can actually do something together.

### 3. Organisms

Molecules give us some building blocks to work with, and we can now combine them together to form organisms. Organisms are groups of molecules joined together to form a relatively complex, distinct section of an interface. Building up from molecules to organisms encourages creating standalone, portable, reusable components.

### 4. Templates

At the template stage, we break our chemistry analogy to get into language that makes more sense to our clients and our final output. Templates consist mostly of groups of organisms stitched together to form pages. It’s here where we start to see the design coming together and start seeing things like layout in action.

### 5. Pages

Pages are specific instances of templates. Here, placeholder content is replaced with real representative content to give an accurate depiction of what a user will ultimately see.

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

`phpunit`

## Run frontend Storybook

go to ui folder, run below command

`yarn start`
