# PHP & MySQL CRUD Application

A simple client/server web app that performs **Create, Read, Update and Delete** operations on a `tblusers` table using PHP (mysqli) and MySQL, run locally with XAMPP.

Built for **INTE 321 / DATS 222 – Distributed Systems, Module 4** (Kabarak University), *Creating the Database as well as the Application Layer and Linking All the Layers to Work Seamlessly*.

## Architecture

The app demonstrates how the layers interact:

```
Browser (HTML form / table)  ->  Application layer (PHP on Apache)  ->  Database layer (MySQL)
        <-  rendered HTML    <-                                     <-  query results
```

- **Presentation layer:** HTML + Bootstrap 4 forms and tables
- **Application layer:** PHP scripts served by Apache
- **Data layer:** MySQL database `phpcrud`, managed through phpMyAdmin

## Project structure

```
phpcrud/
├── database.sql        # Creates the database and tblusers table
├── dbconnection.php    # Shared MySQL connection (included by every page)
├── insert.php          # CREATE: form + insert handler
├── index.php           # READ (all records) + DELETE handler
├── read.php            # READ a single record by ID
├── edit.php            # UPDATE: pre-filled form + update handler
├── style.css           # Shared styling
└── README.md           # This file
```

## File documentation

| File | CRUD op | What it does |
|------|---------|--------------|
| `database.sql` | Setup | Creates database `phpcrud` and table `tblusers`. |
| `dbconnection.php` | Setup | Connects to MySQL on `localhost` as `root` (no password) and exposes the `$con` connection. Stops with a message if the connection fails. |
| `insert.php` | **C**reate | Shows a sign-up form. On submit, inserts a new row and redirects to `index.php`. |
| `index.php` | **R**ead / **D**elete | Lists every record in a table with View, Edit and Delete buttons. Handles `?delid=<ID>` to delete a row after a confirm prompt. |
| `read.php` | **R**ead | Shows full details of one user, selected with `?viewid=<ID>`. |
| `edit.php` | **U**pdate | Loads a user with `?editid=<ID>` into a form. On submit, saves the changes and redirects to `index.php`. |
| `style.css` | UI | Styles for forms and tables. |

### Database schema: `tblusers`

| Column | Type | Notes |
|--------|------|-------|
| `ID` | INT(10) | Primary key, AUTO_INCREMENT |
| `FirstName` | VARCHAR(200) | |
| `LastName` | VARCHAR(200) | |
| `MobileNumber` | BIGINT(10) | |
| `Email` | VARCHAR(200) | |
| `Address` | MEDIUMTEXT | |
| `CreationDate` | TIMESTAMP | Default `current_timestamp()`, updates on change |

## Setup

### Requirements
- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP)

### Steps
1. Start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Copy this folder to `C:\xampp\htdocs\phpcrud\` (Windows) or `/opt/lampp/htdocs/phpcrud/` (Linux).
3. Create the database, either way:
   - **Import:** open `http://localhost/phpmyadmin`, go to the **Import** tab and choose `database.sql`, or
   - **Manually:** create a database named `phpcrud`, then a table `tblusers` with the columns above.
4. Open `http://localhost/phpcrud/index.php`.

If your MySQL has a root password, edit the credentials in `dbconnection.php`.

## Usage

| Action | How |
|--------|-----|
| Add a user | `insert.php` (or **Add New User** on the list page) |
| List users | `index.php` |
| View one user | **View** button, `read.php?viewid=<ID>` |
| Edit a user | **Edit** button, `edit.php?editid=<ID>` |
| Delete a user | **Delete** button, `index.php?delid=<ID>` |

## Security notes

The original course guide builds SQL by pasting user input into query strings, which allows **SQL injection**. This version fixes that:

- All queries use **prepared statements** (`mysqli_prepare` + `bind_param`).
- All output is escaped with `htmlspecialchars()` to prevent XSS.
- IDs from the URL are cast with `intval()`.

Known limits (fine for a local learning project, not for production):
- Uses the default `root` account with no password.
- Delete uses a GET link; a real app should use POST with a CSRF token.
- There is no login, so anyone who can reach the site can edit data.
- `MobileNumber` is a BIGINT, so a leading zero (e.g. `0712345678`) is dropped. Use VARCHAR(15) if you need to keep it.

## Deploying to the cloud

Once it works on localhost, deploy to any PHP/MySQL host. Update `dbconnection.php` with the host's database name, user and password, and import `database.sql` there.

## Author

Student, Kabarak University, School of Science, Engineering & Technology (BSc Information Technology).
