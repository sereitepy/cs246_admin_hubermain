# Ride Sharing and Car Pooling Platform
## 📋 Requirements

Before you begin, make sure your machine has the following installed:

| Tool | Minimum Version | Check with |
|------|----------------|------------|
| PHP | 8.1+ | `php -v` |
| Composer | 2.x | `composer -V` |
| MySQL / PostgreSQL | — | `mysql --version` |
| Git | — | `git --version` |

> 💡 **Not sure if you have these?** Run the "Check with" commands in your terminal. If you get a "command not found" error, you'll need to install that tool first.

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/sereitepy/cs426_admin_hubermain.git
cd cs426_admin_hubermain
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Set up your environment file

```bash
cp .env.example .env
```

Then open `.env` in a text editor and fill in the credentials below. **Ask the repository owner for these values.**

---

## 🔐 Environment Variables

Open your `.env` file and update the following sections:

### Database

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name     # Ask the repo owner
DB_USERNAME=your_database_user     # Ask the repo owner
DB_PASSWORD=your_database_password # Ask the repo owner
```

### DigitalOcean Spaces (File Storage)

All images and files are stored on DigitalOcean Spaces. Ask the repo owner for these credentials:

```env
FILESYSTEM_DISK=do_spaces

DO_SPACES_KEY=xxxxxxxxxxxxxxxxxxxx       # Ask the repo owner
DO_SPACES_SECRET=xxxxxxxxxxxxxxxxxxxx    # Ask the repo owner
DO_SPACES_REGION=sgp1                    # e.g. sgp1, nyc3, ams3
DO_SPACES_BUCKET=your-bucket-name        # Ask the repo owner
DO_SPACES_ENDPOINT=https://sgp1.digitaloceanspaces.com
DO_SPACES_CDN_ENDPOINT=https://your-bucket-name.sgp1.cdn.digitaloceanspaces.com
```

> 💡 The region and endpoint must match. For example, Singapore = `sgp1`, New York = `nyc3`.

---

## 🛠️ Setup Commands

Run these commands **in order** after filling in your `.env`:

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Run database migrations

```bash
php artisan migrate
```

### 6. Seed the database

```bash
php artisan db:seed
```

---

## ▶️ Running the Application

```bash
php artisan serve
```

Your app will be available at: **http://127.0.0.1:8000**

> 💡 Keep this terminal window open while you're working. Press `Ctrl + C` to stop the server.

---

## 🔄 Common Commands

| Command | What it does |
|---------|-------------|
| `php artisan migrate:fresh --seed` | Wipe and re-run all migrations + seeders |
| `php artisan cache:clear` | Clear the application cache |
| `php artisan config:clear` | Clear the config cache (run this after editing `.env`) |
| `php artisan route:list` | Show all registered routes |
| `composer dump-autoload` | Rebuild the autoloader after adding new classes |

---

## 🐛 Troubleshooting

**"Class not found" errors**
```bash
composer dump-autoload
```

**Changes to `.env` not taking effect**
```bash
php artisan config:clear
php artisan cache:clear
```

**Images not showing up**
- Double-check your DigitalOcean Spaces credentials in `.env`
- Make sure the region and endpoint values match

**"SQLSTATE" / database connection error**
- Make sure your database server is running
- Double-check `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`

**Migration errors on re-run**
```bash
php artisan migrate:fresh --seed
```
⚠️ Warning: this wipes all data. Only use in development.

---

## 📁 Project Structure (Quick Reference)

```
├── app/            # Core application logic (Models, Controllers, etc.)
├── database/       # Migrations and seeders
├── public/         # Publicly accessible files
├── resources/      # Views, CSS, JS source files
├── routes/         # Web and API route definitions
├── storage/        # Logs, cache, uploaded files
└── .env            # Your local environment config (never commit this!)
```

---

## 🤝 Contributing

1. Create a new branch: `git checkout -b feature/your-feature-name`
2. Make your changes and commit: `git commit -m "Add your message"`
3. Push to your branch: `git push origin feature/your-feature-name`
4. Open a Pull Request

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
