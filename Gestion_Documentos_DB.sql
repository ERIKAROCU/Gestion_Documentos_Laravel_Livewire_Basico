CREATE DATABASE gestion_documentos;

use gestion_documentos;

select*from documents;
select*from files;
select*from users;
select*from oficinas order by id desc;
SELECT * FROM oficinas;
SHOW COLUMNS FROM documents LIKE 'estado';
describe files;


drop database gestion_documentos;