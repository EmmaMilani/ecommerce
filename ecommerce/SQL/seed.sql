insert into ecommerce.products(nome, prezzo, marca)
values ("tosaerba", 289.99, "oleomac"),
       ("vaso", 9.99, "Villeroy e Boch"),
       ("personal computer", 1799.99, "msi"),
       ("bibbia", 15, "san paolo"),
       ("modellino ferrari", 129.99, "Ferrari");

insert into ecommerce.roles(nome, descrizione)
values ("shopper", "utente base"),
       ("admin", "utente privilegiato");

insert into ecommerce.users(email, password, role_id)
values ('alice@gmail.com', SHA2('password123', 256), 1),
       ('bob@gmail.com', SHA2('qwerty456', 256), 2),
       ('charlie@outlook.com', SHA2('letmein789', 256), 2),
       ('david@libero.it', SHA2('pass1234', 256), 1);

insert into ecommerce.carts(user_id)
values (1);

insert into ecommerce.cart_products(cart_id, product_id, quantita)
values (1, 2, 3),
       (1, 4, 1);

insert into ecommerce.users(email, password, role_id)
values ('emma@gmail.com', SHA2('123', 256), 2);