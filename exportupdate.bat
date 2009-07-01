del dump.sql
del fulldump.rar
mysqldump -u root ea > dump.sql
rar a fulldump.rar *
copy fulldump.rar "my dropbox"