# TacmanHtmlPrettifyBundle

Wrap the html-prettify javascript package in a stimulus controller.  Also, provide a function for HTML indentation.

```bash

composer config repositories.html_prettify '{"type": "path", "url": "/home/tac/survos/bundles/HtmlPrettifyBundle"}'
composer req tacman/html-prettify-bundle:*@dev

composer req tacman/html-prettify-bundle
```

## Complete Working Demo (without opening an editor)
```bash
symfony new HelloDemo --webapp && cd HelloDemo
composer config repositories.tacman_hello '{"type": "vcs", "url": "git@github.com:tacman/TacmanHtmlPrettifyBundle.git"}'
composer req tacman/html-prettify-bundle
yarn install --force
yarn encore dev
bin/console make:controller AppController
sed -i "s|/app|/|" src/Controller/AppController.php 
sed -i "s|<h1|{{ render_hello() }}<h1|" templates/app/index.html.twig
symfony server:start
```

