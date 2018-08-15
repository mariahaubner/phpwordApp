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
      };

      services.httpd = {
        enable = true;
        adminAddr = "example@example.org";
        documentRoot = "/srv";
        enablePHP = true;
        extraConfig = ''
          DirectoryIndex index.html
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

      system.activationScripts.composer = ''
        cd /srv
        test -f composer.json && ${pkgs.phpPackages.composer}/bin/composer install
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
