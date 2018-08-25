# Setup

VM is currently set up with nix. To set up this VM run
`$ nixops create -d NAME phpserver.nix` (set the NAME to your liking).

`$ nixops deploy -d NAME --allow-reboot` (at your first boot, --force-reboot might be required) will initalize the VM and start it.

Now you can call the `index.php` in your browser.

To stop the VM, run `$ nixops stop -d NAME`.

# NixOps commands

```
$ nixops create -d NAME phpserver.nix


$ nixops list


$ nixops deploy -d NAME --allow-reboot
$ nixops ssh -d NAME phpserver
$ nixops stop -d NAME

$ nixops destroy -d NAME
$ nixops delete -d NAME
```


# License

MIT
