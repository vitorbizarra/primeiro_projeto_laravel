use sg;

select * from fornecedores;

select * from users;

select * from motivo_contatos;

truncate site_contatos;
select * from site_contatos order by id desc;

show tables from sg;

select * from log_acessos;

insert into users (name, email, password) values ('jorge', 'jorge@contato.com', '123');
select * from users;