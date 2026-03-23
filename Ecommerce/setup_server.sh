#!/bin/bash

# Exit on error
set -e

echo "--- Starting Server Setup ---"

# 1. Update system
sudo apt update && sudo apt upgrade -y

# 2. Install PHP and MySQL extensions
sudo apt install -y php-cli php-mysql php-curl php-gd php-mbstring git unzip

# 3. Install MariaDB
sudo apt install -y mariadb-server
sudo systemctl start mariadb
sudo systemctl enable mariadb

# 4. Install Node.js and PM2
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
sudo npm install -g pm2

# 5. Database Setup
DB_NAME="Ecommerce"
DB_USER="ecommerce_user"
DB_PASS="secure_password" # Change this to something more secure

echo "Setting up MariaDB database and user..."
sudo mysql -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;"
sudo mysql -e "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';"
sudo mysql -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 6. Project Setup
# Assuming the user clones the repo into /var/www/html/Ecommerce
# sudo mkdir -p /var/www/html
# cd /var/www/html
# git clone <YOUR_REPO_URL> Ecommerce
# cd Ecommerce

echo "--- Setup Complete ---"
echo "Instructions:"
echo "1. Push your work to GitHub."
echo "2. Clone your work on the server: git clone <YOUR_REPO_URL> /var/www/html/Ecommerce"
echo "3. Run the database setup: php /var/www/html/Ecommerce/database/setup.php"
echo "4. Start the application: sudo pm2 start ecosystem.config.js"
