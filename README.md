# 🏛️ Ministry of Commerce (MoC) Trade Training Management System

A Laravel-based web application developed for the **Ministry of Commerce (MoC)** to manage training programs, courses, batches, students, and teachers. The system is implemented by Livewire and a user-friendly admin panel.

---

## 🚀 Features

### ✅ Admin Panel
- Secure login system for administrators
- Dashboard showing total counts of teachers, students, batches, and courses
- Showing Batch and Enroll Charts

### 📚 Course Management
- Add, edit, and delete courses
- Assign courses to specific batches

### 👥 Student Management
- Register students with batch and course assignments
- View and edit student profiles

### 👨‍🏫 Teacher Management
- Add, update, and remove teachers
- Link teachers to specific courses or batches

### 📆 Batch Management
- Create batches with start and end dates
- Link batch to courses, students, and teachers

### 📝 Batch Details
- Assign multiple students and teachers to batches
- Define specific course schedules

### 🖼️ Gallery Management (Livewire)
- Upload training-related photos dynamically
- Preview and delete photos without page reload
- Uses Laravel Livewire for real-time UX

---

## 🛠️ Technologies Used

| Layer       | Tools/Frameworks                        |
|-------------|-----------------------------------------|
| **Backend** | Laravel 12, PHP                         |
| **Frontend**| HTML, Tailwind CSS, Javascript, Bootstrap, Blade, jQuery     |
| **Dynamic UI** | Laravel Livewire                     |
| **Database**| MySQL                                   |
| **Other Libraries** | AJAX                |

## ⚙️ Installation Steps

1. **Clone the Repository**

```bash
git clone https://github.com/yourusername/moc-training-system.git
cd moc-training-system
````

2. **Install Dependencies**

```bash
composer install
npm install && npm run dev
```

3. **Set Environment File**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure `.env` for Database**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moc_training
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

5. **Run Migrations and Seed (if any)**

```bash
php artisan migrate
```

6. **Start the Laravel Development Server**

```bash
php artisan serve
```

---

## 🔒 Authentication

* Admin login route: `/login`
* All admin functionalities are protected with middleware

---

## 📷 Livewire Gallery Usage

* Navigate to `/gallery`
* Upload photos using drag & drop or file picker
* Images are saved to `public/uploads/gallery/`
* Real-time preview and deletion using Laravel Livewire

---

## 📌 License

This project is developed exclusively for the **Ministry of Commerce (Myanmar)** training initiatives.
For official use only. Not licensed for commercial redistribution without permission.
