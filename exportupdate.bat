del dump.sql
del debug.log
copy emptylog.log debug.log
del fulldump.rar
mysqldump -u root ea > dump.sql
rar a fulldump.rar *
move fulldump.rar "my dropbox"