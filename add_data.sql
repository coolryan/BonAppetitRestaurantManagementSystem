-- Filename: add_data.sql
-- Author: Ryan Setaruddin
-- BCS 350- Web Database Developement
-- Professor Kaplan
-- Date: Novermber 26, 2022
-- Purpose: To insert specific data into these tables according to the owners

INSERT INTO user_type (id, name) VALUES
(1, "owner"),
(2, "manager"),
(3, "staff");

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

INSERT INTO restaurant (name, address, cuisine_type, back_story)
VALUES ("Bon Appetiti","10th Street Ave, NYC, NY, 113642, USA", "American", "Ted and James Bradley were born and raised in New York City, NY. In early 1920s, they open the Bon Appetit Paris restaruarnt in small town of Glen Cove, NY. They always holding to tehir true motto The Best Food, The Best Restaurant. Many people loved so that they decide about it to their friends and family. Unforuntely, over the course of years since 1920s, they were grow tire the orginal location and decide to open up newer and better version the restaurant. but then the popularity went down due to the great depression. The orginal owners got sick and malnurshed during at the time and they decesse and the restuarnt was closed for long time. After many years had pass. Unknown new oweners some how gain the opportunity in 21th century and decide to create website about this restaurant and had modern day touches to it.");

SET @rest_id = (select restaurant_id FROM restaurant LIMIT 1);
INSERT INTO restaurant_table (restaurant_table_id, max_chairs, restaurant_id)
VALUES
(1, 2, @rest_id),
(2, 2, @rest_id),
(3, 2, @rest_id),
(4, 2, @rest_id),
(5, 3, @rest_id),
(6, 3, @rest_id),
(7, 3, @rest_id),
(8, 3, @rest_id),
(9, 6, @rest_id),
(10, 6, @rest_id),
(11, 6, @rest_id),
(12, 6, @rest_id),
(13, 6, @rest_id),
(14, 6, @rest_id),
(15, 6, @rest_id),
(16, 6, @rest_id),
(17, 10, @rest_id),
(18, 10, @rest_id),
(19, 10, @rest_id),
(20, 10, @rest_id);
