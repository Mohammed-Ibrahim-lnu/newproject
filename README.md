# My project - Frugal Company website

## INSTALLATION

- VSCODE
- EXTENSIONS (PHP Intelephense)
- GIT
- DOCKER
- ESLINT
- PHP SERVER
- SQL Server (myssql)
- SQL Database Projects
- AMPPS (Apache, MySQL, PHP skip the S)

## USAGE

RUN PHP SERVER EXTENSION:

![image](./READMEimg/SERVE.png)


## DEPLOYMENT

- [Database](./frugal_company.sql)

- [Simulate DB server through docker before deployment](https://www.docker.com/products/docker-desktop/)

- [Deploy SQL DB](api.clever-cloud.com)

- [Render](https://newproject-qyzl.onrender.com/index.php)

- Add SQL Deployment's env keys into Render env variables.

- Add [dockerfile](./dockerfile), [render.yaml](./render.yaml) & [.gitlab-ci.yml](/.gitlab-ci.yml)

## TESTING

- [Jest test for JS tests](./main.test.js) - npm test - [package.json](./package.json), [package-lock.json](./package-lock.json)
- [PHPunit for PHP tests](./tests/cartTest.php) - TEST- [composer.json](./composer.json), [composer.lock](./composer.lock)

- Install node_modules.

## LICENSE

[MIT](../newproject//LICENSE)