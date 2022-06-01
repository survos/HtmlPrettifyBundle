# TacmanHtmlPrettifyBundle

Symfony Bundle demonstrating twig/stimulus installation

```bash
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


@todo: install recipe

```twig

{{ stimulus_controller('tree') }}

```

## Notes from Ryan

https://symfonycasts.com/screencast/stimulus/controllers#comment-5423456875

You have 2 options here - one is the more "automated" way that the actual UX packages work. And the second is a simpler, but more manual process, which is totally fine if you are the one installing the bundles into your app :).

First, in both cases, yea, it's common to have an assets/ or Resources/assets directory in your bundle. And then, a controllers subdirectory is fine - you can organize that part however you want. So that's totally correct. You'll also want to put a package.json file in that directory so that it looks like a real package. The name won't really matter - since it will be an internal JavaScript package. Example: https://github.com/symfony/...

You'll notice in the above example that they have a src/ and dist/ directory, you shouldn't need to worry about that for your own bundles. Just have the source files.

Anyways, if I remember correctly, as soon as you have this assets/package.json or Resources/assets/package.json file, when you install the bundle into a project, Flex will automatically update the project's package.json to point to this. It will look something like:

"@tacman/your-package": "file:/vendor/tacman/your-package/assets"
Where @tacman/your-package is whatever you named your package in the bundle's package.json file.

At this point (after running yarn install --force, you have JavaScript package available! Woo! To expose its controllers to the project's Stimulus, this is where those 2 options come into play:

1) The simpler option

Go into assets/bootstrap.js and import each controller and register with Stimulus. So

import TacController from '@tacman/your-package/controllers/tac-controller';
// ...

app.register('tac', TacController);
2) The more magic option

To mimic what the core UX packages do, add a section like this to your bundle's package.json file https://github.com/symfony/...

NOW you will be able to go into the assets/controllers.json file and point to the new controller. Actually, if you NOW installed the bundle, Flex would update the controllers.json file automatically.

Let me know if you hit any bumps! Really happy you're digging Stimulus - me too!

Cheers!

