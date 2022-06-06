Mvc project
======================

##Docker

## Load MongoDb
1) Before creating the container, create folder "var/data" in this root

```bash
mkdir -p ./var/data
```

2) Move all backup database to data folder (*.bson, *.json), and:
   Execute
```bash
dcupd mongo
```

If this is the first time you create this container, all files defined in 'docker-entrypoint-initdb.d' are automatically executed

If it does not run automatically, start running manually

```bash
dce mongo sh docker-entrypoint-initdb.d/restore_db.sh
```

script: restore_db.sh
```bash
#!/bin/bash
if [[ -d "./data" ]]; then
    mongorestore --db mvc ./data
else
    echo Error not exist data folder
fi
```

### Commands Make

```bash
Usage:
  make <target>

Targets:
  help             Displays all available targets
  build            Build the Docker images and volumes
  start             start the external Docker services and then the internal ones
  stop             Stop the external Docker services and then the internal ones
  unit-tests       Runs the unit tests
  clean            Turn off running Docker Compose services and remove volumes and images
```
