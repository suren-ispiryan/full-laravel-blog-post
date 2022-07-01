For running project
===================

step 1 -> Git clone project

step 2 -> Install xampp

step 3 -> Run xampp

step 4 -> Install IDE (phpStoem or VS Code)

step 5 -> Open project in IDE

step 6 -> Create db called 'laravel_blog'

step 7 -> In IDE terminal composer install

step 8 -> In IDE terminal php artisan migrate

step 9 -> In IDE terminal php artisan serve


Completed Tasks and functionality of the site
=============================================

1. Guests
  + Once clicked on the “Like” button in the post page should be redirected to the login/register page.

2. Registration as user
  + Create SugnIn page.
  + Create SugnUp page.  
  + First Name.
  + Last Name.
  + Email.
  + Password.
  + Re-enter password.
  + Make request files for form validation -> sign up
  + save password in db hashed
  + Save data in inputs after wrong registration.

3. Logged In User (Auth User)
  + Make request files for form validation -> sign in, post create/update, change password
  + Create home page and fill with folowed users posts.   
  + Should have profile pages.  
  + Should see a list of “Liked Posts”.
  + Post CRUD.
  + Should be able to like/dislike posts.
  + Change password.
  + Show users names in all posts page.
  + Follow other users.
  + Unfollow other users.  
  + By clicking on followed users name, enter followed user's personal page. 
  + Log out from accaunt.
  
4. For everyone
  + Should see a list of all blog posts.  
  + Auth Middleware.
  + Should be able to see the post details page.
