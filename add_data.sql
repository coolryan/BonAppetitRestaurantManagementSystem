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
INSERT INTO restaurant_table (table_number, max_chairs, restaurant_id)
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

-- Reservations
INSERT INTO reservation_table (party_size, reservation_date, reservation_time, patron_name, patron_phone, patron_email, restaurant_table_id) VALUES
(2, "2022-10-01", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 1),
(2, "2022-10-02", "18:20:00", "Rylan Wood", "123121324", "Rylan@Wood.com", 2),
(2, "2022-10-02", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-10-22", "13:30:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9),
(6, "2022-10-03", "13:20:00", "Thea Waters", "123121324", "Thea@Waters.com", 10),
(6, "2022-10-04", "13:30:00", "Arianna Horton", "123121324", "Arianna@Horton.com", 9),
(7, "2022-10-05", "15:30:00", "Athena Tyler", "123121324", "Athena@Tyler.com", 17),
(3, "2022-10-06", "16:30:00", "Raelyn Hall", "123121324", "Raelyn@Hall.com", 5),
(3, "2022-10-07", "16:30:00", "Juliana Schultz", "123121324", "Juliana@Schultz.com", 5),
(10, "2022-10-08", "18:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(8, "2022-10-09", "07:40:00", "Bob Greenly", "213123523566", "bob@greenly.com", 17),
(4, "2022-10-10", "16:30:00", "Raelyn Hall", "123121324", "Raelyn@Hall.com", 9),
(5, "2022-10-11", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 10),
(6, "2022-10-12", "16:30:00", "Julianna Schultz", "123121324", "Juliana@Schultz.com", 10),
(5, "2022-10-13", "17:45:00", "Isla Klein", "1231231234", "isla@klein.com", 9),
(8, "2022-10-14", "16:30:00", "Johnny Butler", "123121324", "Johnny@Butler.com", 18),
(10, "2022-10-15", "17:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(2, "2022-10-16", "16:30:00", "Chase Diaz", "123121324", "Chase@Diaz.com", 1),
(2, "2022-10-17", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-11-18", "14:20:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9),
(10, "2022-10-19", "17:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(2, "2022-10-20", "16:30:00", "Chase Diaz", "123121324", "Chase@Diaz.com", 1),
(2, "2022-10-21", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-11-22", "14:20:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9),
(2, "2022-10-23", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 1),
(2, "2022-10-23", "18:20:00", "Rylan Wood", "123121324", "Rylan@Wood.com", 2),
(2, "2022-10-23", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-10-23", "13:30:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9),
(6, "2022-10-23", "13:20:00", "Thea Waters", "123121324", "Thea@Waters.com", 10),
(6, "2022-10-25", "13:30:00", "Arianna Horton", "123121324", "Arianna@Horton.com", 9),
(7, "2022-10-25", "15:30:00", "Athena Tyler", "123121324", "Athena@Tyler.com", 17),
(3, "2022-10-25", "16:30:00", "Raelyn Hall", "123121324", "Raelyn@Hall.com", 5),
(3, "2022-10-26", "16:30:00", "Juliana Schultz", "123121324", "Juliana@Schultz.com", 5),
(10, "2022-10-26", "18:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(8, "2022-10-26", "07:40:00", "Bob Greenly", "213123523566", "bob@greenly.com", 17),
(4, "2022-10-27", "16:30:00", "Raelyn Hall", "123121324", "Raelyn@Hall.com", 9),
(5, "2022-10-27", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 10),
(6, "2022-10-28", "16:30:00", "Julianna Schultz", "123121324", "Juliana@Schultz.com", 10),
(5, "2022-10-28", "17:45:00", "Isla Klein", "1231231234", "isla@klein.com", 9),
(8, "2022-10-29", "16:30:00", "Johnny Butler", "123121324", "Johnny@Butler.com", 18),
(10, "2022-10-29", "17:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(2, "2022-10-30", "16:30:00", "Chase Diaz", "123121324", "Chase@Diaz.com", 1),
(2, "2022-10-30", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-10-30", "14:20:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9),
(10, "2022-11-16", "18:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(2, "2022-11-24", "17:30:00", "Vincent Horton", "123123124", "vincent@horton.com", 1),
(7, "2022-11-24", "17:46:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(10, "2022-11-24", "16:30:00", "Callum Ruiz", "1231231234", "callum@ruiz.com", 18),
(5, "2022-11-24", "17:45:00", "Isla Klein", "1231231234", "isla@klein.com", 9),
(6, "2022-11-24", "16:15:00", "Axel Harris", "1231231234", "axel@harris.com", 10),
(3, "2022-11-24", "16:35:00", "Eduardo Shultz", "1231232134", "eduardo@shultz.com", 5),
(3, "2022-11-24", "18:45:00", "Delaney Waters", "1231231234", "delaney@waters.com", 6),
(4, "2022-11-24", "15:45:00", "Wyatt Davis", "1231231234", "Wyatt@Davis.com", 6),
(5, "2022-11-24", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 11),
(2, "2022-11-23", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 1),
(2, "2022-11-23", "18:20:00", "Rylan Wood", "123121324", "Rylan@Wood.com", 2),
(2, "2022-11-23", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-11-23", "13:30:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9),
(6, "2022-11-23", "13:20:00", "Thea Waters", "123121324", "Thea@Waters.com", 10),
(6, "2022-11-25", "13:30:00", "Arianna Horton", "123121324", "Arianna@Horton.com", 9),
(7, "2022-11-25", "15:30:00", "Athena Tyler", "123121324", "Athena@Tyler.com", 17),
(3, "2022-11-25", "16:30:00", "Raelyn Hall", "123121324", "Raelyn@Hall.com", 5),
(3, "2022-11-26", "16:30:00", "Juliana Schultz", "123121324", "Juliana@Schultz.com", 5),
(10, "2022-11-26", "18:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(8, "2022-11-26", "07:40:00", "Bob Greenly", "213123523566", "bob@greenly.com", 17),
(4, "2022-11-27", "16:30:00", "Raelyn Hall", "123121324", "Raelyn@Hall.com", 9),
(5, "2022-11-27", "17:40:00", "Brooklyn Watts", "123121324", "Brooklyn@Watts.com", 10),
(6, "2022-11-28", "16:30:00", "Julianna Schultz", "123121324", "Juliana@Schultz.com", 10),
(5, "2022-11-28", "17:45:00", "Isla Klein", "1231231234", "isla@klein.com", 9),
(8, "2022-11-29", "16:30:00", "Johnny Butler", "123121324", "Johnny@Butler.com", 18),
(10, "2022-11-29", "17:30:00", "Natalie Davis", "1231231234", "natalie@davis.com", 17),
(2, "2022-11-30", "16:30:00", "Chase Diaz", "123121324", "Chase@Diaz.com", 1),
(2, "2022-11-30", "7:30:00", "Miracle Houston", "123121324", "Miracle@Houston.com", 1),
(5, "2022-11-30", "14:20:00", "Adeline Stewart", "123121324", "Adeline@Stewart.com", 9)
(4, "2022-12-01", "18:24:00", "Steven Ford", "1231231234", "steve@ford.com", 9),
(7, "2022-12-02", "08:32:00", "Bob Greenly", "213123523566", "bob@greenly.com", 17),
(5, "2022-12-01", "19:45:00", "Juan Juancho", "1231231234", "juan@juancho.com", 9);
