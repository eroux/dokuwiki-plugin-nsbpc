## Namespace-based configuration for Dokuwiki

This plugin is a very simple helper that can handle per-namespace configuration with inheritance. Its goal is to enable plugins to get a simple per-namespace configuration. It was designed for a digital library using Dokuwiki to provide online collaborative books. Each book (one per namespace) being specific, some configuration had to be adapted for each of them, hence the need for a fine-grained configuration.

### How it works

The solution used is very simple: it uses configuration files with the name `__pluginname.cfg`, with the very same syntax as ini files (for the sake of simplicity and not reinventing the wheel). See [php.net] (especially the *Changelog* section)for the description of the function used to parse config files.

When a plugin wants to read its configuration, it calls the function `getConf($pluginname, $currentns)`, and gets an array with simple `key->values` content. This array has the same structure as described in [php.net], with *process_sections* set to `false`. 

The `getConf` function reads first the config file in the current namespace, and then in the parent namespace, etc., skipping if files don't exist and never overriding the values. Which means that if you have a config file in the current namespace defining `foo->foo` and a config file in the parent namespace with `foo->bar`, then the `getConf` function will return `foo->foo`.

NSBPC also provides a function `getConfFile($pluginname, $currentns)` that provides the path of the closest `__pluginname.cfg` file, by looking in the current directory, then in the parent, etc.

### Limitations

Cache issues are not yet handled, so when modifying your config files, you may
have to clean your cache...

Please see [php.net] for the limitations of the `parse_ini_files` function according to your version of PHP. It should work well with PHP >= 5.3.

### Requirements

This plugin is very simple and should work with any version of Dokuwiki.

### License

This plugin is licensed under the GPLv2+ license.

[php.net]: http://php.net/manual/fr/function.parse-ini-file.php
