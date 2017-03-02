#!/usr/bin/env bash
rm scenario.rerun
bin/behat
touch scenario.rerun
bin/behat --rerun
rm scenario.rerun