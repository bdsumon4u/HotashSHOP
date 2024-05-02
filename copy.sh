#!/bin/bash

# Define the name and public key
KEY_NAME="GACD"
ssh_private_key="$HOME/.ssh/$KEY_NAME"

# Define the path to the .env file
env_file=".env"

# Check if the .env file exists
if [ -f "$env_file" ]; then
    # Define the variables you want to extract
    variables=("DB_USERNAME" "DB_DATABASE" "DB_PASSWORD")

    # Read the .env file line by line
    while IFS='=' read -r key value; do
        # Check if the key is one of the variables you want to extract
        if [[ " ${variables[@]} " =~ " $key " ]]; then
            # Remove leading/trailing whitespace from the value
            # value=$(echo "$value" | sed -e 's/^"//' -e 's/"$//' -e "s/^'//" -e "s/'$//")

            # Export the key-value pair as shell variables
            export "$key"="$value"
        fi
    done < "$env_file"
else
    echo "Error: .env file not found."
    exit 1
fi

# Variables of `source` are now available in the shell


default_root_dir="public_html"
# Prompt for target website details
read -p "Enter target site name: " target_site
read -p "Enter target site domain: " ssh_host
read -p "Enter target cPanel username: " target_username
read -p "Enter target database name: " -ei "${target_username}_" target_db_dbase
read -p "Enter target database username: " -ei "${target_username}_" target_db_uname
read -p "Enter target database password: " target_db_upass
read -p "Enter support@$ssh_host password: " target_mail_pass
read -p "Enter target site root directory: " -ei "$default_root_dir" target_root_dir
echo

# Function to check if the public key is installed on the target server
check_public_key_installed() {
    # Check if the public key exists in the authorized_keys file on the server
    ssh -i $ssh_private_key $target_username@$ssh_host "grep -q '$(cat $ssh_private_key.pub)' .ssh/authorized_keys"
    
    # Return the exit status of the previous command
    return $?
}

# Function to connect to target server via SSH
connect_to_target() {
    # Attempt to connect to target server via SSH
    ssh -i $ssh_private_key $target_username@$ssh_host "exit"

    # Check the exit status of the previous command
    if [ $? -eq 0 ]; then
        echo "Successfully connected to the target server."
    else
        echo "Failed to connect to the target server."
        return 1
    fi
}

# Try to connect to the target server
connect_to_target || {
    # Check if the public key is installed on the target server
    check_public_key_installed
    
    # If the public key is not installed, prompt the user to add it
    if [ $? -ne 0 ]; then
        echo
        echo "Please add the following public key to the target server:"
        echo "Name: $KEY_NAME"
        echo "Public Key:"
        cat "$ssh_private_key.pub"
        echo
        read -p "Press Enter after authorizing the public key, or enter 'q' to quit: " response

        # If the user enters 'q', exit the script
        if [ "$response" = "q" ]; then
            exit 1
        fi
    fi
    
    # Retry connecting to the target server
    connect_to_target
}

# Transfer SSH Private Key to target
scp -i $ssh_private_key $ssh_private_key $target_username@$ssh_host:.ssh
ssh -i $ssh_private_key $target_username@$ssh_host "chmod 600 .ssh/$KEY_NAME"

# Transfer database and files from source to target
mysqldump -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE > database_backup.sql
zip -r -1 -y -9 site_backup.zip . -x "storage/app/pathao*" "storage/app/mpdf" "storage/debugbar" "storage/framework" "storage/logs"
scp -i $ssh_private_key site_backup.zip $target_username@$ssh_host:site_backup.zip
rm site_backup.zip database_backup.sql

# Unzip files and import database on the target
ssh -i $ssh_private_key $target_username@$ssh_host "unzip -o site_backup.zip -d $target_root_dir && rm site_backup.zip"
ssh -i $ssh_private_key $target_username@$ssh_host "cd $target_root_dir && mysql -u $target_db_uname -p$target_db_upass $target_db_dbase < database_backup.sql && rm database_backup.sql"

# Update .env file on the target
scp -i $ssh_private_key .env $target_username@$ssh_host:$target_root_dir/.env
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/APP_NAME=.*/APP_NAME='$target_site'/\" $target_root_dir/.env"
# ssh -i $ssh_private_key $target_username@$ssh_host "sed -i 's/APP_DEBUG=.*/APP_DEBUG=true/' $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s|APP_URL=.*|APP_URL=https://www.$ssh_host|\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/DB_DATABASE=.*/DB_DATABASE=$target_db_dbase/\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/DB_USERNAME=.*/DB_USERNAME=$target_db_uname/\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/DB_PASSWORD=.*/DB_PASSWORD='$target_db_upass'/\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/MAIL_HOST=.*/MAIL_HOST=mail.$ssh_host/\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/MAIL_USERNAME=.*/MAIL_USERNAME=support@$ssh_host/\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/MAIL_PASSWORD=.*/MAIL_PASSWORD='$target_mail_pass'/\" $target_root_dir/.env"
ssh -i $ssh_private_key $target_username@$ssh_host "sed -i \"s/MAIL_FROM_ADDRESS=.*/MAIL_FROM_ADDRESS=support@$ssh_host/\" $target_root_dir/.env"


# Done
ssh -i $ssh_private_key $target_username@$ssh_host "cd $target_root_dir && ./server_deploy.sh && rm -rf public/storage storage/app/pathao* && php artisan storage:link && php artisan optimize:clear"
