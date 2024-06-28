Sumazon -- an online shopping website using 3-layer architecture
First, your program should be implemented in a three-layer manner. In other words, there
should be a clear separation between your user interface, logic, and database. You can
implement the system using ANY language you prefer. You can design your UI ANY way
you want. You can use either local databases OR cloud databases.

Required features of Sumazon:

1. There should be two roles associated with your system: Administrator and User.
A login should be provided to differentiate these two roles. An administrator can
add/delete/edit any products in your database directly through the user interface
provided. A user is a customer.
2. Either the administrator or users are able to edit their profile, including showing
username, editing email, password, address, and number.
3. Users can search for a product. If related products are stored in your database, the
UI should provide the user with all the related products in a concise manner (which
includes product picture, product name, and product price).
4. When users click on one of the products, the system should lead users to the place
where detailed information is provided (which includes product picture, product
name, product price, and product description).
5. Users can place a product (or multiple products) into the shopping cart (as a review
of your order) from the UI discussed in the previous feature.
6. Users can “pay” (you do not need to actually implement the payment system) for
the product. The payment here only refers to the database changes and related UI
changes.
7. Error handling.


Database:
1. A product in your database should have the following information: picture, name,
price, description, and quantity. Pay attention to how quantity may affect UI
during your implementation.
2. A role in your database should have the following information: username, email,
password, address, and number.
