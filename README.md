## Namespace-based configuration for Dokuwiki

This plugin is a very simple helper that can handle per-namespace configuration with inheritance. Its goal is to enable plugins to get a simple per-namespace configuration. It was designed for a digital library using Dokuwiki to provide online collaborative books. Each book (one per namespace) being specific, some configuration had to be adapted for each of them, hence the need for a fine-grained configuration.

### How to use

Using this plugin in your plugin is very simple, you just need to override the `loadConfig` method of your plugin with the following one:

```php
function loadConfig(){
  parent::loadConfig(); // fills $this->conf with usual dokuwiki plugin config 
  $nsbpc = $this->loadHelper('nsbpc');
  $nsbpconf = $nsbpc->getConf($this->getPluginName(), getNS(cleanID(getID())));
  if ($this->conf) {
    $this->conf = array_replace($this->conf, $nsbpconf);
  } else {
    $this->conf = $nsbpconf;
  }
}
```

You will be able to use both normal Dokuwiki configuration (in the `conf/` folder of your plugin) and namespace-based configuration. The latter will have precendence in case of conflict.

When setting up nsbpc, you will certainly want to hide nsbpc configuration pages. To do so, please set the [hidepages](*hidepages* parameter) to `.*nsbpc.*` in your [configuration](configuration manager).

### How it works

The solution used is very simple: it uses configuration pages with the name `nsbpc_pluginname`, with the very same syntax as ini files (for the sake of simplicity and not reinventing the wheel). See [php.net], especially the *Changelog* section), for the description of the function used to parse config files.

When a plugin wants to read its configuration, it calls the function `getConf($pluginname, $currentns, $process_sections=false)`, and gets an array with simple `key->values` content. This array has the same structure as described in [php.net], with *process_sections* set to `false` by default (but changeable).

The `getConf` function reads first the config file in the current namespace, and then in the parent namespace, etc., skipping if files don't exist and never overriding the values. Which means that if you have a config file in the current namespace defining `foo->foo` and a config file in the parent namespace with `foo->bar`, then the `getConf` function will return `foo->foo`.

NSBPC also provides a function `getConfID($pluginname, $currentns)` that provides the id of the closest `nsbpc_pluginname` page, by looking in the current directory first, then in the parent, etc. The function `getConfID($pluginname, $currentns)` is the same, but returns the full file path instead. Note that these function can be used to locate config files not parseable by `parse_ini_file`.

In the case where no conf file is found, the return value is `false` for `getConfID` and `getConfFN`, and an empty array for `getConf`.

### Limitations

Cache issues are not yet handled, so when modifying your config files, you may
have to clean your cache.

Please see [php.net] for the limitations of the `parse_ini_files` function according to your version of PHP. It should work well with PHP >= 5.3.

In case of problems, no warning is issued.

No `conf['hidepages']` is set, as `nsbpc_xxx` pages are not seen in *nstoc* (which is the only automaticly generated list I can see so far). Please tell me if your config pages appear in a page list!

### Requirements

This plugin is very simple and should work with any version of Dokuwiki.

### License

This plugin is licensed under the GPLv2+ license.

### TODO

Automate configuration pages hiding.

[php.net]: http://php.net/manual/fr/function.parse-ini-file.php
[configuration]:https://www.dokuwiki.org/plugin:config
[hidepages]:https://www.dokuwiki.org/config:hidepages
