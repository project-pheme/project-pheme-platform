#!/bin/bash

SRC_PATH=${SRC_PATH:-/vols/src}
OUT_PATH=${OUT_PATH:-/vols/out}

check_vols_src() {
  if [ ! -d ${SRC_PATH} ]; then
    echo "No ${SRC_PATH} with code"
    exit 1
  fi
}
check_vols_out() {
  if [ ! -d ${OUT_PATH} ]; then
    echo "No ${OUT_PATH} for output!"
    exit 1
  fi
}

# Bring in source files, taking care not to bring in useless files or overwriting useful ones
function sync {
  check_vols_src
  {
    for f in bin/*; do
      echo "- ${f}"
    done
    for f in modules/*; do
      echo "- ${f}"
    done
    echo "- .git"
    echo "- vendor"
    echo "- tmp"
  } > /tmp/rsync_exclude
  rsync -ar --exclude-from=/tmp/rsync_exclude --delete-during ${SRC_PATH}/ ./
}

function run_composer_install {
  composer install
}

function bundle {
  check_vols_out
  local version=${GITHUB_VERSION:-${CI_BRANCH:-v0.0.0}}
  DEST_DIR=${OUT_PATH} ./bin/release $version
}

sync
run_composer_install
bundle
