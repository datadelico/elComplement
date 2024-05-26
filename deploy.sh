#!/bin/bash

# Variables
LOCAL_PLUGIN_DIR="/home/egarcia/Documentos/elComplement"
REMOTE_USER="root"
REMOTE_HOST="192.168.56.11"
REMOTE_PLUGIN_DIR="/var/www/html/wordpress/wp-content/plugins/elComplement/"

# Elimina el plugin existent a la màquina virtual
echo "Eliminant el plugin existent a la màquina virtual..."
ssh $REMOTE_USER@$REMOTE_HOST "rm -rf $REMOTE_PLUGIN_DIR"

# Copia els fitxers a la màquina virtual
echo "Copiant fitxers a la màquina virtual..."
rsync -av --delete $LOCAL_PLUGIN_DIR/ $REMOTE_USER@$REMOTE_HOST:$REMOTE_PLUGIN_DIR

# Ajusta permisos
echo "Ajustant permisos..."
ssh $REMOTE_USER@$REMOTE_HOST "chown -R www-data:www-data $REMOTE_PLUGIN_DIR && chmod -R 755 $REMOTE_PLUGIN_DIR"

echo "Desplegament completat."
