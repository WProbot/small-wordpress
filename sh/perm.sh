# Set all directories permissions to 755
find . -type d -exec chmod 755 {} \;

# Set all files permissions to 644
find . -type f -exec chmod 644 {} \;

# Set wp-config.php file with 604 permission
sudo chmod 640 wp-config.php
