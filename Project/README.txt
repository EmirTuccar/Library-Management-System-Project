This manual illustrates how our database system works and how the web application we've developed functions. Our system is set up on a MySQL Server using MAMP. Database control is ensured through My PHP admin. Our application consists of 7 main pages.

Register
This is the initial entry page for the system. It asks for the individual's information and adds it to the database. Depending on whether the individual is staff or a user, it also limits the pages that can be accessed based on user type.

Login
The login page performs database checks and assumes the role of initiating the session necessary for our site.

Library Main Page
Our main menu is designed for ordinary users and displays the books available in our database, along with labels indicating their status. Users can reserve books by pressing the reserve button.

Profile
The profile page has been designed to display user information, with no particular function.

Add Book
The add book page consists of an add book button and a table showing the books we have added. When we press the add book button, a new page appears. On this tab, you'll find entries for information in the books table. Additionally, books added here in the database are created with author, publisher, and reservation tuples set to NULL.

Book List
The book page provides a more orderly view of the existing books. Also, from the book list page, there are buttons to delete existing books from the database or to edit them if there is an error. The delete button deletes directly from the database, while the edit button goes to a page similar to the add book page and offers a menu to change the displayed data.

Author List
The author list classifies the books in our library according to their authors and reveals how many books each author has written, information about the authors, and publisher-specific information per book. This page has two functional buttons; the first button allows us to update our author's information, the second button is unique to each book and allows us to update the publisher's information.

Reservation
This page shows us who reserved our books on an individual basis, as well as their stock status, reservation time, and when the reservation will end. This page gets data from books, users and reservation tables. Their connection will explain in database part.

Database System
There are 5 tables in our database system. These are authors, books, publishers, reservations, and users. The author and publisher tables are linked to the books table as author name and publisher name respectively. Secondly, the books, reservation, and user tables are interconnected; users and books are linked via book ID, reservation and book via book ID, and reservation and user via User ID through Primary Keys.

Add_author and add_publisher
These pages allow us to change our database's author and publisher tables through updates.

Remake and Fav
The Fav page offers a window to add to our database and sends the entered values to the database. The Remake page, like Fav, sends data to the database using the update method.

Delete
The delete page does not have any HTML scripts and is entirely built on a database method. It is directly linked to the delete button.

Topbar and Topbar2
These topbars display our main panel at the top. They distribute restrictions on our site based on user or staff login.
Db
The Db page is directly the database connection method. It is included on every page.
For Using
For using individual this application you should satisfy MAMP server and databsefinal database. For any changing if you want, we split our database delete, update and add page. So you can make changing by adjusting them.
