Help Us UI
==================

This is the source for the UI

Requirements
------------

- [npm](https://npmjs.org/), for installing the various development
  requirements, which primarily includes [Grunt](http://gruntjs.com) and
  [Bower](http://bower.io/), and tools these to utilize.
- [Bower](http://bower.io/) must be installed globally in order to allow using
  it to install development dependencies.

Run the following command from this directory to install dependencies:

```sh
npm install
```

If you have not yet installed Bower, please do so:

```sh
sudo npm install -g bower
```

Finally, invoke Bower to install the relevant CSS and JS libraries:

```sh
bower install
```

Workflow
--------


All changes to the  UI code should be made in the `src/help-us/`
directory. We recommend running `grunt watch` during development so that you may
be alerted of JS syntax errors, LESS compilation errors, etc.

Once you are happy with the changes you have made, you will need to rebuild the
distribution files. Run the following from this directory:


```sh
(asset) $ grunt clean && grunt build
```

Finally, re-enable production mode:

```sh
(asset) $ ../bin/ui-mode.php --production
```

Test that everything is working against the distribution on completion.

Be sure to commit both the `src` and `dist` files when done.

Adding JS/CSS Dependencies
--------------------------

If you need to add any new JS or CSS dependencies, please do so as follows:

- Edit the `bower.json` file and add the dependency
- Execute `bower install`
- Add the files to `src/help-us/index.html` in the appropriate
  section of the file.
- Execute `grunt clean && grunt build`.
- Commit your changes.

