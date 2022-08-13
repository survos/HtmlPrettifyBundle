# SurvosHtmlPrettifyBundle

Wrap the html-prettify javascript package in a stimulus controller.  Also, provide a function for HTML indentation.

```bash

composer req survos/html-prettify-bundle
```

## Complete Working Demo (without opening an editor)

```bash
symfony new PrettifyDemo --webapp && cd PrettifyDemo
composer config repositories.survos_prettify '{"type": "vcs", "url": "git@github.com:survos/HtmlPrettifyBundle.git"}'
composer req survos/html-prettify-bundle
yarn install --force
yarn encore dev
bin/console make:controller AppController
sed -i "s|/app|/|" src/Controller/AppController.php 
sed -i "s|<h1|{{ render_hello() }}<h1|" templates/app/index.html.twig
symfony server:start
```

