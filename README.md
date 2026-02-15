# Majelis Kopi Sales & Inventory Management System

## Description
Majelis Kopi is a comprehensive web-based application designed to streamline the operations of a coffee shop. It facilitates the management of sales, inventory, employees, and assets, providing a centralized platform for both administrators and cashiers. The system helps in tracking daily transactions, monitoring stock levels, managing employee attendance and payroll, and maintaining asset records.

## Features

### Admin Dashboard
*   **User Management**: Manage Admin and Cashier accounts.
*   **Menu Management**: Create, update, and categorize menu items with pricing and images.
*   **Raw Material (Bahan Baku) Management**: Track raw material stock and manage suppliers.
*   **Supply Management**: Record incoming supplies from vendors to update stock automatically.
*   **Asset Management**: Keep track of shop assets, including additions and reductions (broken/lost items).
*   **Employee Management**:
    *   **Attendance**: Record and monitor employee attendance.
    *   **Payroll**: Manage employee salaries and deductions.
*   **Reports**: Generate detailed reports for:
    *   Sales (Penjualan)
    *   Favorite Menus
    *   Stock Supply
    *   Financial Overview (Keuangan)
    *   Cashier Performance

### Cashier Dashboard
*   **Point of Sales (POS)**: User-friendly interface for processing customer orders.
*   **Transaction History**: View past transactions.
*   **Customer Management**: Manage customer data.
*   **Cash Management (Uang Kas)**: Record daily cash flow (start and end shifts).

## Tech Stack
*   **Language**: PHP (Native)
*   **Database**: MySQL
*   **Frontend**: HTML, CCS, Bootstrap 5, jQuery
*   **Libraries**: Select2, FullCalendar, DataTable

## Installation & Setup

1.  **Prerequisites**:
    *   Install a local server environment like XAMPP, MAMP, or LAMP stack.
    *   Ensure PHP and MySQL are running.

2.  **Clone the Repository**:
    ```bash
    git clone https://github.com/yourusername/Majelis-Kopi-PKL.git
    cd Majelis-Kopi-PKL
    ```

3.  **Database Configuration**:
    *   Open your database management tool (e.g., phpMyAdmin).
    *   Create a new database named `db_majelis_kopi`.
    *   Import the `database/database.sql` file located in the project directory.
    *   (Optional) Import `database/seeder.sql` to populate the database with dummy data for testing.

4.  **Connect to Database**:
    *   Check `database/connection.php` and update the database credentials if your local setup differs from the default:
        ```php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_majelis_kopi";
        ```

5.  **Run the Application**:
    *   Move the project folder to your server's root directory (e.g., `htdocs` for XAMPP).
    *   Open your browser and navigate to `http://localhost/Majelis-Kopi-PKL/`.

## Usage

### Default Login Credentials
If you imported the `seeder.sql` file, you can use the following accounts to log in:

*   **Administrator**:
    *   Username: `admin`
    *   Password: `admin`

*   **Cashier**:
    *   Username: `kasir`
    *   Password: `kasir`

### Roles
*   **Admin**: Has full access to all features including settings, reports, and master data management.
*   **Cashier**: Limited access focused on sales transactions, customer management, and personal attendance/payslips.
