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
            hostPath = builtins.toString ./.;
            readOnly = false;
          };
        };
        targetHost = "192.168.56.111";
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
      networking.interfaces.enp0s8.ipv4.addresses = [ { address = "192.168.56.111"; prefixLength = 24; } ];

      environment.systemPackages = with pkgs; [
        phpPackages.composer
        yarn
      ];

      system.activationScripts.composer = ''
      ${pkgs.bash}/bin/bash -f <<EOF
        cd /srv
        echo "installing third-party dependencies"
        test -f composer.json && ${pkgs.phpPackages.composer}/bin/composer install || { echo "composer.json not found - is the shared folder mounted correctly?"; exit 1; }
        test -f package.json && ${pkgs.yarn}/bin/yarn install || { echo "package.json not found - is the shared folder mounted correctly?"; exit 1; }
      EOF

      '';

#     nginx alternative to apache
#
#     services = {
#       nginx = {
#         enable = true;
#         virtualHosts = {
#           "localhost" = {
#             root = "/srv";
#             locations = {
#               "~ \\.php$" = {
#                 extraConfig = ''
#                   fastcgi_pass  unix:/run/phpfpm/mypool;
#                 '';
#               };
#             };
#             extraConfig = ''
#               index index.php;
#             '';
#           };
#         };
#       };
#
#       phpfpm.pools = {
#         mypool = {
#           listen = "/run/phpfpm/mypool";
#           extraConfig = ''
#             listen.owner = nginx
#             listen.group = nginx
#             user = nobody
#             group = nogroup
#             pm = dynamic
#             pm.max_children = 5
#             pm.start_servers = 2
#             pm.min_spare_servers = 1
#             pm.max_spare_servers = 3
#             php_admin_value[date.timezone] = Europe/Berlin
#             php_admin_value[openssl.cafile] = /etc/ssl/certs/ca-certificates.crt
#           '';
#         };
#       };
#     };
    };
}
