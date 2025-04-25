Steps for installation:
1. *git clone https://github.com/andrijagrujic/ominomo-task.git* in the desired folder for installation.
2. Navigate to that folder and execute *composer install*
3. After that execute *npm install && npm run build*
4. Rename .env.example to .env (or make a new file and copy)
5. Create a database in mysql named 'ominimo' and a user with all db privileges granted named 'ominimo-user', identified by password '12346' or choose all 3 yourself, but then change them in .env file.
6. Execute *php artisan migrate*
7. Execute *php artisan db:seed*
8. For easier running of the project, start *npm run dev* in 1 terminal, *php artisan serve* in another.
9. Access the site at whichever port it has been served on.
10. Seeded users have their email generated randomly but they are all identified by password 'password'
11. Seeded admin account is: email='admintest@example.com' password:'admintest1'
