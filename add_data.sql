INSERT INTO user_type (id, name) VALUES
(1, "owner"),
(2, "manager"),
(3, "staff");

INSERT INTO menu_category VALUES ("Main Dishes");

INSERT INTO menu_item VALUES (NULL, "Classic Burger", 18.99, 1, "Main Dishes");

INSERT INTO menu_category VALUES
("Main Dishes"),
("Desserts"),
("Appetizers");

INSERT INTO menu_item (name, description, price, active, category) VALUES
("Classic Burger", "Juicy 100% angus burger with extra sharp vermont cheddar cheese on a brioche bun.", 18.99, 1, "Main Dishes"),
("Turkey Burger", "Lean smoked turkey with swiss chese on an onion bun.", 15.99, 1, "Main Dishes"),
("Pumpkin Cheesecake", "Freshly made pumpkin cheesecake with whipped cream.", 8.99, 1, "Desserts"),
("Ice Cream Sundae", "Vanilla, chocolate, and strawberry ice cream with bananas, nuts, and whipped cream.", 6.99, 1, "Desserts"),
("Jalapaño Poppers", "Breaded jalapeño peppers served with salsa.", 6.99, 1, "Appetizers"),
("Quesadilla", "Fresh qusadilla with cheddar and mozzarella cheese, served with salsa.", 7.49, 1, "Appetizers");

INSERT INTO restaurant (name, address, cuisine_type)
VALUES ("Bon Appetiti","10th Street Ave, NYC, NY, 113642, USA", "American");
-- ("", "", "Italian"),
-- ("", "", "French"),
-- ("", "", "Chinese"),
-- ("", "", "Japanese"),
-- ("", "", "Indian"),
-- ("", "", "Greek"),
-- ("", "", "Spanish"),
-- ("", "", "Lebanese"),
-- ("", "", "Moroccan"),
-- ("", "", "Turkish"),
-- ("", "", "Thai"),
-- ("", "", "Pakistani"),
-- ("", "", "Indonesian"),
-- ("", "", "German"), 
-- ("", "", "Oceanic");