# Setup

VM is currently set up with nix. To set up this VM run
`$ nixops create -d NAME phpserver.nix` (set the NAME to your liking).

`$ nixops deploy -d NAME --allow-reboot` will initalize the VM and start it. 

Connect onto the server via `$ nixops ssh -d NAME phpserver`, change into the `/srv`-folder
and run `composer install`. Now you can call the `index.php` in your browser.

To stop the VM, run `$ nixops stop -d NAME`.




# NixOS commands
```
$ nixops create -d NAME phpserver.nix


$ nixops list


$ nixops deploy -d NAME --allow-reboot
$ nixops ssh -d NAME phpserver
$ nixops stop -d NAME

$ nixops destroy -d NAME
$ nixops delete -d NAME
```