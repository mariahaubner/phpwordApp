{
  network.description = "Web server with php";

  phpserver =
    { config, pkgs, ... }:
    { 
      deployment = {
        targetEnv = "virtualbox";
        virtualbox.memorySize = 1024;
        virtualbox.sharedFolders = {
          froscon2018 = {
            hostPath = "/home/maria/froscon2018";
            readOnly = false;
          };
        };
      };

      services.httpd = {
        enable = true;
        adminAddr = "example@example.org";
        documentRoot = "/srv";
        enablePHP = true;
        extraConfig = ''
          DirectoryIndex index.php
        '';
      };

      fileSystems."/srv" = {
        device = "froscon2018";
        fsType = "vboxsf";
      };

      networking.firewall.allowedTCPPorts = [ 80 ];

      environment.systemPackages = with pkgs; [
        phpPackages.composer
      ];
    };
}
