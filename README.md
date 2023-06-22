# Laravel link shortener

<a href="https://github.com/bagherkeshmiri/Link-Shortener/releases/">
<img src="https://img.shields.io/github/release/bagherkeshmiri/Link-Shortener?include_prereleases=&sort=semver&color=red" alt="GitHub release">
</a>
<a href="#license">
<img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</a>
<a href="https://github.com/bagherkeshmiri/Link-Shortener/releases/"><img src="https://img.shields.io/github/tag/bagherkeshmiri/Link-Shortener?include_prereleases=&sort=semver&color=blue" alt="GitHub tag"></a>
<a href="https://"><img src="https://img.shields.io/badge/downloads-1k-ffb84d" alt="downloads - 1k"></a>
<a href="https://www.mysql.com/" title="Go to MySQL homepage"><img src="https://img.shields.io/badge/MySQL-%3E=5.7-blue?logo=mysql&logoColor=white" alt="Made with MySQL"></a>
<a href="/CONTRIBUTING.md" title="Go to contributions doc"><img src="https://img.shields.io/badge/contributions-welcome-yellow" alt="contributions - welcome"></a>
<img src="https://img.shields.io/badge/maintained-yes-blue" alt="maintained - yes">
<a href="https://github.com/features/actions" title="Go to GitHub Actions homepage"><img src="https://img.shields.io/badge/CI-GitHub_Actions-red?logo=github-actions&logoColor=white" alt="Made with GH Actions"></a>

## About laravel link shortener
The link shortener web service is written based on the Laravel framework, which can perform all the services related to shortening links and managing them without problems and independently as a web software. To use this free web software, you only need to do the setup steps in order

- [Installation](#installation)

## Installation
1 - In order to install, considering that the Brasa Laravel framework has been developed, you need to clone the project in your desired path :
```bash
git clone https://github.com/bagherkeshmiri/Link-Shortener.git
```

2 - To get the core of the project (vendor), you need to run the following code :
```bash
composer update
```

3 - After receiving the contents of the vendor folder, it is necessary to set the .env file of the project and connect to the database .

4 - Then execute the following command to create tables and input basic information :
```bash
 php artisan migrate --seed
```


## Contributing
Thank you for participating in this project! \
It is possible to send an error correction request in the form of a merge request


## License
The link shortner is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
