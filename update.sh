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

chmod +x update.sh
chmod +x yii

echo Done!
