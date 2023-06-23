<div align="center">
<img src="https://droidtechknow.com/top-things/url-shortener-to-make-money/images/url-shortener.jpg">
</div>

<h1 align="center">Laravel link shortener</h1>

<div align="center">
<a href="https://github.com/bagherkeshmiri/Link-Shortener/releases/">
    <img src="https://img.shields.io/github/release/bagherkeshmiri/Link-Shortener?include_prereleases=&sort=semver&color=red" alt="GitHub release">
</a>
<img src="https://img.shields.io/badge/License-MIT-green" alt="License">
<a href="https://github.com/bagherkeshmiri/Link-Shortener/releases/">
    <img src="https://img.shields.io/github/tag/bagherkeshmiri/Link-Shortener?include_prereleases=&sort=semver&color=blue" alt="GitHub tag">
</a>
<img src="https://img.shields.io/badge/downloads-1k-green" alt="downloads - 1k">
<a href="https://www.mysql.com/" title="Go to MySQL homepage">
    <img src="https://img.shields.io/badge/MySQL-%3E=5.7-blue?logo=mysql&logoColor=white" alt="Made with MySQL">
</a>
<img src="https://img.shields.io/badge/contributions-welcome-yellow" alt="contributions - welcome">
<img src="https://img.shields.io/badge/maintained-yes-blue" alt="maintained - yes">
</div>

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

5 - For a beautiful display of project logs, refer to :
```bash
 {APP_URL}/log-viewer
```

6 - If there is a problem with the log screen, run the following command
```bash
 php artisan log-viewer:publish
```
- Laravel Log Viewer package : https://github.com/opcodesio/log-viewer

## Contributing
Thank you for participating in this project! \
It is possible to send an error correction request in the form of a merge request

## Security Vulnerabilities
If you discover a security vulnerability within Laravel student exams, please send an e-mail to Bagher Keshmiri via [bagherkeshmiri@gmail.com](mailto:bagherkeshmiri@gmail.com). All security vulnerabilities will be promptly addressed.

## License
The link shortner is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
