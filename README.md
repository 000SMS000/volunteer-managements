# Volunteer Management System

A modern web-based **Volunteer Management System** built with Laravel and Livewire to help organizations manage volunteers, workplaces, tasks, and volunteer assignments efficiently from a centralized dashboard.

## 📌 Overview

The Volunteer Management System provides an organized platform for managing volunteer activities and the locations where volunteers work.

The system includes a dashboard that provides a quick overview of the organization's activities, along with dedicated management interfaces for volunteers, workplaces, and volunteer tasks.

## ✨ Features

### 📊 Dashboard

The dashboard provides general statistics and useful information about the system, including:

* Total number of volunteers
* Total number of workplaces
* Total number of tasks
* Total number of assignments
* Most visited workplaces
* Most active volunteers
* Recent tasks
* Recent volunteer assignments
* Quick actions for common operations

### 👥 Volunteer Management

Manage volunteers through a dedicated management interface.

* Add new volunteers
* View volunteer information
* Edit volunteer data
* Delete volunteers
* Track volunteer activity
* Assign volunteers to tasks

### 🏢 Workplace Management

Manage the different workplaces/locations where volunteer activities take place.

* Add workplaces
* View workplace information
* Edit workplaces
* Delete workplaces
* Track workplace activity
* View the number of assignments associated with each workplace

### 📋 Volunteer Task Management

Create and manage tasks assigned to volunteers.

* Create tasks
* Edit tasks
* Delete tasks
* Assign tasks to volunteers
* Associate tasks with workplaces
* Track task information and assignments

### 🔗 Volunteer Assignments

The system connects volunteers, tasks, and workplaces together to provide a clear overview of volunteer activities.

Each assignment can contain information such as:

* Volunteer
* Task
* Workplace
* Assignment date

### 🧭 Navigation

The application includes a shared sidebar navigation that provides quick access to:

* Dashboard
* Workplace Management
* Volunteer Task Management
* Volunteer Management

The navigation highlights the currently active section and is designed to work with the application's RTL interface.

### 🎨 User Interface

* Modern dark-themed interface
* Responsive design
* RTL support
* Clean dashboard layout
* Reusable UI components
* Consistent navigation across the application

---

## 🛠️ Technologies

The project is built using:

* **PHP**
* **Laravel**
* **Livewire**
* **Blade**
* **Tailwind CSS**
* **MySQL / SQLite**
* **Vite**
* **Composer**
* **NPM**
* **Git & GitHub**

---

## 📂 Project Structure

The project follows the standard Laravel structure.

```text
project/
├── app/
│   ├── Livewire/
│   ├── Models/
│   └── ...
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php
│
├── public/
├── storage/
├── tests/
├── composer.json
├── package.json
└── README.md
```

---

## ⚙️ Requirements

Before installing the project, make sure you have the following installed:

* PHP 8.2+
* Composer
* Node.js
* NPM
* MySQL or SQLite
* Git

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/volunteer-management-system.git
```

### 2. Enter the project directory

```bash
cd volunteer-management-system
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Install frontend dependencies

```bash
npm install
```

### 5. Create the environment file

```bash
cp .env.example .env
```

On Windows PowerShell, you can use:

```powershell
Copy-Item .env.example .env
```

### 6. Generate the application key

```bash
php artisan key:generate
```

### 7. Configure the database

Open the `.env` file and configure your database connection.

For MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=volunteer_management
DB_USERNAME=root
DB_PASSWORD=
```

Or configure SQLite if that is what you use.

### 8. Run migrations

```bash
php artisan migrate
```

If the project contains seeders:

```bash
php artisan db:seed
```

Or:

```bash
php artisan migrate --seed
```

### 9. Build frontend assets

For development:

```bash
npm run dev
```

### 10. Start the Laravel development server

In another terminal:

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

---

## 🖥️ Development

During development, run both Laravel and Vite:

### Terminal 1

```bash
php artisan serve
```

### Terminal 2

```bash
npm run dev
```

---

## 🧪 Testing

Run the Laravel test suite with:

```bash
php artisan test
```

---

## 🔄 Database

Whenever new migrations are added, run:

```bash
php artisan migrate
```

To reset the database and run all migrations again:

```bash
php artisan migrate:fresh
```

To reset and seed the database:

```bash
php artisan migrate:fresh --seed
```

> **Warning:** `migrate:fresh` deletes all existing database tables and data.

---

## 📈 Main Modules

| Module               | Description                                  |
| -------------------- | -------------------------------------------- |
| Dashboard            | Overview and statistics                      |
| Volunteer Management | Manage volunteers                            |
| Workplace Management | Manage workplaces and locations              |
| Task Management      | Manage volunteer tasks                       |
| Assignments          | Connect volunteers with tasks and workplaces |

---

## 🎯 Project Goals

The main goals of this project are to:

* Simplify volunteer management
* Organize volunteer tasks
* Manage workplaces efficiently
* Improve assignment tracking
* Provide useful statistics and insights
* Provide a simple and responsive user interface
* Reduce manual management of volunteer activities

---

## 🔮 Future Improvements

Possible future improvements include:

* Advanced search and filtering
* Volunteer activity reports
* Export reports to PDF/Excel
* Notifications
* Role and permission management
* Detailed analytics and charts
* Volunteer attendance tracking
* Task status tracking
* Email notifications
* REST API
* Improved mobile experience

---

## 👨‍💻 Author

**Mahmoud Srour**

Web Developer

GitHub: `https://github.com/your-username`

---

## 📄 License

This project is created for educational and development purposes.

You are free to modify and improve the project according to your requirements.
