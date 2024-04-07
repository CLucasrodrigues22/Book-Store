# Book-Store

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

Welcome to the Book-Store repository! This Laravel project manages books and stores, including authentication with sanctum, CRUD operations for book and store registries, and handling relationships between books and stores.

## ⚙️ Features

### 🔒 Authentication

- **Login with Password**: Users can authenticate using their credentials securely or create a new access with e-mail and password.

### 👨‍💻 CRUD Operations 

#### 👤 User Registry

- **GET**: Retrieve information about profile and Logout using the session token.
- **POST**: Create a new user and login.

#### 📚 Book Registry

- **GET**: Retrieve information about books.
- **POST**: Add a new book to the registry.
- **PUT**: Update existing book details.
- **DELETE**: Remove a book from the registry.

#### 🛒 Store Registry

- **GET**: Fetch details of stores.
- **POST**: Create a new store entry.
- **PUT**: Update existing store information.
- **DELETE**: Delete a store from the registry.


#### 📚<->🛒 Book and Store Registry

- **GET**: Display details of relationship.
- **POST**: Create a new store-book relationship.


### 📚<->🛒 Book and Store Relationship

- **Book-Store Relationship**: Establish relationships between multiple books and multiple stores.

## 📝 Fields

### 👤 User

- **Name**: Requires a user name.
- **Email**: Requires an access e-mail for the user.
- **Password**: Requires a user password of at least 8 characters.

### 📚 Book

- **Name**: Required field for the book's name.
- **ISBN**: Only accepts numbers for the International Standard Book Number.
- **Value**: Decimal value representing the price of the book.

### 🛒 Store

- **Name**: Name of the store.
- **Address**: Physical address of the store.
- **Active**: Status indicating whether the store is active or not.

### 📚<->🛒 Book-Store Relationship

- **Many-to-Many**: Multiple books can be associated with multiple stores.

## 🔧 Installation

1. Clone the repository to your local machine.
2. Configure your `.env` file with database credentials and other necessary settings.
3. Run `composer install` to install PHP dependencies.
4. Run `php artisan key:generate` to generate the application key.
5. Run migrations and seeders with `php artisan migrate`.
6. Start the Laravel development server with `php artisan serve`.

## 📍 API Endpoints (routes)

### 👤 User 

- **GET** `api/v1/logout`: End session.
- **GET** `api/v1/profile`: Session profile information.
- **POST** `api/register`: Register a new user.
- **POST** `api/login`: Start a session with a valid user.

- After logging in, it will return a token, use this token in the bearer authorization of Postman, Insomnia, etc. Use this token on other routes with the v1 prefix.

### 📚 Books

- **GET** `api/v1/books`: Display a listing of the books (use `api/v1/books/{id}` to show a specific book using the id).
- **POST** `api/v1/books`: Create a new book in storage.
- **PUT** `api/v1/books/{id}`: Updating book data by id.
- **DELETE** `api/v1/books/{id}`: Deleting a book by id

### 🛒 Stores

- **GET** `api/v1/stores`: Display a listing of the stores (use `api/v1/stores/{id}` to show a specific store using the id).
- **POST** `api/v1/stores`: Create a new store in storage.
- **PUT** `api/v1/stores/{id}`: Updating store data by id.
- **DELETE** `api/v1/stores/{id}`: Deleting a book by id.

### 📚<->🛒 Book-Store Relationship

- **GET** `api/v1/bookstore`: Display a listing of the relationship (stores - books).
- **POST** `api/v1/bookstore`: Register a new relationship between store and book.
