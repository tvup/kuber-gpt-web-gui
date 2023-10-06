# kuber-gpt-web-gui

This is a web GUI built with Laravel to interact with kuber-gpt.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Support](#support)

## Features

- **Laravel Backend**: A robust backend built with Laravel 10
- **Sail Integration**: Easy setup and deployment using Sail.
- **Multilingual Support**: Supports multiple languages including English, Italian, and Danish.

## Installation
<p>It's strongly recommended that you add an alias to your bash/zsh config</p>
<p>It will make it much easier to run the sail command</p>

```bash
alias sail="./vendor/bin/sail"
```

### Install dependencies
You will have to install dependencies locally, because we use `sail` which is located in the `/vendor` folder.

```bash
composer install --ignore-platform-reqs
```

### Set default environment variables

```bash
cp .env.example .env
```

### Start application

#### Docker (might take a while first time)
```bash
sail up -d
```
[if you get "Docker is not running." this link might be helpful](https://docs.docker.com/engine/install/linux-postinstall/)

if you get bind problems for e.g. tcp4 0.0.0.0:80 (http) or tcp4 0.0.0.0:3306 (mysql), you can change the forward ports in .env like these examples:
```.dotenv
APP_PORT=8001
FORWARD_DB_PORT=3308
```

### Generate a new App Key
```bash
sail artisan key:generate
```

### Migrate
```bash
sail artisan migrate
```

### Build NPM & Vite components

```bash
sail npm install
sail npm run build 
```

### Now is a good time to view all the nice stuff
Navigate to http://localhost/ (if you set the APP_PORT, you should include this in link also, e.g.: http://localhost:8001 )

## Usage

After installation, navigate to `http://localhost:8000` in your browser to access the web GUI.

## Contributing

We welcome contributions from the community! Please see our [contribution guide](LINK_TO_CONTRIBUTING_GUIDE) for details.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you find this project useful, consider supporting the developer:

<a href="https://www.buymeacoffee.com/tvup"> <img align="left" src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" height="50" width="210" alt="MaoX17" /></a>
