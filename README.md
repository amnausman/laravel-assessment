**Laravel test assignment**
==================

********************************************************************************************************
First Of all set your Database Name in .env and setup your environment and then run <strong>migrations</strong><br>
Then run <strong>php artisan db:seed --class=RoleSedder</strong><br>
2 Roles will be created i-e <strong>Admin and Client</strong><br>
Then run <strong>php artisan db:seed --class=UserSeeder</strong><br>
An admin with credentials <strong>Email: itssmaaann@gmail</strong> and <strong>Password: Majid_123</strong> will be created<br>
I have used Laravel Breeze as a starter kit but I have done modifications in authentication and modification phases, I could have done it even more cleaner and dynamic but due to shortage of time and according to requirements I just stayed upto the point.<br>
Then run <strong>php artisan db:seed --class=ProductSeeder</strong><br>
Products will be created<br>
Now login as Admin with above given credentials and then bein an admin you can create Register other Admins/users and clients as well and you can create products too<br>
You can set <strong>Special Prices for different Clients for each product</strong> and every client will see his special price on each product if it was set for him by admin, else he would see base price of product<br>
Admin can see if any special price is assigned to any client or not.<br>
Special Prices can only be assigned to <strong>Clients</strong> not admin and users because in requirements it was mentioned this way. Admins and users would only see <strong>Base Price</strong><br>
Normal registraton will only be as a <strong>client</strong>, only Admin can create other Roles.<br>
I haven't used service layers as I don't think it was needed, let me know if you have any queies...!!

********************************************************************************************************
Code pricing module for online wholesale store. 

Every product has its own base price.

While every client can have special price for each product if set by admin

Every client (not admin user) will get to see the base price if his/her for that product is not being set up.

Therefore, each product can have different price for EVERY client. 

In case a special price is assigned for that client he / she will see a special price. 

You need to code a module where the admin can set up a special price for Multiple products via one form for EACH client.

Flow will be list of client -> set prices -> that will open list of products and prices can be set there. 

Since it is a Laravel based assignment please also write migrations. 

You can use a starter kit if you wish to or keep the open for public user. 

What we need to see is
--------------------------

* Migrations for the table structure
* How you write code 
* Quality of comments 

Instructions
===============================
* Laravel Version 9 
* Create Migrations
* Fork this repo 
* Push code in your forked repo
* Inform us when done, we will review the code and get back to you. 


All the best

