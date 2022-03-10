#!/bin/bash
echo Updating...


git stash
git pull

### Folder rights
chgrp www-data web/assets
chmod g+w web/assets/

chgrp www-data runtime
chmod g+w runtime/

chgrp www-data web/storage
chmod g+w web/storage/

echo Versioning...
git rev-parse HEAD>version.txt


echo Done!
