# SMR-PAS (Samarinda Digital ID)

SMR-PAS is a Laravel package designed to integrate the Samarinda Digital ID single sign-on (SSO) system into your Laravel applications. It leverages Laravel Passport for OAuth-based authentication, allowing seamless and secure user authentication with the Samarinda Digital ID platform. This package simplifies the process of connecting your application to the SMR-PAS server, enabling users to log in using their Samarinda Digital ID credentials.

### Requirements
To use the SMR-PAS package, ensure your application meets the following requirements:
- PHP: 7.4 or higher
- Laravel: 8.x or higher

### How it works?
The SMR-PAS package integrates your application with the Samarinda Digital ID OAuth server. Here's how it works:
1. **OAuth Authorization:** The package redirects users to the SMR-PAS OAuth server (`https://smrpas.samarindakota.go.id`) for authentication.
2. **User Consent:** Users are prompted to log in and consent to share their identity details with your application (configurable via `OAUTH_PROMPT`).
3. **Token Exchange:** Upon successful authentication, the SMR-PAS server redirects the user back to your application with an authorization code, which is exchanged for an access token.
4. **User Authentication:** The access token is used to authenticate the user and retrieve their profile information, allowing seamless SSO integration.
5. **Redirect:** After successful login, users are redirected to a configurable home route (e.g., `/dashboard`).

The package handles the OAuth flow, state validation, and token management, ensuring secure and efficient integration with the Samarinda Digital ID system.

### Installation
Follow these steps to install and configure the SMR-PAS package in your Laravel application:

#### 1. Install the Package
Install the package using Composer:
```bash
composer require novay/smrpas
```
The package uses Laravel's auto-discovery feature, so the `Novay\Smrpas\SmrpasServiceProvider` is automatically registered in your application.

#### 2. Publish Vendor Assets
Publish the package's configuration files, migrations, and other assets:
```bash
php artisan vendor:publish --provider="Novay\Smrpas\SmrpasServiceProvider"
```

This will copy the package’s configuration file (`config/smrpas.php`) and migrations to your application.

#### 3. Run Migrations
The package includes database migrations to set up OAuth-related tables. Run the migrations using:
```bash
php artisan migrate
```
Note: Using `--path` to specify individual migration files is not recommended as it may skip other necessary migrations. The correct command is simply `php artisan migrate`, which will run all unpublished migrations, including those from the package (e.g., `2023_09_26_100536_create_oauths_table.php` located in `vendor/novay/smrpas/src/Database/migrations/`). If you need to target only the package’s migrations for debugging, you can use:
```bash
php artisan migrate --path=vendor/novay/smrpas/src/Database/migrations2023_09_26_100536_create_oauths_table.php
```

#### 4. Configure Environment Variables
Add the following environment variables to your `.env` file to configure the SMR-PAS OAuth integration:
```bash
OAUTH_SERVER_ID=019813c5-d483-70da-b232-73427b8dce15
OAUTH_SERVER_SECRET=HBCJ67s7e1JgE8vXmTjW53NT1angJIHuSea7AcpC
OAUTH_SERVER_REDIRECT_URI=https://samadev.test/oauth/callback
OAUTH_SERVER_URI=https://smrpas.samarindakota.go.id
OAUTH_PROMPT=consent
OAUTH_HOME=/dashboard
```

**Variable Descriptions:**
- OAUTH_SERVER_ID: The client ID issued by the SMR-PAS OAuth server for your application.
- OAUTH_SERVER_SECRET: The plain-text client secret issued by the SMR-PAS OAuth server (do not use the hashed version).
- OAUTH_SERVER_REDIRECT_URI: The callback URL where the SMR-PAS server redirects users after authentication (must match the URI registered in the SMR-PAS server).
- OAUTH_SERVER_URI: The base URL of the SMR-PAS OAuth server (e.g., `https://smrpas.samarindakota.go.id`).
- OAUTH_PROMPT: The OAuth prompt behavior. Options are:
    - none: No prompt; assumes the user is already authenticated.
    - consent: Prompts the user to consent to sharing their data.
    - login: Forces the user to log in, even if they have an active session.
- OAUTH_HOME: The route users are redirected to after successful authentication (e.g., `/dashboard`).


#### 5. Verify Configuration
Ensure the `config/smrpas.php` file (published in step 2) contains the correct settings, and update it if needed to match your `.env` values.

### Usage
To enable users to log in via Samarinda Digital ID, add a "Sign in with SMR-PAS" link to your application:
<a href="{{ route('smrpas.authorize') }}">Sign in via SMR-PAS</a>

This link triggers the OAuth authorization flow, redirecting users to the SMR-PAS server. After authentication, users are redirected back to your application’s callback URL (`OAUTH_SERVER_REDIRECT_URI`), and the package handles token exchange and user authentication.
You can customize the redirect behavior or integrate additional logic by modifying the package’s routes or controllers (e.g., `Novay\Smrpas\Http\Controllers\AuthController`).

### Credit
- **Pemerintah Kota Samarinda:** For supporting the development of the Samarinda Digital ID initiative.
- **Dinas Komunikasi dan Informatika Kota Samarinda:** For overseeing the implementation and infrastructure.
- **Bidang Aplikasi dan Layanan E-Government (Bidang 4):** For technical contributions and project coordination.

### License
SMR-PAS for Laravel is licensed under the MIT License for both personal and commercial use. Enjoy!