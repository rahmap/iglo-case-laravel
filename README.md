## Prerequisite
- PHP Version ^8.2
- Extension SQLite on your PHP

## Setup
- composer install
- npm i
- php artisan key:generate
- php storage:link
- php artisan migrate --seed

## Running App
- php artisan serve

## Commands
`php artisan customer:seed`
for seed dummy data Customer Approval **default 10 data**, you can pass how many data you want, example : `php artisan customer:seed 100`
\
\
_This Apps, written in PHP with Framework Laravel Version `11.x`._

## Technologies
- **Filament**
  - With custom Actions for Approve and Reject
  - Custom dynamic behavior based on Role and Permission
- **Spatie Role Permission** 
  - Roles (_RoleEnum_)
    - Customer Service
    - Supervisor
    - Staff
  - Permissions (_PermissionEnum_)
    - account_openings_access
    -  account_openings_crud
    -  account_openings_approver
- **Policies** to handle _CustomerPolicy_
- **Observers**
  - Handle Customer Model events