{
  description = "wnstTimetable";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils }:
    flake-utils.lib.eachDefaultSystem (system:
      let
        phpVersion = "php85";
        pkgs = import nixpkgs {
          inherit system;
        };
        php = pkgs.${phpVersion};
        ppkgs = pkgs.${phpVersion}.packages;
        phpEnv = php.buildEnv {
          extensions = ({ enabled, all }: enabled ++ (with all; [
            gd
            mysqli
            mbstring
            zip
            pdo
            pgsql
          ]));

          extraConfig = ''
            memory_limit = -1
          '';
        };

      in
      {
        devShell = pkgs.mkShell {
          buildInputs =
            [
              phpEnv
              ppkgs.composer

              ppkgs.php-codesniffer

              pkgs.go-task
              pkgs.lefthook
              pkgs.commitlint-rs
              pkgs.git
              pkgs.semgrep
            ];

          shellHook = ''
            alias php=${phpEnv}/bin/php
            composer install
            task
          '';
        };
      }
    );
}
