#!/usr/bin/env bash

if [[ ! -e "$1/shopware.php" ]]; then
    echo "$1 is not a valid shopware directory!"
    exit 1
fi

for plugin in $( ls ); do
    if [[ ! -e "$plugin/plugin.xml" ]]; then
        continue
    fi

    echo "Create symlink for $plugin in $1/custom/plugins/$plugin"

    ln -s $(pwd)/$plugin $1/custom/plugins
done