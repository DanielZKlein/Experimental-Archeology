copy "my dropbox\fulldump.rar" .
unrar x -y fulldump.rar
mysql -u root ea < dump.sql