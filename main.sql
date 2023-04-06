CREATE TABLE IF NOT EXISTS ecomm_products (
    id INT AUTO_INCREMENT, 
    stock INT, 
    title TEXT,
    subtitle TEXT,
    img TEXT, 
    created_at DATE, 
    updated_at DATE,
    price FLOAT,
    discount INT,
    PRIMARY KEY(id)
);


INSERT INTO ecomm_products VALUES 
(NULL, 100, 'Lorem, ipsum dolor 1' , 'Lorem, ipsum dolor sit amet consectetur 1', 'no_image.png', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 200.43, 20),
(NULL, 25, 'Lorem, ipsum dolor 2' , 'Lorem, ipsum dolor sit amet consectetur 2', 'no_image.png', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 685.23, 16),
(NULL, 86, 'Lorem, ipsum dolor 3' , 'Lorem, ipsum dolor sit amet consectetur 3', 'no_image.png', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 1250.11, 22),
(NULL, 62, 'Lorem, ipsum dolor 4' , 'Lorem, ipsum dolor sit amet consectetur 4', 'no_image.png', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 302.80, 25),
(NULL, 164, 'Lorem, ipsum dolor 5' , 'Lorem, ipsum dolor sit amet consectetur 5', 'no_image.png', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 50.50, 30),
(NULL, 98, 'Lorem, ipsum dolor 6' , 'Lorem, ipsum dolor sit amet consectetur 6', 'no_image.png', UTC_TIMESTAMP(), UTC_TIMESTAMP(), 163.16, 40);


