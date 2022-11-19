Installation instructions:
Install apache, php, and mysql.

If running in vagrant, you will need to adjust permissions to that apache can save file uploads.
Vagrant file should have a mounted drive to the public folders with proper permissions.

config.vm.synced_folder "./BonAppetitRestaurantManagementSystem", "/var/www/bonappetit", mount_options: ["dmode=777", "fmode=666"]