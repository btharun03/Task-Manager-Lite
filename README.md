# ✅ Task Manager Lite (WordPress Plugin)

A simple **WordPress plugin** that lets administrators **add, view, and complete tasks** directly inside the WordPress dashboard.  
Built using **PHP, MySQL, HTML, CSS, and JavaScript**, this project demonstrates clean plugin development practices aligned with WordPress standards.

---

## 🚀 Features
- 📌 Add tasks with **title, description, and deadline**  
- 📋 View all tasks in a neat **admin dashboard table**  
- ✅ Mark tasks as completed with a single click  
- 💾 Tasks stored securely in custom MySQL table (`wp_tml_tasks`)  
- 🔒 Clean, secure code with sanitization and escaping  

---

## 🛠️ Tech Stack
- **PHP** (WordPress Plugin APIs, OOP basics)  
- **MySQL** (Custom DB table for tasks)  
- **HTML, CSS, JavaScript** (UI elements & interactivity)  
- **WordPress CMS** (hooks, menus, admin pages)  
- **Git & GitHub** (version control + documentation)  

---

## 📂 Folder Structure
```
task-manager-lite/
│── task-manager-lite.php # Main plugin file (activation hook, loader)
│── includes/
│ └── task-manager-functions.php # Core plugin logic (CRUD for tasks)
│── assets/
│ ├── style.css # Styling
│ └── script.js # JS interactivity
│── readme.md # Documentation
```

---

## ⚡ Installation & Setup

### Prerequisites
- Local WordPress setup (via [XAMPP](https://www.apachefriends.org/) or [Local WP](https://localwp.com/))  
- PHP 7.4+ and MySQL  

### Steps
1. Download or clone this repo:
   ```bash
   git clone https://github.com/YOUR_GITHUB_USERNAME/task-manager-lite.git
    ```
2. Copy the folder into:

```
wp-content/plugins/task-manager-lite/
```

3. Go to WordPress Admin → Plugins

4. Find Task Manager Lite → Click Activate

5. You’ll see a new menu: Task Manager in the WP dashboard

---

### Future Improvements

1. Add email notifications for upcoming deadlines

2. Role-based task assignment (Admin, Editor, etc.)

3. REST API support for headless WP or mobile apps

4. React.js based front-end for tasks
